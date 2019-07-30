<?php

namespace App\Controller;

use App\Entity\Draft;
use App\Entity\Rapport;
use App\Entity\RapportEtablissement;
use App\Entity\RapportMoyen;
use App\Entity\RapportNavire;
use App\Entity\User;
use App\Form\RapportAdministratifType;
use App\Form\RapportBordType;
use App\Form\RapportCommerceType;
use App\Form\RapportFormationType;
use App\Form\RapportPechePiedType;
use DateInterval;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    private $typeRapportToClass = ['controle_a_bord' => "RapportBord",
        'filiere_commercialisation' => "RapportCommerce",
        'administratif' => "RapportAdministratif",
        "formation" => "RapportFormation",
        "peche_a_pied" => "RapportPechePied",
    ];

    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->redirectToRoute('list_forms');
    }

    /**
     * @Route("/rapport/{type}",
     *     name="rapport_create",
     *     requirements={"type": "controle_a_bord|filiere_commercialisation|administratif|formation|peche_a_pied"})
     *
     * @param Request                $request
     * @param EntityManagerInterface $em
     * @param string                 $type
     *
     * @return RedirectResponse|Response
     */
    public function rapportCreate(Request $request, EntityManagerInterface $em, string $type) {
        $rapportClass = "\\App\\Entity\\".$this->typeRapportToClass[$type];
        $formClass = "\\App\\Form\\".$this->typeRapportToClass[$type]."Type";

        /** @var Rapport $rapport */
        $rapport = new $rapportClass();
        $service = $this->getUser()->getservice();
        $rapport->setServiceCreateur($service);
        $rapport->addMoyen(new RapportMoyen());

        /** @var User $user */
        $user = $this->getUser();

        $form = $this->createForm($formClass, $rapport, ['service' => $user->getService()]);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($rapport);
            $em->flush();

            $this->addFlash("success", "Rapport enregistré");
            return $this->redirectToRoute('list_submissions');
        }

        //Setting default values on new form
        if(!$form->isSubmitted()) {
            try {
                $now = new DateTimeImmutable();
                $later = $now->add(new DateInterval('PT2H'));
            } catch(Exception $e) {
                throw new InvalidArgumentException("Erreur à l'initialisation du formulaire : impossible de récupérer la date et l'heure courante");
            }
            $form->get('dateDebutMission')->setData($now);
            $form->get('dateFinMission')->setData($later);
            switch($type) {
                case "controle_a_bord":
                    $form->get('navires')->setData([new RapportNavire()]);
                    break;
                case "filiere_commercialisation":
                    $form->get('etablissements')->setData([new RapportEtablissement()]);
                    break;
            }
        }

        switch($type) {
            case "controle_a_bord":
                return $this->render('rapportControleABord.html.twig', ['form' => $form->createView()]);
                break;
            case "filiere_commercialisation":
                return $this->render('rapportFiliereCommercialisation.html.twig', ['form' => $form->createView()]);
                break;
            case "peche_a_pied":
                return $this->render('rapportPecheAPied.html.twig', ['form' => $form->createView()]);
                break;
            case "administratif":
                return $this->render('rapportAdministratif.html.twig', ['form' => $form->createView()]);
                break;
            case "formation":
                return $this->render('rapportFormation.html.twig', ['form' => $form->createView()]);
                break;
            default:
                throw new InvalidArgumentException("Le type de formulaire n'est pas reconnu. ");
        }
    }


    /**
     * @Route("rapport/{type}/draft/{id}",
     *     methods={"POST"},
     *     name="rapport_draft",
     *     requirements={"type": "controle_a_bord|filiere_commercialisation|administratif|formation|peche_a_pied"})
     * @param Request                $request
     * @param EntityManagerInterface $em
     * @param string                 $type
     *
     * @param int|null               $id
     *
     * @return Response
     * @throws Exception For DateTimeImmutable creation
     */
    public function rapportDraft(Request $request, EntityManagerInterface $em, string $type, ?int $id = null) {
        $data = json_decode($request->getContent(), true);

        //Search and delete the CRSF token and re-number the elements (Moyens, PecherAPied, NAvires and Etablissements
        $renumbers = ["[moyens][" => 0, "[pecheursPied][" => 0, "[navires][" => 0, "[etablissements][" => 0];
        for($i = 0 ; $i < count($data) ; $i++) {

            foreach($renumbers as $elemName => $nbElems) {
                $j=0;
                $oldName = "";
                while(($pos = mb_strpos($data[$i + $j]['name'], $elemName)) &&
                    ("" === $oldName || false !== mb_strpos($data[$i + $j]['name'], $oldName))
                ) {
                    if(0 === $j) {
                        $oldName = substr($data[$i]['name'], 0, $pos + mb_strlen($elemName) + 1);
                    }
                    $data[$i + $j]['name'] = substr($data[$i + $j]['name'], 0, $pos + mb_strlen($elemName)).
                        $nbElems.
                        substr($data[$i + $j]['name'], $pos + mb_strlen($elemName) + 1);
                    $j++;
                }
                if($j > 0) {
                    $renumbers[$elemName]++;

                    $i += $j -1;
                    continue 2;
                }
            }

            if(mb_strpos($data[$i]['name'], "_token")) {
                unset($data[$i]);
                continue;
            }
        }

        if(null === $id) {
            $draft = new Draft();
            $draft->setOwner($this->getUser()->getService());
            $draft->setRapportType($type);
        } else {
            $draft = $em->getRepository("App:Draft")->find($id);
        }
        $draft->setData($data);
        $draft->setLastEdit(new DateTimeImmutable());
        $em->persist($draft);
        $em->flush();

        if(in_array("application/json", $request->getAcceptableContentTypes())) {
            return $this->json(["status" => "success",
                "text" => "Brouillon enregistré avec succès"]);
        } else {
            $this->addFlash("success", "Brouillon enregistré avec succès");
            return $this->redirectToRoute("list_submissions");
        }

    }

    /**
     * @Route("rapport/{type}/draft/{id}",
     *     methods={"GET"},
     *     name="rapport_draft_edit",
     *     requirements={"type": "controle_a_bord|filiere_commercialisation|administratif|formation|peche_a_pied"})
     * @ParamConverter("draft", class="App:Draft")
     *
     * @param Request                $request
     * @param EntityManagerInterface $em
     * @param string                 $type
     * @param Draft                  $draft
     *
     * @return Response
     */
    public function rapportEditDraft(Request $request, EntityManagerInterface $em, string $type, Draft $draft) {
        if(null === $draft) {
            $this->redirectToRoute("rapport_create", ['type' => $type]);
        }

        $rapportClass = "\\App\\Entity\\".$this->typeRapportToClass[$type];
        $formClass = "\\App\\Form\\".$this->typeRapportToClass[$type]."Type";
        $user = $this->getUser();
        /** @var Rapport $rapport */
        $rapport = new $rapportClass();
        $rapport->addMoyen(new RapportMoyen());

        $form = $this->createForm($formClass, $rapport, ['service' => $user->getService()]);

        return $this->render("rapport".str_replace('_', '', ucwords($type, '_')).".html.twig",
            ['form' => $form->createView(), 'data' => json_encode($draft->getData())]);
    }

    /**
     * @Route("/rapport/edit/{id_edit}", name="rapport_edit", requirements={"id_edit": "\d+"})
     *
     * @param Request                $request
     * @param EntityManagerInterface $em
     *
     * @param int|null               $id_edit
     *
     * @return RedirectResponse|Response
     */
    public function rapportEdit(Request $request, EntityManagerInterface $em, int $id_edit = null) {
        if(null === $controle = $em->getRepository(Rapport::class)->find($id_edit)) {
            throw $this->createNotFoundException('Pas de contrôle trouvé avec cet identifiant '.$id_edit);
        }

        $currentControlledObjects = new ArrayCollection();
        $getControlledObjects = "";

        if(get_class($controle) === "App\\Entity\\RapportBord") {
            $getControlledObjects = "getNavires";
            $formClass = RapportBordType::class;
        } elseif(get_class($controle) === "App\\Entity\\RapportCommerce") {
            $getControlledObjects = "getEtablissements";
            $formClass = RapportCommerceType::class;
        } elseif(get_class($controle) === "App\\Entity\\RapportPechePied") {
            $getControlledObjects = "getPecheursPied";
            $formClass = RapportPechePiedType::class;
        } elseif(get_class($controle) === "App\\Entity\\RapportAdministratif") {
            $getControlledObjects = false;
            $formClass = RapportAdministratifType::class;
        } elseif(get_class($controle) === "App\\Entity\\RapportFormation") {
            $getControlledObjects = false;
            $formClass = RapportFormationType::class;
        } else {
            throw new InvalidArgumentException("Type de rapport inconnu");
        }

        if($getControlledObjects) {
            foreach($controle->$getControlledObjects() as $object) {
                $currentControlledObjects->add($object);
            }
        }

        $editForm = $this->createForm($formClass, $controle, ['service' => $this->getUser()->getService()]);
        $editForm->handleRequest($request);

        if($editForm->isSubmitted() && $editForm->isValid()) {
            foreach($currentControlledObjects as $object) {
                if($getControlledObjects && false === $controle->$getControlledObjects()->contains($object)) {
                    $em->remove($object);
                }
            }

            $em->persist($controle);
            $em->flush();

            $this->addFlash("success", "Modification enregistrée");

            return $this->redirectToRoute('list_submissions');
        }

        switch($formClass) {
            case RapportBordType::class:
                return $this->render('rapportControleABord.html.twig', ['form' => $editForm->createView()]);
                break;
            case RapportCommerceType::class:
                return $this->render('rapportFiliereCommercialisation.html.twig', ['form' => $editForm->createView()]);
                break;
            case RapportPechePiedType::class:
                return $this->render('rapportPecheAPied.html.twig', ['form' => $editForm->createView()]);
                break;
            case RapportAdministratifType::class:
                return $this->render('rapportAdministratif.html.twig', ['form' => $editForm->createView()]);
                break;
            case RapportFormationType::class:
                return $this->render('rapportFormation.html.twig', ['form' => $editForm->createView()]);
                break;
            default:
                throw new InvalidArgumentException("Le type de formulaire n'est pas reconnu. ");
        }
    }

    /**
     * @Route("/list_forms", name="list_forms", methods={"GET"})
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function listForms(EntityManagerInterface $em) {

        return $this->render('listForms.html.twig');

    }

    /**
     * @Route("/list_submissions", name="list_submissions", methods={"GET"})
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function listSubmission(EntityManagerInterface $em) {
        $service = $this->getUser()->getService();

        $drafts = $em->getRepository("App:Draft")->findBy(
            ['owner' => $service],
            ['lastEdit' => "DESC"],
            20);

        $controlePeche = $em->getRepository('App:RapportBord')->findBy(
            ['serviceCreateur' => $service],
            ['dateDebutMission' => "DESC"],
            20);
        $controleCommerce = $em->getRepository('App:RapportCommerce')->findBy(
            ['serviceCreateur' => $service],
            ['dateDebutMission' => "DESC"],
            20);
        $controlePechePied = $em->getRepository('App:RapportPechePied')->findBy(
            ['serviceCreateur' => $service],
            ['dateDebutMission' => "DESC"],
            20);
        $administratif = $em->getRepository('App:RapportAdministratif')->findBy(
            ['serviceCreateur' => $service],
            ['dateDebutMission' => "DESC"],
            20);
        $formations = $em->getRepository('App:RapportFormation')->findBy(
            ['serviceCreateur' => $service],
            ['dateDebutMission' => "DESC"],
            20);

        $list = ['Contrôle de navire' => $controlePeche,
            'Contrôle de la filière commercialisation' => $controleCommerce,
            'Contrôle de la pêche à pied' => $controlePechePied,
            'Actions administratives' => $administratif,
            'Actions de formation' => $formations,
        ];

        return $this->render('listSubmissions.html.twig', ['list' => $list, 'drafts' => $drafts]);
    }

    /**
     * @Route("/show_kpi", name="show_kpi", methods={"GET"})
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function showKpi(EntityManagerInterface $em) {

        return $this->render('listKpi.html.twig');

    }
}

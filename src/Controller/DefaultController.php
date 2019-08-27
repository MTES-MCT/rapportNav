<?php

namespace App\Controller;

use App\Entity\Rapport;
use App\Entity\Service;
use App\Entity\User;
use App\Form\MissionAdministratifType;
use App\Form\MissionCommerceType;
use App\Form\MissionFormationType;
use App\Form\MissionNavireType;
use App\Form\MissionPechePiedType;
use App\Form\RapportType;
use DateInterval;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    private $typeRapportToClass = ['controle_a_bord' => "MissionNavire",
        'filiere_commercialisation' => "MissionCommerce",
        'administratif' => "MissionAdministratif",
        "formation" => "MissionFormation",
        "peche_a_pied" => "MissionPechePied",
    ];

    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->redirectToRoute('list_forms');
    }

    /**
     * @Route("/rapport", name="rapport_create")
     *
     * @param Request                $request
     * @param EntityManagerInterface $em
     *
     * @return RedirectResponse|Response
     */
    public function rapportCreate(Request $request, EntityManagerInterface $em) {
        /** @var Rapport $rapport */
        $rapport = new Rapport();
        /** @var User $user */
        $user = $this->getUser();

        $service = $user->getService();
        $rapport->setServiceCreateur($service);

        $form = $this->createForm(RapportType::class, $rapport, ['service' => $service]);

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
        }

        $crud = ['deletable' => true, 'draftable' => true];

        return $this->render('rapport.html.twig', ['form' => $form->createView(), 'crud' => $crud]);
    }

    /**
     * @Route("/rapport/edit/{id_edit}", name="rapport_edit", requirements={"id_edit": "\d+"})
     *
     * @param Request                $request
     * @param EntityManagerInterface $em
     * @param int|null               $id_edit
     *
     * @return RedirectResponse|Response
     */
    public function rapportEdit(Request $request, EntityManagerInterface $em, int $id_edit = null) {
        if(null === $rapport = $em->getRepository(Rapport::class)->find($id_edit)) {
            throw $this->createNotFoundException('Pas de contrôle trouvé avec cet identifiant '.$id_edit);
        }

        /** @var Service $userService */
        $userService = $this->getUser()->getService();
        if($rapport->getServiceCreateur() !== $userService) {
            throw $this->createNotFoundException("Brouillon non trouvé pour ce service");
        }

        $currentControlledObjects = new ArrayCollection();
        $getControlledObjects = false;

        if(get_class($rapport->getMissions()->get(0)) === "App\\Entity\\MissionNavire") {
            $getControlledObjects = "getNavires";
            $formClass = MissionNavireType::class;
        } elseif(get_class($rapport->getMissions()->get(0)) === "App\\Entity\\MissionCommerce") {
            $getControlledObjects = "getEtablissements";
            $formClass = MissionCommerceType::class;
        } elseif(get_class($rapport->getMissions()->get(0)) === "App\\Entity\\MissionPechePied") {
            $getControlledObjects = "getPecheursPied";
            $formClass = MissionPechePiedType::class;
        } elseif(get_class($rapport->getMissions()->get(0)) === "App\\Entity\\MissionAdministratif") {
            $formClass = MissionAdministratifType::class;
        } elseif(get_class($rapport->getMissions()->get(0)) === "App\\Entity\\MissionFormation") {
            $formClass = MissionFormationType::class;
        } else {
            throw new InvalidArgumentException("Type de rapport inconnu");
        }

        if($getControlledObjects) {
            foreach($rapport->$getControlledObjects() as $object) {
                $currentControlledObjects->add($object);
            }
        }

        $editForm = $this->createForm($formClass, $rapport, ['service' => $userService]);
        $editForm->handleRequest($request);

        if($editForm->isSubmitted() && $editForm->isValid()) {
            foreach($currentControlledObjects as $object) {
                if($getControlledObjects && false === $rapport->$getControlledObjects()->contains($object)) {
                    $em->remove($object);
                }
            }

            $em->persist($rapport);
            $em->flush();

            $this->addFlash("success", "Modification enregistrée");

            return $this->redirectToRoute('list_submissions');
        }

        $crud = ['deletable' => false, 'draftable' => false];
        switch($formClass) {
            case MissionNavireType::class:
                return $this->render('rapportControleABord.html.twig', ['form' => $editForm->createView(), 'crud' => $crud]);
                break;
            case MissionCommerceType::class:
                return $this->render('rapportFiliereCommercialisation.html.twig', ['form' => $editForm->createView(), 'crud' => $crud]);
                break;
            case MissionPechePiedType::class:
                return $this->render('rapportPecheAPied.html.twig', ['form' => $editForm->createView(), 'crud' => $crud]);
                break;
            case MissionAdministratifType::class:
                return $this->render('rapportAdministratif.html.twig', ['form' => $editForm->createView(), 'crud' => $crud]);
                break;
            case MissionFormationType::class:
                return $this->render('rapportFormation.html.twig', ['form' => $editForm->createView(), 'crud' => $crud]);
                break;
            default:
                throw new InvalidArgumentException("Le type de formulaire n'est pas reconnu. ");
        }
    }

    /**
     * @Route("/list_forms", name="list_forms", methods={"GET"})
     *
     * @return Response
     */
    public function listForms() {

        return $this->render('listForms.html.twig');

    }

    /**
     * @Route("/list_submissions", name="list_submissions", methods={"GET"})
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function listSubmission(EntityManagerInterface $em) {
        $userService = $this->getUser()->getService();

        $drafts = $em->getRepository("App:Draft")->findBy(
            ['owner' => $userService],
            ['lastEdit' => "DESC"],
            20);

//        $controlePeche = $em->getRepository('App:MissionNavire')->findBy(
//            ['serviceCreateur' => $userService],
//            ['dateDebutMission' => "DESC"],
//            20);
//        $controleCommerce = $em->getRepository('App:MissionCommerce')->findBy(
//            ['serviceCreateur' => $userService],
//            ['dateDebutMission' => "DESC"],
//            20);
//        $controlePechePied = $em->getRepository('App:MissionPechePied')->findBy(
//            ['serviceCreateur' => $userService],
//            ['dateDebutMission' => "DESC"],
//            20);
//        $administratif = $em->getRepository('App:MissionAdministratif')->findBy(
//            ['serviceCreateur' => $userService],
//            ['dateDebutMission' => "DESC"],
//            20);
//        $formations = $em->getRepository('App:MissionFormation')->findBy(
//            ['serviceCreateur' => $userService],
//            ['dateDebutMission' => "DESC"],
//            20);
        $rapports = $em->getRepository('App:Rapport')->findBy(
            ['serviceCreateur' => $userService],
            ['dateDebutMission' => "DESC"],
            20);

        $list = ['Contrôle de navire' => $rapports,
            'Contrôle de la filière commercialisation' => [],
            'Contrôle de la pêche à pied' => [],
            'Actions administratives' => [],
            'Actions de formation' => [],
        ];

        return $this->render('listSubmissions.html.twig', ['list' => $list, 'drafts' => $drafts]);
    }

    /**
     * @Route("/show_kpi", name="show_kpi", methods={"GET"})
     *
     * @return Response
     */
    public function showKpi() {

        return $this->render('listKpi.html.twig');

    }
}

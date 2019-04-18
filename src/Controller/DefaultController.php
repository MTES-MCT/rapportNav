<?php

namespace App\Controller;

use App\Entity\RapportEtablissement;
use App\Entity\RapportNavire;
use App\Entity\Rapport;
use App\Form\RapportBordType;
use App\Form\RapportCommerceType;
use \DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use \Exception;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {
    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->redirectToRoute('list_forms');
    }

    /**
     * @Route("/rapport/{type}", name="rapport_create", requirements={"type":
     *                           "controle_a_bord|filiere_commercialisation"})
     *
     * @param Request                $request
     * @param EntityManagerInterface $em
     *
     * @return RedirectResponse|Response
     */
    public function rapportCreate(Request $request, EntityManagerInterface $em, string $type) {

        $typeRapportToClass = ['controle_a_bord' => "RapportBord", 'filiere_commercialisation' => "RapportCommerce"];

        $rapportClass = "\\App\\Entity\\".$typeRapportToClass[$type];
        $formClass = "\\App\\Form\\".$typeRapportToClass[$type]."Type";

        $rapport = new $rapportClass();

        $form = $this->createForm($formClass, $rapport);

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
                $form->get('dateMission')->setData(new DateTime());
            } catch(Exception $e) {
            }
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
                return $this->render('rapportNavireEtPeche.html.twig', ['form' => $form->createView()]);
                break;
            case "filiere_commercialisation":
                return $this->render('rapportCommercialisation.html.twig', ['form' => $form->createView()]);
                break;
            default:
                throw new InvalidArgumentException("Le type de formulaire n'est pas reconnu. ");
        }
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
        } else {
            $getControlledObjects = "getEtablissements";
            $formClass = RapportCommerceType::class;
        }

        foreach($controle->$getControlledObjects() as $object) {
            $currentControlledObjects->add($object);
        }

        $editForm = $this->createForm($formClass, $controle);

        $editForm->handleRequest($request);

        if($editForm->isSubmitted() && $editForm->isValid()) {
            foreach($currentControlledObjects as $object) {
                if(false === $controle->$getControlledObjects()->contains($object)) {
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
                return $this->render('rapportNavireEtPeche.html.twig', ['form' => $editForm->createView()]);
                break;
            case RapportCommerceType::class:
                return $this->render('rapportCommercialisation.html.twig', ['form' => $editForm->createView()]);
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

        $controlePeche = $em->getRepository('App:RapportBord')->findBy([], ['dateMission' => "DESC"], 20);
        $controleCommerce = $em->getRepository('App:RapportCommerce')->findBy([], ['dateMission' => "DESC"], 20);


        $list = ['Contrôle de navire' => $controlePeche, 'Contrôle de la filière commercialisation' => $controleCommerce];

        return $this->render('listSubmissions.html.twig', ['list' => $list]);
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

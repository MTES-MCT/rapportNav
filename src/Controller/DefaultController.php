<?php

namespace App\Controller;

use App\Entity\RapportNavire;
use App\Entity\Rapport;
use App\Form\RapportType;
use \DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use \Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {
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
        $controle = new Rapport();

        $form = $this->createForm(RapportType::class, $controle);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($controle);
            $em->flush();
            $this->addFlash("success", "Rapport enregistré");
            return $this->redirectToRoute('list_submissions');
        }

        //Setting default values on new form
        if(!$form->isSubmitted()) {

            $form->get('navires')->setData([new RapportNavire()]);

            try {
                $form->get('dateMission')->setData(new DateTime());
            } catch(Exception $e) {
            }
        }

        return $this->render('controlePeche.html.twig', ['form' => $form->createView()]);
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

        $currentNavires = new ArrayCollection();

        foreach($controle->getNavires() as $navire) {
            $currentNavires->add($navire);
        }

        $editForm = $this->createForm(RapportType::class, $controle);

        $editForm->handleRequest($request);

        if($editForm->isSubmitted() && $editForm->isValid()) {
            foreach($currentNavires as $navire) {
                if(false === $controle->getNavires()->contains($navire)) {
                    $em->remove($navire);
                }
            }

            $em->persist($controle);
            $em->flush();

            $this->addFlash("success", "Modification enregistrée");

            return $this->redirectToRoute('list_submissions');
        }

        return $this->render('controlePeche.html.twig', ['form' => $editForm->createView()]);
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

        $controlePeche = $em->getRepository('App:Rapport')->findBy([], ['dateMission' => "DESC"], 16);

        $list = ['Contrôle des pêches' => $controlePeche];

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

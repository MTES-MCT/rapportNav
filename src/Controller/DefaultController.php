<?php

namespace App\Controller;

use App\Entity\ControlePeche;
use App\Entity\Form;
use App\Entity\Submission;
use App\Form\ControlePecheType;
use Doctrine\ORM\EntityManagerInterface;
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
     * @Route("/controle_peche", name="controle_des_peches")
     *
     * @param Request                $request
     * @param EntityManagerInterface $em
     *
     * @return RedirectResponse|Response
     */
    public function rapportControlePeche(Request $request, EntityManagerInterface $em) {
       $controle = new ControlePeche();

       try{
           $controle->setDateMission(new \DateTime());
       } catch(\Exception $e) {}

       $form = $this->createForm(ControlePecheType::class, $controle);

       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()) {

           return $this->redirectToRoute('list_forms');
       }

       return $this->render('controlePeche.html.twig', ['form' => $form->createView()]);
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

        return $this->render('listSubmissions.html.twig');

    }

    /**
     * @Route("/show_kpi", name="show_kpi", methods={"GET"})
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function showKpi(EntityManagerInterface $em) {

        return $this->render('listSubmissions.html.twig');

    }
}

<?php

namespace App\Controller;

use App\Entity\ControleNavire;
use App\Entity\ControlePeche;
use App\Form\ControlePecheType;
use \DateTime;
use Doctrine\ORM\EntityManagerInterface;
use \Exception;
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

        $form = $this->createForm(ControlePecheType::class, $controle);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($controle);
            $em->flush();
            return $this->redirectToRoute('list_forms');
        }

        //Setting default values on new form
        if(!$form->isSubmitted()) {
            
            $form->get('navires')->setData([new ControleNavire()]);
        }
        try {
            $form->get('dateMission')->setData(new DateTime());
        } catch(Exception $e) {
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

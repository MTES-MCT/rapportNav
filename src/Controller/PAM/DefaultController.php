<?php

namespace App\Controller\PAM;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pam")
 */
class DefaultController extends AbstractController {

    /**
     * @Route("/rapport", name="pam_rapport_create", methods={"GET"})
     */
    public function createRapport()
    {
        return $this->render("pam/rapport/create.html.twig");
    }

    /**
     * @Route("/home", name="pam_rapport_home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home()
    {
        return $this->render('pam/rapport/home.html.twig', [
            'sfRoutes' => [
                'rapport' => $this->generateUrl('pam_rapport_create')
            ]
        ]);
    }

}

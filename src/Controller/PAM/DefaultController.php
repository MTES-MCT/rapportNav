<?php

namespace App\Controller\PAM;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pam")
 */
class DefaultController extends AbstractController {

    /**
     * @Route("/{vueRouting}", name="pam_rapport_dashboard", methods={"GET"}, requirements={"vueRouting"=".*"})
     */
    public function dashboard()
    {
        return $this->render("pam/rapport/create.html.twig");
    }

}

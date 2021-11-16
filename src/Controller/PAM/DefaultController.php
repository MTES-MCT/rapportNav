<?php

namespace App\Controller\PAM;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pam")
 */
class DefaultController extends AbstractController {

    /**
     * @Route("/rapport", name="pam_rapport_create")
     */
    public function createRapport()
    {
        return $this->render("pam/rapport/create.html.twig");
    }

}
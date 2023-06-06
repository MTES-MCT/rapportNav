<?php

namespace App\Controller\NavPro;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/navpro" )
     */
    public function accueil()
    {
        return $this->render("navPro/accueil.html.twig");
    }


    /**
     * @Route("/navpro/controle/lot" )
     */
    public function ajoutControleParLot()
    {
        return $this->render("navPro/controle_lot.html.twig");
    }

}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VueDraftController extends AbstractController {
    /**
     * @Route("/rapport/draft/{id}", name="vue_draft")
     */
    public function index() {
        return $this->forward('App\Controller\DefaultController::rapportCreate');
    }
}

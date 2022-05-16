<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route("/api/profile")
 */
class ProfileController extends AbstractFOSRestController {


    /**
     * @Rest\Get("/me")
     * @Rest\View(serializerGroups={"me"})
     * @return View
     */
    public function me() : View
    {
        return View::create($this->getUser(), Response::HTTP_OK);
    }

}

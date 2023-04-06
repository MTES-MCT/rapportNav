<?php

namespace App\Controller\Api;

use App\Repository\ContactRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends AbstractFOSRestController
{


    /**
     * @Rest\Get("/api/contacts")
     * @param ContactRepository $repository
     *
     * @return View
     */
    public function list(ContactRepository $repository): View
    {
        return View::create($repository->findAll(), Response::HTTP_OK);
    }

}

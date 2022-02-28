<?php

namespace App\Controller\PAM\Api;

use App\Service\PAM\PamEquipageService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route("/api/pam/equipage")
 */
class EquipageController extends AbstractFOSRestController {

    /**
     * @var PamEquipageService
     */
    private $service;

    public function __construct(PamEquipageService $service) {
        $this->service = $service;
    }


    /**
     * @Rest\View(serializerGroups={"autocomplete"})
     * @Rest\Get("/autocomplete")
     * @param Request $request
     *
     * @return View
     */
    public function autocomplete(Request $request) : View
    {
        $nom = strtoupper($request->query->get('fullName'));
        try {
            return View::create($this->service->autocomplete($nom), Response::HTTP_OK);
        }
        catch(\Exception $e) {
            return View::create($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\Get("/fonctions")
     * @return View
     */
    public function listFonction() : View
    {
        return View::create($this->service->listFonction(), Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/fonctions/particulieres")
     * @return View
     */
    public function listFonctionsParticulieres() : View
    {
        return View::create($this->service->listFonctionParticuliere(), Response::HTTP_OK);
    }

}

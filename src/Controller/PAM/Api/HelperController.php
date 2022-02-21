<?php

namespace App\Controller\PAM\Api;

use App\Service\PAM\Utils\Helper;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route("/api/pam/helper")
 */
class HelperController extends AbstractFOSRestController {

    /**
     * @var Helper
     */
    protected $helper;

    public function __construct(Helper $helper) {
        $this->helper = $helper;
    }

    /**
     * @Rest\Get("/years/rapport")
     * @return View
     */
    public function yearsRapport(): View
    {
        return View::create($this->helper->yearsRapport(), Response::HTTP_OK);
    }

}

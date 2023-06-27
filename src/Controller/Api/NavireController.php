<?php

namespace App\Controller\Api;

use App\Repository\NavireRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavireController extends AbstractController
{
    /**
     * @param string           $key
     * @param NavireRepository $repository
     *
     * @return JsonResponse
     * @Route("/navire/autocomplete")
     *
     */
    public function autocomplete(Request $request, NavireRepository $repository)
    {
        $term = $request->query->get('term');
        return new JsonResponse($repository->findOneBy(['immatriculation' => $term]), 200);
    }
}

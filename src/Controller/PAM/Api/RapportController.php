<?php

namespace App\Controller\PAM\Api;

use App\Entity\PAM\PamRapport;
use App\Service\PAM\CreateRapport;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Rest\Route("/api/pam/rapport")
 */
class RapportController {

    /**
     * @Rest\Post()
     * @ParamConverter("rapport", converter="fos_rest.request_body")
     * @Rest\View(serializerGroups={"view"})
     * @param PamRapport    $rapport
     * @param CreateRapport $service
     *
     * @return View
     */
    public function save(PamRapport $rapport, CreateRapport $service) : View
    {
        try {
            $rapport = $service->persistAndFlush($rapport);
            return View::create($rapport, Response::HTTP_CREATED);
        }
        catch (NotFoundHttpException $exception) {
            return View::create($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

}
<?php

namespace App\Controller\PAM\Api;

use App\Entity\PAM\PamRapport;
use App\Service\PAM\CreateRapport;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Rest\Route("/api/pam/rapport")
 */
class RapportController {

    /**
     * @var CreateRapport
     */
    private $createRapportService;

    public function __construct(CreateRapport $createRapportService) {
        $this->createRapportService = $createRapportService;
    }

    /**
     * @Rest\Post()
     * @ParamConverter("rapport", converter="fos_rest.request_body")
     * @Rest\View(serializerGroups={"view"})
     * @param PamRapport $rapport
     *
     * @return View
     */
    public function save(PamRapport $rapport, Request $request) : View
    {
        try {
            $id = null;
            if($request->query->get('id')) {
                $id = $request->query->get('id');
            }
            $rapport = $this->createRapportService->persistAndFlush($rapport, $id);
            return View::create($rapport, Response::HTTP_CREATED);
        }
        catch (NotFoundHttpException $exception) {
            return View::create($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Rest\Post("/draft")
     * @Rest\View(serializerGroups={"view"})
     * @ParamConverter("rapport", converter="fos_rest.request_body")
     * @param PamRapport          $rapport
     * @param Request             $request
     * @param SerializerInterface $serializer
     *
     * @return View
     */
    public function draft(PamRapport $rapport, Request $request, SerializerInterface $serializer) : View
    {
        try {
            $body = $serializer->serialize($rapport, 'json', ['groups' => 'draft']);
            $id = null;
           $number = $rapport->getNumber();
            if($request->query->get('id')) {
                $id = $request->query->get('id');
            }
            $draft = $this->createRapportService->saveDraft($body, $number, $id);
            $msg = 'Success id ' . $draft->getId();
            return View::create($msg, Response::HTTP_OK);
        } catch(BadRequestHttpException $exception) {
            return View::create($exception->getStatusCode(), Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * @Rest\Get("/draft/{id}")
     * @param int $id
     *
     * @return View
     */
    public function showDraft(int $id) : View
    {
        try {
            $draft = $this->createRapportService->showDraftById($id);
            return View::create($draft, Response::HTTP_OK);
        }
        catch(NotFoundHttpException $exception) {
            return View::create($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Rest\Get("/show/{id}")
     * @Rest\View(serializerGroups={"view"})
     * @param int $id
     *
     * @return View
     */
    public function show(int $id) : View
    {
        try {
            $rapport = $this->createRapportService->showRapportById($id);
            return View::create($rapport, Response::HTTP_OK);
        }
        catch(NotFoundHttpException $exception) {
            return View::create($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

}

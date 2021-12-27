<?php

namespace App\Controller\PAM\Api;

use App\Entity\PAM\PamRapport;
use App\Service\PAM\CreateRapport;
use App\Service\PAM\PamEquipageService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
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
class RapportController extends AbstractFOSRestController {

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
     * @Rest\View(serializerGroups={"save_rapport"})
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
        catch(BadRequestHttpException $exception) {
            return View::create($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\Post("/draft")
     * @Rest\View(serializerGroups={"draft"})
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
            if($request->query->get('id')) {
                $id = $request->query->get('id');
            }
            $draft = $this->createRapportService->saveDraft($body, $this->getUser(), $id);
            $msg = 'Success id ' . $draft->getId();
            return View::create($msg, Response::HTTP_OK);
        } catch(BadRequestHttpException $exception) {
            return View::create($exception->getStatusCode(), Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * @Rest\Get("/draft/{id}")
     * @Rest\View(serializerGroups={"draft"})
     * @param int $id
     *
     * @return View
     */
    public function showDraft(string $id) : View
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
     * @param string $id
     *
     * @return View
     */
    public function show(string $id) : View
    {
        try {
            $rapport = $this->createRapportService->showRapportById($id);
            return View::create($rapport, Response::HTTP_OK);
        }
        catch(NotFoundHttpException $exception) {
            return View::create($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Rest\Get("/last/draft")
     * @Rest\View(serializerGroups={"draft"})
     * @return View
     */
    public function lastRapport() : View
    {
        $rapport = $this->createRapportService->getLastDraft($this->getUser());
        return View::create($rapport, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/last/equipage")
     * @Rest\View(serializerGroups={"view"})
     * @param PamEquipageService $service
     *
     * @return View
     */
    public function lastEquipage(PamEquipageService $service) : View
    {
        return View::create($service->getLastEquipage(), Response::HTTP_OK);
    }

}

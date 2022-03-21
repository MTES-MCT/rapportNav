<?php

namespace App\Controller\PAM\Api;

use App\Entity\PAM\PamRapport;
use App\Form\PAM\PamRapportType;
use App\Service\PAM\RapportService;
use App\Service\PAM\PamEquipageService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Rest\Route("/api/pam/rapport")
 */
class RapportController extends AbstractFOSRestController {

    /**
     * @var RapportService
     */
    private $createRapportService;

    public function __construct(RapportService $createRapportService) {
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
    public function save(PamRapport $rapport) : View
    {
        try {
            $rapport = $this->createRapportService->persistAndFlush($rapport, $this->getUser()->getService());
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
     * @param Request $request
     *
     * @return View
     */
    public function draft(Request $request) : View
    {
        try {
            $id = null;
            if($request->query->get('id')) {
                $id = $request->query->get('id');
            }
            $draft = $this->createRapportService->saveDraft($request->getContent(), $this->getUser()->getService(), $id);
            return View::create($draft, Response::HTTP_OK);
        } catch(BadRequestHttpException $exception) {
            return View::create($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * @Rest\Get("/draft/{id}")
     * @Rest\View(serializerGroups={"draft"})
     * @param string $id
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
        $rapport = $this->createRapportService->getLastDraft($this->getUser()->getService());
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
        return View::create($service->getLastEquipage($this->getUser()->getService()), Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/{id}")
     * @Rest\View(serializerGroups={"view"})
     * @param Request $request
     * @param string  $id
     *
     * @return View
     */
    public function updateRapport(Request $request, string $id) : View
    {

        $em = $this->getDoctrine()->getManager();
        $existingRapport = $em->getRepository(PamRapport::class)->find($id);
        $form = $this->createForm(PamRapportType::class, $existingRapport);

        try {
            $response = $this->createRapportService->updateRapport($form, $request, $existingRapport, $this->getUser()->getService());
            return View::create($response, Response::HTTP_OK);
        }
        catch(BadRequestHttpException $e) {
            return View::create($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\Get
     * @Rest\View(serializerGroups={"view"})
     * @return View
     */
    public function list() : View
    {
        return View::create($this->createRapportService->listAll($this->getUser()->getService()), Response::HTTP_OK);
    }

}

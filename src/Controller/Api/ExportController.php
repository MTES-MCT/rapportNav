<?php

namespace App\Controller\Api;

use App\Exception\RapportNotFound;
use App\Service\ExportService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * @Rest\Route("/api/export")
 */
class ExportController extends AbstractFOSRestController {

    protected $service;

    public function __construct(ExportService $exportService) {
        $this->service = $exportService;
    }


    /**
     * @Rest\Get("/odt/{id}")
     * @param $id
     *
     * @return StreamedResponse|View
     */
    public function export($id) : StreamedResponse {
        try {
            $templateProcessor = $this->service->getDataForExport($id);
            $response =  new StreamedResponse(
                function () use ($templateProcessor) {
                    $templateProcessor->saveAs('php://output');
                }
            );
            $fileName = 'rapport_ulam_' . $id . '.docx';
            $response->headers->set('Content-Description',  'File Transfer');
            $response->headers->set('Content-Disposition',' attachment; filename="' . $fileName . '"');
            $response->headers->set('Content-Type',' application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            $response->headers->set('Content-Transfer-Encoding',' binary');
            $response->headers->set('Cache-Control',' must-revalidate, post-check=0, pre-check=0');
            $response->headers->set('Expires','0');

            return $response;
        }
        catch(RapportNotFound $e) {
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}

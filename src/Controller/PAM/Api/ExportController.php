<?php

namespace App\Controller\PAM\Api;

use App\Service\PAM\ExportService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * @Rest\Route("/api/pam/export")
 */
class ExportController extends AbstractFOSRestController
{
    /**
     * @var ExportService $service
     */
    private $service;

    public function __construct(ExportService $service) {
        $this->service = $service;
    }

    /**
     * @Rest\Get("/indicateurs/{rapportID}")
     * @param string  $rapportID
     * @param Request $request
     *
     * @return View|StreamedResponse
     */
    public function indicateursOds(string $rapportID, Request $request)
    {
        $draft = $request->query->has('draft');
        try {
            $spreadsheet = $this->service->exportOds($rapportID, $draft);

            $writer = IOFactory::createWriter($spreadsheet, 'Xls');
            $response =  new StreamedResponse(
                function () use ($writer) {
                    $writer->save('php://output');
                }
            );
            $fileName = 'indicateurs_' . $rapportID . '.xls';
            $response->headers->set('Content-Type', 'application/vnd.ms-excel');
            $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
            $response->headers->set('Cache-Control','max-age=0');

            return $response;
        }
        catch(\Exception $exception) {
            return View::create($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Get("/rapport/{rapportID}")
     * @param string  $rapportID
     * @param Request $request
     *
     * @return StreamedResponse|View
     */
    public function rapportDocx(string $rapportID, Request $request) {
        $draft = $request->query->has('draft');
        try {
            $templateProcessor = $this->service->exportRapportDocx($rapportID, $draft);
            $response =  new StreamedResponse(
                function () use ($templateProcessor) {
                    $templateProcessor->saveAs('php://output');
                }
            );
            $fileName = 'rapport_' . $rapportID . '.docx';
            $response->headers->set('Content-Description',  'File Transfer');
            $response->headers->set('Content-Disposition',' attachment; filename="' . $fileName . '"');
            $response->headers->set('Content-Type',' application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            $response->headers->set('Content-Transfer-Encoding',' binary');
            $response->headers->set('Cache-Control',' must-revalidate, post-check=0, pre-check=0');
            $response->headers->set('Expires','0');

            return $response;
        }
        catch(\Exception $exception) {
            return View::create($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
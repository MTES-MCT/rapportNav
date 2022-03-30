<?php

namespace App\Controller\PAM\Api;

use App\Exception\RapportNotFound;
use App\Service\PAM\ExportService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
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
     * @Rest\Get("/aem/{startDate}/{endDate}")
     * @param string  $startDate
     * @param string  $endDate
     * @param Request $request
     *
     * @return View|StreamedResponse
     */
    public function rapportAEM(string $startDate, string $endDate, Request $request) {
        $draft = $request->query->has('draft');
        $wholeTeams = $request->query->has('teams');
        try {
           $spreadSheet = $this->service->exportRapportAEM(new \DateTime($startDate), new \DateTime($endDate), $wholeTeams);
            $writer = new Xls($spreadSheet);
            $response =  new StreamedResponse(
                function () use ($writer) {
                    $writer->save('php://output');
                }
            );
            $fileName = 'rapport_AEM_' . $startDate . '_' . $endDate . '.xls';
            $response->headers->set('Content-Type', 'application/vnd.ms-excel');
            $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
            $response->headers->set('Cache-Control','max-age=0');

            return $response;
        }
        catch(RapportNotFound $e) {
            return View::create($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
        catch(\Exception $e) {
            return View::create($e->getMessage(), Response::HTTP_BAD_REQUEST);
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

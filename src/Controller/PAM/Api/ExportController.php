<?php

namespace App\Controller\PAM\Api;

use App\Exception\RapportNotFound;
use App\Repository\PAM\PamRapportRepository;
use App\Service\PAM\ExportService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpWord\Settings;
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
        $type = $request->query->get('type');
        try {
            $templateProcessor = $this->service->exportRapportDocx($rapportID, $draft);
            if($type === 'odt') {
                $templateProcessor->saveAs(__DIR__ .'/../../temp_rapport_pam.docx');
                $phpWord = \PhpOffice\PhpWord\IOFactory::load(__DIR__ .'/../../temp_rapport_pam.docx');
                $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'ODText');
                $fileName = 'Rapport_' . $rapportID . '.odt';
                $response =  new StreamedResponse(
                    function () use ($xmlWriter ) {
                        $xmlWriter->save('php://output');
                    }
                );
                unlink(__DIR__ .'/../../temp_rapport_pam.docx');
                $response->headers->set('Content-Description',  'File Transfer');
                $response->headers->set('Content-Disposition',' attachment; filename="' . $fileName . '"');
                $response->headers->set('Content-Type',' application/vnd.openxmlformats-officedocument.wordprocessingml.document;charset=utf-8');
                $response->headers->set('Content-Transfer-Encoding',' binary');
                $response->headers->set('Cache-Control',' must-revalidate, post-check=0, pre-check=0');
                $response->headers->set('Expires','0');

                return $response;
            }
            if($type === 'pdf'){
                $templateProcessor->saveAs(__DIR__ .'/../../temp_rapport_pam.docx');
                $phpWord = \PhpOffice\PhpWord\IOFactory::load(__DIR__ .'/../../temp_rapport_pam.docx');
                $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'ODText');


                // Make sure you have `dompdf/dompdf` in your composer dependencies.
                Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
                // Any writable directory here. It will be ignored.
                Settings::setPdfRendererPath('.');

                //   $phpWord = \PhpOffice\PhpWord\IOFactory::load('document.docx', 'Word2007');

                $response =  new StreamedResponse(
                    function () use ($phpWord ) {
                        $phpWord->save('php://output', 'PDF');
                    }
                );
                $fileName = 'Rapport_' . $rapportID . '.pdf';
                $response->headers->set('Content-Description',  'File Transfer');
                $response->headers->set('Content-Disposition',' attachment; filename="' . $fileName . '"');
                $response->headers->set('Content-Type',' application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                $response->headers->set('Content-Transfer-Encoding',' binary');
                $response->headers->set('Cache-Control',' must-revalidate, post-check=0, pre-check=0');
                $response->headers->set('Expires','0');

                return $response;
            }
            else {
                $response =  new StreamedResponse(
                    function () use ($templateProcessor) {
                        $templateProcessor->saveAs('php://output');
                    }
                );
                $fileName = 'rapport_' . $rapportID . '.docx';
            }
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

    /**
     * @Rest\Get("/check/{startDate}/{endDate}")
     * @return View
     *
     */
    public function checkAvailable(string $startDate, string $endDate, Request $request, PamRapportRepository $rapportRepository): View
    {
        $wholeTeams = $request->query->has('teams');
        $rapports = $rapportRepository->findByDateRange(new \DateTime($startDate), new \DateTime($endDate), $wholeTeams);

        return View::create(count($rapports), Response::HTTP_OK);
    }

}

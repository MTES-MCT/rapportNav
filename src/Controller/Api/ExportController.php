<?php

namespace App\Controller\Api;

use App\Exception\RapportNotFound;
use App\Service\CLIService;
use App\Service\ExportService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\IOFactory;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * @Rest\Route("/api/export")
 */
class ExportController extends AbstractFOSRestController {

    protected $exportService;

    protected CLIService $cliService;

    protected ParameterBagInterface $parameterBag;

    public function __construct(ExportService $exportService, CLIService $cliService, ParameterBagInterface $parameterBag) {
        $this->exportService = $exportService;
        $this->cliService = $cliService;
        $this->parameterBag = $parameterBag;
    }


    /**
     * @Rest\Get("/rapport/{id}", name="api_export_rapport")
     * @param int     $id
     * @param Request $request
     *
     * @return StreamedResponse|View
     * @throws Exception
     */
    public function export(int $id, Request $request)  {
        try {
            $templateProcessor = $this->exportService->getDataForExport($id);
            $type = $request->query->get('type');
            if($type === 'odt') {
              $path = __DIR__ .'/../../rapport_mission_ULAM.docx';
              $templateProcessor->saveAs("$path");
              $this->cliService->executeLibreOffice($path);

              $fileName = 'rapport_mission_ULAM.odt';
              $response =  new BinaryFileResponse($fileName);
            } else {
                $response =  new StreamedResponse(
                    function () use ($templateProcessor) {
                        $templateProcessor->saveAs('php://output');
                    }
                );
                $fileName = 'rapport_mission_ULAM_' . $id . '.docx';
            }
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

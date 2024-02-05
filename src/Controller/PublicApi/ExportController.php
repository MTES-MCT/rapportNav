<?php

namespace App\Controller\PublicApi;

use App\Exception\RapportNotFound;
use App\Request\PublicAPI\ExportOdtRequest;
use App\Service\PublicAPI\ExportOdtService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use PhpOffice\PhpWord\IOFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends AbstractFOSRestController
{

  protected ExportOdtService $service;

  public function __construct(ExportOdtService $service)
  {
    $this->service = $service;
  }

  public function export(ExportOdtRequest $request) {
    try {
      $templateProcessor = $this->service->handleData($request);


      $templateProcessor->saveAs(__DIR__ .'/../../temp_rapport.docx');
      $phpWord = IOFactory::load(__DIR__ .'/../../temp_rapport.docx');
      $xmlWriter = IOFactory::createWriter($phpWord , 'ODText');
      $fileName = 'Rapport_PAM.odt';
      $response =  new StreamedResponse(
        function () use ($xmlWriter ) {
          $xmlWriter->save('php://output');
        }
      );

      unlink(__DIR__ .'/../../temp_rapport.docx');
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

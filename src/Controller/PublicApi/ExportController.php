<?php

namespace App\Controller\PublicApi;

use App\Exception\RapportNotFound;
use App\Request\PublicAPI\ExportOdtRequest;
use App\Service\PublicAPI\ExportOdtService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * @Rest\Route("/public_api/export")
 */
class ExportController extends AbstractFOSRestController
{

  protected ExportOdtService $service;

  public function __construct(ExportOdtService $service)
  {
    $this->service = $service;
  }

  /**
   * @Rest\Post("/odt")
   * @param ExportOdtRequest $request
   * @ParamConverter("request", converter="fos_rest.request_body")
   *
   * @return View|StreamedResponse
   * @throws \PhpOffice\PhpWord\Exception\Exception
   */
  public function export(ExportOdtRequest $request, ParameterBagInterface $parameterBag) {
    try {
      $templateProcessor = $this->service->handleData($request);
      $templateProcessor->saveAs(__DIR__ .'/../../temp_rapport_pam.docx');
      $phpWord = \PhpOffice\PhpWord\IOFactory::load(__DIR__ .'/../../temp_rapport_pam.docx');
      $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'ODText');
      $fileName = 'Rapport_pam.odt';
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
    catch(RapportNotFound $e) {
      return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

}

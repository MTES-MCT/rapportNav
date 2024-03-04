<?php

namespace App\Controller\PublicApi;

use App\Exception\RapportNotFound;
use App\Request\PublicAPI\ExportOdtRequest;
use App\Service\PublicAPI\ExportOdtService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route("/public_api/export")
 */
class ExportController extends AbstractFOSRestController
{

  protected ExportOdtService $service;
  protected LoggerInterface $logger;
  protected ParameterBagInterface $parameterBag;

  public function __construct(ExportOdtService $service, LoggerInterface $logger, ParameterBagInterface $parameterBag)
  {
    $this->service = $service;
    $this->logger = $logger;
    $this->parameterBag = $parameterBag;
  }

  /**
   * @Rest\Post("/odt")
   * @param ExportOdtRequest $odtRequest
   *
   * @return Response|View
   * @ParamConverter("odtRequest", converter="fos_rest.request_body")
   */
  public function export(ExportOdtRequest $odtRequest) {
    try {
      $currentTimestamp = time();
      $templateProcessor = $this->service->handleData($odtRequest);
      $path = __DIR__ ."/../../temp_rapport_pam_$currentTimestamp";
      $templateProcessor->saveAs($path . '.docx');

      $this->executeLibreOffice($path);

      $fileName = "/temp_rapport_pam_$currentTimestamp.odt";
      $odtFile = $this->parameterBag->get('public_dir') . $fileName ;

      $base64Content = $this->convertToBase64($odtFile);

      $response = new Response($base64Content, Response::HTTP_CREATED);
      $response->headers->set('Content-Type', 'application/octet-stream');
      $response->headers->set('Content-Disposition', 'attachment; filename=" '.$fileName.'""');

      unlink($odtFile);

      return $response;
    }
    catch(RapportNotFound $e) {
      return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }


  private function executeLibreOffice(string $path): void
  {
    $command =  $_ENV['LIBREOFFICE_PATH'] . " --headless --convert-to odt  $path.docx";
    $output = null;
    $result_code = null;
    exec($command, $output, $result_code);
    $this->logger->debug("Execution of libreoffice --headless --convert-to odt $path.docx returned with status $result_code");
    unlink($path . '.docx');
  }

  private function convertToBase64(string $odtFile): string
  {

    $fileContent = file_get_contents($odtFile);
    return base64_encode($fileContent);
  }

}

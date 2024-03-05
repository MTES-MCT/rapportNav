<?php

namespace App\Controller\PublicApi;

use App\Exception\RapportNotFound;
use App\Request\PublicAPI\ExportOdtRequest;
use App\Service\CLIService;
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
  protected ParameterBagInterface $parameterBag;
  protected CLIService $cliService;

  public function __construct(ExportOdtService $service,
                              ParameterBagInterface $parameterBag,
                              CLIService $cliService
  )
  {
    $this->service = $service;
    $this->parameterBag = $parameterBag;
    $this->cliService = $cliService;
  }

  /**
   * @Rest\Post("/odt")
   * @ParamConverter("odtRequest", converter="fos_rest.request_body")
   */
  public function mission(ExportOdtRequest $odtRequest): View {
    try {
      $currentTimestamp = time();
      $templateProcessor = $this->service->handleData($odtRequest);
      $path = __DIR__ ."/../../temp_rapport_pam_$currentTimestamp.docx";
      $templateProcessor->saveAs($path);

      $this->cliService->executeLibreOffice($path);

      $fileName = "/temp_rapport_pam_$currentTimestamp.odt";
      $odtFile = $this->parameterBag->get('public_dir') . $fileName ;

      $base64Content = $this->convertToBase64($odtFile);

      unlink($odtFile);

      return View::create(["fileName" => $fileName, "fileContent" => $base64Content]);
    }
    catch(RapportNotFound $e) {
      return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }


  private function convertToBase64(string $odtFile): string
  {

    $fileContent = file_get_contents($odtFile);
    return base64_encode($fileContent);
  }

}

<?php

namespace App\Controller\PublicApi;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HealthCheckController
{

  /**
   * @Route("/healthcheck/alive")
   */
  public function alive(): Response
  {
    return new Response("alive", Response::HTTP_OK);
  }

}

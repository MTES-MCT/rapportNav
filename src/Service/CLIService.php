<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class CLIService {

  private LoggerInterface $logger;

  public function __construct(LoggerInterface $logger) {
    $this->logger = $logger;
  }


  public function executeLibreOffice(string $path): void
  {
    $command =  $_ENV['LIBREOFFICE_PATH'] . " --headless --convert-to odt  $path";
    $output = null;
    $result_code = null;
    exec($command, $output, $result_code);
    $this->logger->debug("Execution of libreoffice --headless --convert-to odt $path.docx returned with status $result_code");
    unlink($path);


  }

}

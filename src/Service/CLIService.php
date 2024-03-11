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
    $command =  $_ENV['LIBREOFFICE_PATH'] . " -env:UserInstallation=file:///tmp/test --headless --convert-to odt $path 2>&1";
    $output = null;
    $result_code = null;
    $result = exec($command, $output, $result_code);
    $this->logger->debug("Execution of libreoffice --headless --convert-to odt $path returned with status $result_code and result : $result");
    unlink($path);


  }

}

<?php

namespace App\Service\PAM\Utils;

use App\Service\PAM\RapportService;

class Helper {

    /**
     * @var RapportService
     */
    private $rapportService;

    public function __construct(RapportService $rapportService) {
        $this->rapportService = $rapportService;
    }

    /**
     * @return array
     */
    public function yearsRapport(): array
    {
        $rapports = $this->rapportService->listAll();

        $years = [];
        foreach($rapports as $rapport) {
            $years[] =  $rapport->getStartDatetime()->format('Y');
        }

        return array_unique($years);
    }

}

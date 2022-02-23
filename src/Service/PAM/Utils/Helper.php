<?php

namespace App\Service\PAM\Utils;

use App\Repository\PAM\PamDraftRepository;
use App\Repository\PAM\PamRapportRepository;
use App\Service\PAM\RapportService;

class Helper {

    /**
     * @var RapportService
     */
    private $rapportService;

    private $rapportRepository;

    private $draftRepository;

    public function __construct(RapportService $rapportService, PamRapportRepository $rapportRepository, PamDraftRepository $draftRepository) {
        $this->rapportService = $rapportService;
        $this->draftRepository = $draftRepository;
        $this->rapportRepository = $rapportRepository;
    }

    /**
     * @return array
     */
    public function yearsRapport(): array
    {

        $rapports = $this->rapportRepository->findAll();
        $drafts = $this->draftRepository->findAll();

        $years = [];
        foreach($rapports as $rapport) {
            $years[] =  $rapport->getStartDatetime()->format('Y');
        }

        foreach($drafts as $draft) {
            $years[] = $draft->getStartDatetime()->format('Y');
        }

        return array_unique($years);
    }

}

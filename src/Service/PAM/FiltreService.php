<?php

namespace App\Service\PAM;

use App\Repository\PAM\PamDraftRepository;
use App\Repository\PAM\PamRapportRepository;
use Symfony\Component\HttpFoundation\Request;

class FiltreService {

    /**
     * @var PamDraftRepository
     */
    private $draftRepository;

    /**
     * @var PamRapportRepository
     */
    private $rapportRepository;

    /**
     * @var RapportService
     */
    private $rapportService;

    /**
     * @param PamDraftRepository   $draftRepository
     * @param PamRapportRepository $rapportRepository
     * @param RapportService       $rapportService
     */
    public function __construct(PamDraftRepository $draftRepository, PamRapportRepository $rapportRepository, RapportService $rapportService) {
        $this->draftRepository = $draftRepository;
        $this->rapportRepository = $rapportRepository;
        $this->rapportService = $rapportService;
    }


    /**
     * @throws \Exception
     */
    public function filtre(Request $request) : array
    {
        $query = $request->query;
        $statut = $query->get('statut');
        $periode = $query->get('periode') ? : 'current';
        $bordee = $query->get('bordee') ? : 'mine';
        $date = $query->get('date');
        $startDate = $request->get('startRange');
        $endDate = $request->get('endRange');

        if($statut === 'brouillon') {
            return $this->draftRepository->filter($periode, $bordee, $date, $startDate, $endDate);
        }
        if($statut === 'valide') {
            return $this->rapportRepository->filter($periode, $bordee, $date, $startDate, $endDate);
        }
        $rapports = $this->rapportRepository->filter($periode, $bordee, $date, $startDate, $endDate);
        $drafts = $this->draftRepository->filter($periode, $bordee, $date, $startDate, $endDate);
        return $this->rapportService->handleRapportAndDraft($rapports, $drafts);


    }

}

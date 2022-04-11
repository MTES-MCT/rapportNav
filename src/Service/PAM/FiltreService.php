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
        $periode = $query->get('periode');
        $bordee = $query->get('bordee');

        if($query->count() > 0) {
            if($statut === 'brouillon') {
                return $this->draftRepository->filter($periode, $bordee);
            }
            if($statut === 'valide') {
                return $this->rapportRepository->filter($periode, $bordee);
            }
            if(!$statut) {
                $rapports = $this->rapportRepository->filter($periode, $bordee);
                $drafts = $this->draftRepository->filter($periode, $bordee);
                return $this->rapportService->handleRapportAndDraft($rapports, $drafts);
            }

        }

        return $this->rapportService->listAll();
    }

}

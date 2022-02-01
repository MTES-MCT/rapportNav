<?php

namespace App\Service\PAM;

use App\Entity\PAM\PamIndicateur;
use App\Repository\PAM\PamDraftRepository;
use App\Repository\PAM\PamIndicateurRepository;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportService {

    /**
     * @var PamIndicateurRepository
     */
    private $indicateurRepository;

    /**
     * @var PamDraftRepository
     */
    private $draftRepository;

    const INDICATEUR_CATEGORY_TITLE_COL = 'A';
    const INDICATEUR_PRINCIPALE_COL = 'F';
    const INDICATEUR_SECONDAIRE_COL = 'G';
    const INDICATEUR_OBSERVATION_COL = 'I';
    const ROW_ASSISTANCE_NAVIRE = 16;
    const ROW_LUTTE_IMMIGRATION_ILLEGALE = 22;
    const ROW_REPRESSION_POLLUTION = 28;
    const ROW_PECHE_ILLEGALE = 34;
    const ROW_SURVEILLANCE_ENVIRONNEMENT = 41;
    const ROW_SURETE_MARITIME = 45;
    const ROW_INTERETS_NATIONAUX = 49;

    /**
     * @param PamIndicateurRepository $indicateurRepository
     * @param PamDraftRepository      $draftRepository
     */
    public function __construct(PamIndicateurRepository $indicateurRepository, PamDraftRepository $draftRepository) {
        $this->indicateurRepository = $indicateurRepository;
        $this->draftRepository = $draftRepository;
    }

    /**
     * @param string $rapportID
     * @param bool   $draft
     *
     * @return Spreadsheet
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function exportOds(string $rapportID, bool $draft = false) : Spreadsheet
    {
        $indicateurs = $draft ? $this->draftRepository->findAllIndicateursByRapport($rapportID) : $this->indicateurRepository->findAllByRapport($rapportID);
        $spreadsheet = IOFactory::load(dirname(__DIR__) . '/PAM/SAMPLE_THEMIS_A_ANNEXE Suivi_Mensuel.xlsx');
        $sheet = $spreadsheet->getActiveSheet();
        $assistanceNavire = [];
        $lutteImmigrationIllegale = [];
        $repressionPollution = [];
        $pecheIllegale = [];
        $surveillanceEnv = [];
        $sureteMaritime = [];
        $interetsNationaux = [];

        foreach($indicateurs as $value) {
            switch($value->getMission()->getCategory()->getId()) {
                case 1:
                    $assistanceNavire[] = $value;
                    break;
                case 2:
                    $lutteImmigrationIllegale[] = $value;
                    break;
                case 3:
                    $repressionPollution[] = $value;
                    break;
                case 4:
                    $pecheIllegale[] = $value;
                    break;
                case 5:
                    $surveillanceEnv[] = $value;
                    break;
                case 6:
                    $sureteMaritime[] = $value;
                    break;
                case 7:
                    $interetsNationaux[] = $value;
                    break;
            }
        }

        $this->fillCells($sheet, self::ROW_ASSISTANCE_NAVIRE, $assistanceNavire);
        $this->fillCells($sheet, self::ROW_INTERETS_NATIONAUX, $interetsNationaux);
        $this->fillCells($sheet, self::ROW_LUTTE_IMMIGRATION_ILLEGALE, $lutteImmigrationIllegale);
        $this->fillCells($sheet, self::ROW_REPRESSION_POLLUTION, $repressionPollution);
        $this->fillCells($sheet, self::ROW_PECHE_ILLEGALE, $pecheIllegale);
        $this->fillCells($sheet, self::ROW_SURVEILLANCE_ENVIRONNEMENT, $surveillanceEnv);
        $this->fillCells($sheet, self::ROW_SURETE_MARITIME, $sureteMaritime);
        return $spreadsheet;

    }

    /**
     * Rempli les cellules d'un tableur
     * @param Worksheet $sheet
     * @param int       $startRow
     * @param PamIndicateur[]     $indicateurs
     */
    private function fillCells(Worksheet $sheet, int $startRow, array $indicateurs): void
    {
        foreach($indicateurs as $key => $value) {
            $row = ($startRow + $key);
            $cellTitle = self::INDICATEUR_CATEGORY_TITLE_COL . $row;
            $cellPrincipale = self::INDICATEUR_PRINCIPALE_COL . $row;
            $cellSecondaire = self::INDICATEUR_SECONDAIRE_COL . $row;
            $cellObservation = self::INDICATEUR_OBSERVATION_COL . $row;
            $sheet->setCellValue($cellTitle, $value->getCategory()->getNom());
            $sheet->setCellValue($cellPrincipale, $value->getPrincipale());
            $sheet->setCellValue($cellSecondaire, $value->getSecondaire());
            $sheet->setCellValue($cellObservation, $value->getObservations());
        }
    }
}

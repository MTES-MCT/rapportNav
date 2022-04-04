<?php

namespace App\Service\PAM;
setlocale (LC_TIME, 'fr_FR.utf8','fra');

use App\Entity\PAM\PamRapport;
use App\Exception\RapportNotFound;
use App\Repository\PAM\PamDraftRepository;
use App\Repository\PAM\PamIndicateurRepository;
use App\Repository\PAM\PamRapportRepository;
use App\Service\PAM\Utils\OfficeFiller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use PhpOffice\PhpWord\TemplateProcessor;

class ExportService {

    /**
     * @var PamIndicateurRepository
     */
    private $indicateurRepository;

    /**
     * @var PamDraftRepository
     */
    private $draftRepository;

    /**
     * @var PamRapportRepository
     */
    private $rapportRepository;

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
    public function __construct(PamIndicateurRepository $indicateurRepository, PamDraftRepository $draftRepository, PamRapportRepository $rapportRepository) {
        $this->indicateurRepository = $indicateurRepository;
        $this->draftRepository = $draftRepository;
        $this->rapportRepository = $rapportRepository;
    }

    /**
     * @param string $rapportID
     * @param bool   $draft
     *
     * @return Spreadsheet
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function exportOds(string $rapportID, bool $draft = false) : Spreadsheet {
        $indicateurs = $draft ? $this->draftRepository->findAllIndicateursByRapport($rapportID) : $this->indicateurRepository->findAllByRapport($rapportID);
        $spreadsheet = IOFactory::load(dirname(__DIR__) . '/PAM/samples/SAMPLE_Rapport_AEM.xlsx');
        $sheet = $spreadsheet->getActiveSheet();
        $this->fillAEM($indicateurs, $sheet);

        return $spreadsheet;
    }

    /**
     * @param \DateTime $firstDate
     * @param \DateTime $lastDate
     * @param bool      $wholeTeams
     *
     * @return Spreadsheet
     * @throws RapportNotFound
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function exportRapportAEM(\DateTime $firstDate, \DateTime $lastDate, bool $wholeTeams = true) : Spreadsheet
    {
        $spreadsheet = IOFactory::load(dirname(__DIR__) . '/PAM/samples/SAMPLE_Rapport_AEM.xlsx');
        $filler = new OfficeFiller();
        $rapports = $this->rapportRepository->findByDateRange($firstDate, $lastDate, $wholeTeams);

        $assistanceNavire = [];
        $lutteImmigrationIllegale = [];
        $repressionPollution = [];
        $pecheIllegale = [];
        $surveillanceEnv = [];
        $sureteMaritime = [];
        $interetsNationaux = [];

        if(!$rapports) {
            throw new RapportNotFound('Aucun rapport trouvé pour cette unité');
        }
        $mois = [];
        $merge = false;
        foreach($rapports as $key => $rapport) {
            if(!in_array($rapport->getEndDatetime()->format('F Y'), $mois)) {
                $sheet = clone $spreadsheet->getSheet(0);
                $sheet->setTitle($rapport->getEndDatetime()->format('F Y'));
                $spreadsheet->addSheet($sheet, $key);
            } else {
                $sheet = $spreadsheet->getSheetByName($rapport->getEndDatetime()->format('F Y'));
                $merge = true;
            }

            foreach($rapport->getMissions() as $mission) {
                switch($mission->getCategory()->getId()) {
                    case 1:
                        $assistanceNavire = $mission->getIndicateurs()->toArray();
                        break;
                    case 2:
                        $lutteImmigrationIllegale = $mission->getIndicateurs()->toArray();
                        break;
                    case 3:
                        $repressionPollution = $mission->getIndicateurs()->toArray();
                        break;
                    case 4:
                        $pecheIllegale = $mission->getIndicateurs()->toArray();
                        break;
                    case 5:
                        $surveillanceEnv = $mission->getIndicateurs()->toArray();
                        break;
                    case 6:
                        $sureteMaritime = $mission->getIndicateurs()->toArray();
                        break;
                    case 7:
                        $interetsNationaux = $mission->getIndicateurs()->toArray();
                        break;
                }
            }
            $mois[] = $rapport->getStartDatetime()->format('F Y');
            $filler->fillCells($sheet, self::ROW_ASSISTANCE_NAVIRE, $assistanceNavire, $merge);
            $filler->fillCells($sheet, self::ROW_INTERETS_NATIONAUX, $interetsNationaux, $merge);
            $filler->fillCells($sheet, self::ROW_LUTTE_IMMIGRATION_ILLEGALE, $lutteImmigrationIllegale, $merge);
            $filler->fillCells($sheet, self::ROW_REPRESSION_POLLUTION, $repressionPollution, $merge);
            $filler->fillCells($sheet, self::ROW_PECHE_ILLEGALE, $pecheIllegale, $merge);
            $filler->fillCells($sheet, self::ROW_SURVEILLANCE_ENVIRONNEMENT, $surveillanceEnv, $merge);
            $filler->fillCells($sheet, self::ROW_SURETE_MARITIME, $sureteMaritime, $merge);
            $sheet->setCellValue('B9', $rapport->getCreatedBy()->getNom());
        }

        $sheetIndex = $spreadsheet->getIndex(
            $spreadsheet->getSheetByName('template')
        );
        $spreadsheet->removeSheetByIndex($sheetIndex);
        return $spreadsheet;
    }

    /**
     * @param string $rapportID
     * @param bool   $draft
     *
     * @return TemplateProcessor
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function exportRapportDocx(string $rapportID, bool $draft = false) : TemplateProcessor
    {
        $filler = new OfficeFiller();
        $rapport = $draft ? $this->draftRepository->findRapport($rapportID) : $this->rapportRepository->find($rapportID);

        $templateProcessor = new TemplateProcessor(dirname(__DIR__) . '/PAM/samples/SAMPLE_Rapport_mission.docx');
        $templateProcessor->setValues([
            'dateDebut' => $rapport->getStartDatetime()->format('d/m/Y'),
            'dateFin' => $rapport->getEndDatetime()->format('d/m/Y'),
            'numRapport' => $rapportID,
            'navEff' => $rapport->getNavEff(),
            'mouillage' => $rapport->getMouillage(),
            'maintenance' => $rapport->getMaintenance(),
            'meteo' => $rapport->getMeteo(),
            'representation' => $rapport->getRepresentation(),
            'admin' => $rapport->getAdministratif(),
            'autre' => $rapport->getAutre(),
            'technique' => $rapport->getTechnique(),
            'personnel' => $rapport->getPersonnel(),
            'nbJoursMer' => $rapport->getNbJoursMer(),
            'distance' => $rapport->getDistance(),
            'essence' => $rapport->getEssence(),
            'goMarine' => $rapport->getGoMarine(),
            'totalPresenceMer' => $rapport->getTotalPresenceMer(),
            'totalPresenceQuai' => $rapport->getTotalPresenceAQuai(),
            'totalIndisponibilite' => $rapport->getTotalIndisponibilite(),
            'dureeMission' => $rapport->getDureeMission()
        ]);
        $tableEquipage = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 8000, 'unit' => TblWidth::TWIP]);
        $tableMerPlaisancePro = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 8000, 'unit' => TblWidth::TWIP]);
        $tableAutreMission = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 8000, 'unit' => TblWidth::TWIP]);
        $tableMerNavirePlaisanceLoisir = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 8000, 'unit' => TblWidth::TWIP]);
        $tableTerrePechePro = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 8000, 'unit' => TblWidth::TWIP]);
        $tableMerPechePro = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 8000, 'unit' => TblWidth::AUTO]);
        $tableTerrePlaisancePro = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 8000, 'unit' => TblWidth::AUTO]);
        $tableTerrePlaisanceLoisir = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 8000, 'unit' => TblWidth::AUTO]);

        $controleMerPechePro = [];
        $controleMerPlaisancePro = [];
        $controleMerNavirePlaisanceLoisir = [];
        $controleTerrePechePro = [];
        $autreMission = [];
        $controleTerrePlaisancePro = [];
        $controleTerrePlaisanceLoisir = [];

        foreach($rapport->getControles() as $controle)
        {
            switch($controle->getCategory()->getId()) {
                case 1:
                    $controleMerPechePro[] = $controle;
                    break;
                case 2:
                    $controleMerPlaisancePro[] = $controle;
                    break;
                case 3:
                    $controleMerNavirePlaisanceLoisir[] = $controle;
                    break;
                case 4:
                    $controleTerrePechePro[] = $controle;
                    break;
                case 5:
                    $autreMission[] = $controle;
                    break;
                case 6:
                    $controleTerrePlaisanceLoisir[] = $controle;
                    break;
                case 7:
                    $controleTerrePlaisancePro[] = $controle;
                    break;
            }
        }

        $filler->fillTabsControle($controleTerrePechePro, $tableTerrePechePro, 'Contrôles à terre navires de pêche professionnels');
        $filler->fillTabsControle($controleMerNavirePlaisanceLoisir, $tableMerNavirePlaisanceLoisir, 'Contrôles en mer navires de plaisance (loisir)');
        $filler->fillTabsControle($controleMerPlaisancePro, $tableMerPlaisancePro, 'Contrôles en mer navires de plaisance professionnelle');
        $filler->fillTabsControle($autreMission, $tableAutreMission, 'Autres missions');
        $filler->fillTabsControle($controleMerPechePro, $tableMerPechePro, 'Contrôles en mer navires de pêche professionnelle');
        $filler->fillTabsControle($controleTerrePlaisanceLoisir,$tableTerrePlaisanceLoisir, 'Contrôle à terre de navires de plaisance de loisir');
        $filler->fillTabsControle($controleTerrePlaisancePro, $tableTerrePlaisancePro, 'Contrôle à terre de navires de plaisance professionnel');

        $filler->fillTabsEquipage($rapport->getEquipage(), $tableEquipage);

        $templateProcessor->setComplexBlock('table_controleMerPechePro', $tableMerPechePro);
        $templateProcessor->setComplexBlock('table_controleMerNavirePlaisanceLoisir', $tableMerNavirePlaisanceLoisir);
        $templateProcessor->setComplexBlock('table_controleMerPlaisanceProPro', $tableMerPlaisancePro);
        $templateProcessor->setComplexBlock('table_controleAutreMission', $tableAutreMission);
        $templateProcessor->setComplexBlock('table_controleTerrePechePro', $tableTerrePechePro);
        $templateProcessor->setComplexBlock('table_controleTerrePlaisancePro', $tableTerrePlaisancePro);
        $templateProcessor->setComplexBlock('table_controleTerrePlaisanceLoisir', $tableTerrePlaisanceLoisir);
        $templateProcessor->setComplexBlock('table_equipage', $tableEquipage);
        return $templateProcessor;
    }

    /**
     * @param array     $indicateurs
     * @param Worksheet $sheet
     */
    private function fillAEM(array $indicateurs, Worksheet $sheet)
    {
        $filler = new OfficeFiller();
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

        $filler->fillCells($sheet, self::ROW_ASSISTANCE_NAVIRE, $assistanceNavire);
        $filler->fillCells($sheet, self::ROW_INTERETS_NATIONAUX, $interetsNationaux);
        $filler->fillCells($sheet, self::ROW_LUTTE_IMMIGRATION_ILLEGALE, $lutteImmigrationIllegale);
        $filler->fillCells($sheet, self::ROW_REPRESSION_POLLUTION, $repressionPollution);
        $filler->fillCells($sheet, self::ROW_PECHE_ILLEGALE, $pecheIllegale);
        $filler->fillCells($sheet, self::ROW_SURVEILLANCE_ENVIRONNEMENT, $surveillanceEnv);
        $filler->fillCells($sheet, self::ROW_SURETE_MARITIME, $sureteMaritime);
    }
}

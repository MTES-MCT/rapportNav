<?php

namespace App\Service\PAM;

use App\Entity\PAM\PamControle;
use App\Entity\PAM\PamEquipage;
use App\Entity\PAM\PamIndicateur;
use App\Repository\PAM\PamDraftRepository;
use App\Repository\PAM\PamIndicateurRepository;
use App\Repository\PAM\PamRapportRepository;
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
    public function exportOds(string $rapportID, bool $draft = false) : Spreadsheet
    {
        $indicateurs = $draft ? $this->draftRepository->findAllIndicateursByRapport($rapportID) : $this->indicateurRepository->findAllByRapport($rapportID);
        $spreadsheet = IOFactory::load(dirname(__DIR__) . '/PAM/samples/SAMPLE_THEMIS_A_ANNEXE Suivi_Mensuel.xlsx');
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

        $controleMerPechePro = [];
        $controleMerPlaisancePro = [];
        $controleMerNavirePlaisanceLoisir = [];
        $controleTerrePechePro = [];
        $autreMission = [];

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
            }
        }

        $this->fillTabsControle($controleTerrePechePro, $tableTerrePechePro, 'Contrôles à terre navires de pêche professionnels');
        $this->fillTabsControle($controleMerNavirePlaisanceLoisir, $tableMerNavirePlaisanceLoisir, 'Contrôles en mer navires de plaisance (loisir)');
        $this->fillTabsControle($controleMerPlaisancePro, $tableMerPlaisancePro, 'Contrôles en mer navires de plaisance professionnelle');
        $this->fillTabsControle($autreMission, $tableAutreMission, 'Autres missions');
        $this->fillTabsControle($controleMerPechePro, $tableMerPechePro, 'Contrôles en mer navires de pêche professionnelle');

        $this->fillTabsEquipage($rapport->getEquipage(), $tableEquipage);

        $templateProcessor->setComplexBlock('table_controleMerPechePro', $tableMerPechePro);
        $templateProcessor->setComplexBlock('table_controleMerNavirePlaisanceLoisir', $tableMerNavirePlaisanceLoisir);
        $templateProcessor->setComplexBlock('table_controleMerPlaisanceProPro', $tableMerPlaisancePro);
        $templateProcessor->setComplexBlock('table_controleAutreMission', $tableAutreMission);
        $templateProcessor->setComplexBlock('table_controleTerrePechePro', $tableTerrePechePro);
        $templateProcessor->setComplexBlock('table_equipage', $tableEquipage);
        return $templateProcessor;
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

    /**
     * @param PamControle[] $controles
     * @param Table         $table
     * @param string        $title
     */
    private function fillTabsControle(array $controles,Table $table, string $title): void
    {
        $table->addRow();
        $table->addCell(1000, [
            'bgColor' => '#cecece'
        ])->addText($title, [
            'size' => 8,
            'name' => 'Arial',
            'bgColor' => '#cecece',
        ]);
        $table->addCell(208, [
            'bgColor' => '#FFFFB2'
        ])->addText('Nbre Navires contrôlés', [
            'size' => 8,
            'name' => 'Arial',
        ]);
        $this->addCell($table, 208, 'Nbre PV pêche sanitaire');
        $this->addCell($table, 208, 'Nbre PV équipmt sécu. permis nav.');
        $this->addCell($table, 208, 'Nbre PV titre navig. rôle/déc. eff');
        $this->addCell($table, 208, 'Nbre PV police navig.');
        $this->addCell($table, 208, 'Nbre PV envir. pollut.');
        $this->addCell($table, 208, 'Nbre PV autres');
        $this->addCell($table, 208, 'Nbre navires déroutés');
        $this->addCell($table, 208, 'Nbre navires Interrogés');

        foreach($controles as $controle) {
            $table->addRow();
            $this->addCell($table, 1000, $controle->getPavillon());
            $table->addCell(208, [
                'bgColor' => '#FFFFB2'
            ])->addText($controle->getNbNavireControle(), [
                'size' => 8,
                'name' => 'Arial',
            ]);
            $this->addCell($table, 208, $controle->getNbPvPecheSanitaire());
            $this->addCell($table, 208, $controle->getNbPvEquipementSecurite());
            $this->addCell($table, 208, $controle->getNbPvTitreNav());
            $this->addCell($table, 208, $controle->getNbPvPolice());
            $this->addCell($table, 208, $controle->getNbPvEnvPollution());
            $this->addCell($table, 208, $controle->getNbAutrePv());
            $this->addCell($table, 208, $controle->getNbNavDeroute());
            $this->addCell($table, 208, $controle->getNbNavInterroge());
        }
    }

    /**
     * @param PamEquipage $equipage
     * @param Table       $table
     */
    private function fillTabsEquipage(PamEquipage $equipage,Table $table): void
    {
        $table->addRow();
        $this->addCell($table, 1000, 'Fonction', 12);
        $this->addCell($table, 1000, 'Role', 12);
        $this->addCell($table, 1000, 'Observations', 12);;

        foreach($equipage->getMembres() as $membre)
        {
            $table->addRow();
            $this->addCell($table, 1000, $membre->getRole(), 12);
            $this->addCell($table, 1000, $membre->getAgent(), 12);
            $this->addCell($table, 1000, $membre->getObservations(), 12);
        }
    }

    /**
     * @param Table $table
     * @param int   $width
     * @param mixed $text
     * @param int   $fontSize
     */
    private function addCell(Table $table, int $width, $text, int $fontSize = 8): void
    {
        $table->addCell($width)->addText($text, [
            'size' => $fontSize,
            'name' => 'Arial'
        ]);
    }
}

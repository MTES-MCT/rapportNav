<?php

namespace App\Service\PAM;

use App\Entity\PAM\PamControle;
use App\Entity\PAM\PamEquipage;
use App\Entity\PAM\PamIndicateur;
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
    public function exportOds(string $rapportID, bool $draft = false) : Spreadsheet
    {
        $filler = new OfficeFiller();
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

        $filler->fillCells($sheet, self::ROW_ASSISTANCE_NAVIRE, $assistanceNavire);
        $filler->fillCells($sheet, self::ROW_INTERETS_NATIONAUX, $interetsNationaux);
        $filler->fillCells($sheet, self::ROW_LUTTE_IMMIGRATION_ILLEGALE, $lutteImmigrationIllegale);
        $filler->fillCells($sheet, self::ROW_REPRESSION_POLLUTION, $repressionPollution);
        $filler->fillCells($sheet, self::ROW_PECHE_ILLEGALE, $pecheIllegale);
        $filler->fillCells($sheet, self::ROW_SURVEILLANCE_ENVIRONNEMENT, $surveillanceEnv);
        $filler->fillCells($sheet, self::ROW_SURETE_MARITIME, $sureteMaritime);
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

        $filler->fillTabsControle($controleTerrePechePro, $tableTerrePechePro, 'Contrôles à terre navires de pêche professionnels');
        $filler->fillTabsControle($controleMerNavirePlaisanceLoisir, $tableMerNavirePlaisanceLoisir, 'Contrôles en mer navires de plaisance (loisir)');
        $filler->fillTabsControle($controleMerPlaisancePro, $tableMerPlaisancePro, 'Contrôles en mer navires de plaisance professionnelle');
        $filler->fillTabsControle($autreMission, $tableAutreMission, 'Autres missions');
        $filler->fillTabsControle($controleMerPechePro, $tableMerPechePro, 'Contrôles en mer navires de pêche professionnelle');

        $filler->fillTabsEquipage($rapport->getEquipage(), $tableEquipage);

        $templateProcessor->setComplexBlock('table_controleMerPechePro', $tableMerPechePro);
        $templateProcessor->setComplexBlock('table_controleMerNavirePlaisanceLoisir', $tableMerNavirePlaisanceLoisir);
        $templateProcessor->setComplexBlock('table_controleMerPlaisanceProPro', $tableMerPlaisancePro);
        $templateProcessor->setComplexBlock('table_controleAutreMission', $tableAutreMission);
        $templateProcessor->setComplexBlock('table_controleTerrePechePro', $tableTerrePechePro);
        $templateProcessor->setComplexBlock('table_equipage', $tableEquipage);
        return $templateProcessor;
    }


}

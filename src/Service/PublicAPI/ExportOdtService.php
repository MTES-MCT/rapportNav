<?php

namespace App\Service\PublicAPI;

use App\Request\PublicAPI\ExportOdtRequest;
use App\Service\PublicAPI\Utils\OfficeFiller;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use PhpOffice\PhpWord\TemplateProcessor;

class ExportOdtService {

  private string $templateDir;

  private OfficeFiller $filler;

  public function __construct(OfficeFiller $filler, string $project_dir) {
    $this->templateDir = $project_dir . '/templates/export/';
    $this->filler = $filler;

  }

  public function handleData(ExportOdtRequest $request)
  {

    $service = $request->getService();
    $copys = "";
    if(strpos($service, 'pam-jeanne-barret') !== false) {
      $copys = 'DIRM MEMN/DIAM/SRCAM';
    }
    if(strpos($service, 'pam-iris') !== false) {
      $copys = 'DIRM MEMN/DIAM/SRCAM';
    }
    if(strpos($service, 'pam-themis') !== false) {
      $copys = 'DIRM MEMN/DIAM/SRCAM';
    }
    if(strpos($service, 'pam-gyptis') !== false) {
      $copys = 'DIRM MEMN/DIAM/SRCAM';
    }

    $nauticalEventsInfo = $request->getNauticalEventsInfo() ?? [];
    $antiPollutionInfo = $request->getAntiPollutionInfo() ?? [];
    $rescueInfo = $request->getRescueInfo() ?? [];
    $vigimerInfo = $request->getVigimerInfo() ?? [];
    $traficSurveillanceInfo = $request->getTraficSurveillanceInfo() ?? [];

    $templateProcessor = new TemplateProcessor($this->templateDir . 'SAMPLE_Rapport_mission_rpn63.docx');

    $templateProcessor->setValues([
      'serviceNom' => $request->getService(),
      'numRapport' => $request->getId(),
      'dateDebut' => $request->getStartDateTime()->format('d/m/Y'),
      'heureDebut' => $request->getStartDateTime()->format('H:i'),
      'dateFin' => $request->getEndDateTime()->format('d/m/Y'),
      'heureFin' => $request->getEndDateTime()->format('H:i'),
      'navEff' => $request->getPresenceMer()['navigationEffective'],
      'mouillage' => $request->getPresenceMer()['mouillage'],
      'totalPresenceMer' => $request->getPresenceMer()['total'],
      'maintenance' => $request->getPresenceQuai()['maintenance'],
      'meteo' => $request->getPresenceQuai()['meteo'],
      'representation' => $request->getPresenceQuai()['representation'],
      'admin' => $request->getPresenceQuai()['adminFormation'],
      'autre' => $request->getPresenceQuai()['autre'],
      'contrPort' => $request->getPresenceQuai()['contrPol'],
      'totalPresenceQuai' => $request->getPresenceQuai()['total'],
      'technique' => $request->getIndisponibilite()['technique'],
      'personnel' => $request->getIndisponibilite()['personnel'],
      'totalIndisponibilite' => $request->getIndisponibilite()['total'],
      'nbJoursMer' => $request->getNbJoursMer(),
      'distance' => $request->getDistanceMilles(),
      'essence' => $request->getEssence(),
      'goMarine' => $request->getGoMarine(),
      'dureeMission' => $request->getDureeMission(),
      'destinataireCopies' => $copys,

      'rescueInfoCount' => $rescueInfo['count'] ?? '',
      'rescueInfoHours' => $rescueInfo['durationInHours'] ?? '',
      'nauticalEventsInfoCount' => $nauticalEventsInfo['count'] ?? '',
      'nauticalEventsInfoHours' => $nauticalEventsInfo['durationInHours'] ?? '',
      'antiPollutionInfoCount' => $antiPollutionInfo['count'] ?? '',
      'antiPollutionInfoHours' => $antiPollutionInfo['durationInHours'] ?? '',
      'baaemAndVigimerInfoCount' => $vigimerInfo['count'] ?? '',
      'baaemAndVigimerInfoHours' => $vigimerInfo['durationInHours'] ?? '',
      'baaemAndVigimerInfoShips' => $vigimerInfo['amountOfInterrogatedShips'] ?? '',
      'traficSurveillanceInfoCount' => $traficSurveillanceInfo['count'] ?? '',
      'traficSurveillanceInfoHours' => $traficSurveillanceInfo['durationInHours'] ?? '',
      'traficSurveillanceInfoShips' => $traficSurveillanceInfo['amountOfInterrogatedShips'] ?? '',

      /*'nomCommandant' => $nomCommandant,
      'roleBordee' => $bordee,*/
    ]);

    $tableEquipage = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 8000, 'unit' => TblWidth::TWIP]);

    $replacements = [];
    $i = 0;
    foreach($request->getTimeline() as $groupNote => $group) {
      $replacements[] = [
        'date' => '${date_'.$i.'}',
        'block_group_freenotes' => '${block_group_freenotes_'.$i.'}',
        '/block_group_freenotes' => '${/block_group_freenotes_'.$i.'}',
        'freenote_observations' => '${freenote_observations_'.$i . '}',
      ];
      $i++;
    }
    $templateProcessor->cloneBlock('block_group', count($replacements), true, false, $replacements);

    $i = 0;
    foreach($request->getTimeline() as $row) {
      $templateProcessor->setValue("date_$i", $row['date']);
      $i++;
    }


    $j = 0;
    $k = 0;
    foreach($request->getTimeline() as $groupNote => $group) {
      $freeNoteReplacements = [];
      foreach($group['freeNote'] as $freeNote) {
        $freeNoteReplacements[] = [
          'freenote_observations_' . $j => '${freenote_observations_'.$j.'_'.$k.'}',
        ];
        $k++;
      }
      $templateProcessor->cloneBlock('block_group_freenotes_' .$j, 1, true, false, $freeNoteReplacements);
      $j++;
    }

    $j = 0;
    $k = 0;
    foreach($request->getTimeline() as $row) {
      foreach($row['freeNote'] as $freeNote) {
        $templateProcessor->setValue("freenote_observations_$j" . "_$k", $freeNote['observations']);
        $k++;
      }
      $j++;
    }


    $this->filler->fillTabsEquipage($request->getCrew(), $tableEquipage);
    $templateProcessor->setComplexBlock('table_equipage', $tableEquipage);

    return $templateProcessor;
  }

}

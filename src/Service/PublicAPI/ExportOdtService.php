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

  public function __construct(string $templateDir, OfficeFiller $filler) {
    $this->templateDir = $templateDir;
    $this->filler = $filler;

  }

  public function handleData(ExportOdtRequest $request)
  {

    $templateProcessor = new TemplateProcessor($this->templateDir . 'SAMPLE_Rapport_mission_ULAM.docx');

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

  /*    'destinataireCopies' => $copys,
      'nomCommandant' => $nomCommandant,
      'roleBordee' => $bordee,*/
    ]);


    $tableEquipage = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 8000, 'unit' => TblWidth::TWIP]);

    $this->filler->fillTabsEquipage($request->getCrew(), $tableEquipage);

    $templateProcessor->setComplexBlock('table_equipage', $tableEquipage);
    return $templateProcessor;
  }

}

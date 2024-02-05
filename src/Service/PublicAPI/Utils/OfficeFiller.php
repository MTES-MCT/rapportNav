<?php

namespace App\Service\PublicAPI\Utils;

use App\Request\PublicAPI\EquipageRequest;
use PhpOffice\PhpWord\Element\Table;

class OfficeFiller
{

  /**
   * @param EquipageRequest[] $crew
   * @param Table $table
   *
   * @return void
   */
  public function fillTabsEquipage(array $crew,Table $table): void
  {
    $table->addRow();
    $this->addCell($table, 1000, 'Fonction', 12);
    $this->addCell($table, 1000, 'Nom', 12);
    $this->addCell($table, 1000, 'Observations', 12);;

    foreach($crew as $agent)
    {
      $table->addRow();
      $this->addCell($table, 1000, htmlspecialchars($agent->getRole(), ENT_COMPAT, 'UTF-8'), 12);
      $this->addCell($table, 1000, htmlspecialchars($agent->getNomAgent(), ENT_COMPAT, 'UTF-8'), 12);
      $this->addCell($table, 1000, htmlspecialchars($agent->getRole(), ENT_COMPAT, 'UTF-8'), 12);
    }
  }

}

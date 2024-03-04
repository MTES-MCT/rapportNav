<?php

namespace App\Service\PublicAPI\Utils;

use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\Text;

class OfficeFiller
{

  /**
   * @param array $crew
   * @param Table $table
   *
   * @return void
   */
  public function fillTabsEquipage(array $crew,Table $table): void
  {
    $text = new Text();
    $table->addRow();
    $this->addCell($table, 1000, 'Fonction', 12);
    $this->addCell($table, 1000, 'Nom', 12);
    $this->addCell($table, 1000, 'Observations', 12);
    foreach($crew as $agent)
    {
      $table->addRow();
      $this->addCell($table, 1000, htmlspecialchars($agent['role']['title'], ENT_COMPAT, 'UTF-8'), 12);
      $this->addCell($table, 1000, htmlspecialchars($agent['agent']['firstName'] . ' ' . $agent['agent']['lastName'], ENT_COMPAT, 'UTF-8'), 12);
      $this->addCell($table, 1000, htmlspecialchars($agent['comment'], ENT_COMPAT, 'UTF-8'), 12);
    }
  }

  /**
   * @param Table $table
   * @param int   $width
   * @param mixed $text
   * @param int   $fontSize
   */
  public function addCell(Table $table, int $width, $text, int $fontSize = 8): void
  {
    $table->addCell($width)->addText($text, [
      'size' => $fontSize,
      'name' => 'Arial'
    ]);
  }




}

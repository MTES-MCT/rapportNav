<?php

namespace App\Service\PAM\Utils;

use App\Entity\PAM\PamControle;
use App\Entity\PAM\PamEquipage;
use App\Entity\PAM\PamIndicateur;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpWord\Element\Table;

class OfficeFiller {

    const INDICATEUR_CATEGORY_TITLE_COL = 'A';
    const INDICATEUR_PRINCIPALE_COL = 'F';
    const INDICATEUR_SECONDAIRE_COL = 'G';
    const INDICATEUR_OBSERVATION_COL = 'I';

    /**
     * Rempli les cellules d'un tableur
     *
     * @param Worksheet       $sheet
     * @param int             $startRow
     * @param PamIndicateur[] $indicateurs
     * @param bool            $merge
     */
    public function fillCells(Worksheet $sheet, int $startRow, array $indicateurs, bool $merge = false): void
    {
        foreach($indicateurs as $key => $value) {
            $principale =  $value->getPrincipale();
            $secondaire =  $value->getSecondaire();
            $observations = $value->getObservations();

            $row = ($startRow + $key);
            $cellTitle = self::INDICATEUR_CATEGORY_TITLE_COL . $row;
            $cellPrincipale = self::INDICATEUR_PRINCIPALE_COL . $row;
            $cellSecondaire = self::INDICATEUR_SECONDAIRE_COL . $row;
            $cellObservation = self::INDICATEUR_OBSERVATION_COL . $row;

            if($merge) {
                $principale =  (int)$sheet->getCell($cellPrincipale)->getValue() + $value->getPrincipale();
                $secondaire =  (int)$sheet->getCell($cellSecondaire)->getValue() + $value->getSecondaire();
                $observations = $sheet->getCell($cellObservation)->getValue() ? $sheet->getCell($cellObservation)->getValue()  . ' / ' . $value->getObservations() : $value->getObservations();
            }

            $sheet->setCellValue($cellTitle, $value->getCategory()->getNom());
            $sheet->setCellValue($cellPrincipale, $principale);
            $sheet->setCellValue($cellSecondaire, $secondaire);
            $sheet->setCellValue($cellObservation, $observations);
        }
    }

    /**
     * @param PamControle[] $controles
     * @param Table         $table
     * @param string        $title
     */
    public function fillTabsControle(array $controles,Table $table, string $title): void
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
    public function fillTabsEquipage(PamEquipage $equipage,Table $table): void
    {
        $table->addRow();
        $this->addCell($table, 1000, 'Fonction', 12);
        $this->addCell($table, 1000, 'Role', 12);
        $this->addCell($table, 1000, 'Observations', 12);;

        foreach($equipage->getMembres() as $membre)
        {
            $table->addRow();
            $this->addCell($table, 1000, $membre->getFonction(), 12);
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
    public function addCell(Table $table, int $width, $text, int $fontSize = 8): void
    {
        $table->addCell($width)->addText($text, [
            'size' => $fontSize,
            'name' => 'Arial'
        ]);
    }

}

<?php

namespace App\Twig;

use App\Entity\NavPro\ControleLot;
use App\Entity\NavPro\ControleUnitaire;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{

    public function getFilters()
    {
        return [
            new TwigFilter('formatControleGM', [$this, 'formatControleGM']),
        ];
    }

    public function formatControleGM(string $value)
    {
        switch($value) {
            case ControleUnitaire::TYPE_CONTROLE_TERRAIN_QUAI:
                return 'Contrôle terrain à quai unitaire';
            case ControleUnitaire::TYPE_CONTROLE_TERRAIN_MER:
                return 'Contrôle terrain en mer unitaire';
            case ControleUnitaire::TYPE_CONTROLE_ADMINISTRATIF:
                return 'Contrôle administratif unitaire';
            case ControleLot::TYPE_CONTROLE_ADMINISTRATIF:
                return 'Contrôle administratif par lot';
        }

        return $value;
    }

}

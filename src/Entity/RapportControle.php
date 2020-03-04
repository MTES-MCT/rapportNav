<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait RapportControle {
    /**
     * @ORM\ManyToOne(targetEntity="CategorieMethodeCiblage")
     * @ORM\JoinColumn(nullable=true)
     */
    private $methodeCiblage;

    public function getMethodeCiblage(): ?CategorieMethodeCiblage {
        return $this->methodeCiblage;
    }

    public function setMethodeCiblage(CategorieMethodeCiblage $methodeCiblage): self {
        $this->methodeCiblage = $methodeCiblage;

        return $this;
    }

}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait RapportControle {
    /**
     * @ORM\ManyToOne(targetEntity="MethodeCiblage")
     * @ORM\JoinColumn(nullable=true)
     */
    private $methodeCiblage;

    public function getMethodeCiblage(): ?MethodeCiblage {
        return $this->methodeCiblage;
    }

    public function setMethodeCiblage(MethodeCiblage $methodeCiblage): self {
        $this->methodeCiblage = $methodeCiblage;

        return $this;
    }

}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait RapportControle {
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RapportMethodeCiblage")
     * @Assert\NotBlank()
     */
    private $methodeCiblage;

    public function getMethodeCiblage(): ?RapportMethodeCiblage {
        return $this->methodeCiblage;
    }

    public function setMethodeCiblage(RapportMethodeCiblage $methodeCiblage): self {
        $this->methodeCiblage = $methodeCiblage;

        return $this;
    }

}

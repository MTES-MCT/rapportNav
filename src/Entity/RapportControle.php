<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait RapportControle {
    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     *
     */
    private $methodeCiblage;

    public function getMethodeCiblage(): ?int {
        return $this->methodeCiblage;
    }

    public function setMethodeCiblage(int $methodeCiblage): self {
        $this->methodeCiblage = $methodeCiblage;

        return $this;
    }

}

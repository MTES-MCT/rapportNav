<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RapportAdministratifRepository")
 */
class RapportFormation extends Rapport {
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $formation;

    public function getFormation(): ?string {
        return $this->formation;
    }

    public function setFormation(?string $formation): self {
        $this->formation = $formation;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RapportAdministratifRepository")
 */
class RapportAdministratif extends Rapport {
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $activite;

    public function getActivite(): ?string {
        return $this->activite;
    }

    public function setActivite(?string $activite): self {
        $this->activite = $activite;

        return $this;
    }
}

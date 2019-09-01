<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MissionFormationRepository")
 */
class MissionFormation extends Mission {
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $formation;

    public function getControles() {
        return null;
    }

    public function jsonSerialize() {
        $data = parent::jsonSerialize();
        $data['formation'] = $this->getFormation();
        return $data;
    }

    public function getFormation(): ?string {
        return $this->formation;
    }

    public function setFormation(?string $formation): self {
        $this->formation = $formation;

        return $this;
    }
}

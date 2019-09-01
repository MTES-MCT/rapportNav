<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MissionAdministratifRepository")
 */
class MissionAdministratif extends Mission {
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $activite;


    public function jsonSerialize() {
        $data = parent::jsonSerialize();
        $data['activite'] = $this->getActivite();
        return $data;
    }


    public function getControles() {
        return null;
    }

    public function getActivite(): ?string {
        return $this->activite;
    }
    public function setActivite(?string $activite): self {
        $this->activite = $activite;

        return $this;
    }
}
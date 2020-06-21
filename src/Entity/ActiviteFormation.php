<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActiviteFormationRepository")
 */
class ActiviteFormation extends Activite {
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $formation;

    /**
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $formateur = false;

    public function getControles() {
        return null;
    }

    public function jsonSerialize() {
        $data = parent::jsonSerialize();
        $data = [
                'formation' => $this->getFormation(),
                'formateur' => $this->getFormateur()
                ];
        return $data;
    }

    public function getFormation(): ?string {
        return $this->formation;
    }

    public function setFormation(?string $formation): self {
        $this->formation = $formation;

        return $this;
    }

    public function getFormateur(): ?bool {
        return $this->formateur;
    }

    public function setFormateur(bool $formateur): self {
        $this->formateur = $formateur;

        return $this;
    }

}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RapportMoyenRepository")
 */
class RapportMoyen {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Rapport", inversedBy="moyens")
     * @ORM\JoinColumn(name="rapport_id", nullable=false)
     */
    private $rapport;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Moyen")
     * @ORM\JoinColumn(name="moyen_id", nullable=false)
     */
    private $moyen;

    /**
     * Distance in km
     * @ORM\Column(type="integer", nullable=true)
     */
    private $distance;

    /**
     * tempsMoteur in minutes
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tempsMoteur;

    public function getRapport(): ?Rapport {
        return $this->rapport;
    }

    public function setRapport(?Rapport $rapport): self {
        $this->rapport = $rapport;

        return $this;
    }

    public function getMoyen(): ?Moyen {
        return $this->moyen;
    }

    public function setMoyen(?Moyen $moyen): self {
        $this->moyen = $moyen;

        return $this;
    }

    public function getDistance(): ?int {
        return $this->distance;
    }

    public function setDistance(?int $distance): self {
        $this->distance = $distance;

        return $this;
    }

    public function getTempsMoteur(): ?int {
        return $this->tempsMoteur;
    }

    public function setTempsMoteur(?int $tempsMoteur): self {
        $this->tempsMoteur = $tempsMoteur;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ZoneGeographique")
     */
    private $zoneGeographique;

    public function __toString() {
        return $this->getNom();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(string $nom): self {
        $this->nom = $nom;

        return $this;
    }

    public function getZoneGeographique(): ?ZoneGeographique {
        return $this->zoneGeographique;
    }

    public function setZoneGeographique(?ZoneGeographique $zoneGeographique): self {
        $this->zoneGeographique = $zoneGeographique;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MoyenRepository")
 */
class Moyen {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Entity\Service")
     * @ORM\JoinColumn(nullable=false)
     */
    private $serviceProprietaire;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="boolean")
     */
    private $terrestre;

    /**
     * @ORM\ManyToOne(targetEntity="CategorieMoyen")
     * @ORM\JoinColumn(nullable=true)
     */
    private $typeNavire;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private $dateDebutService;

    /**
     * @ORM\Column(type="date_immutable", nullable=true)
     */
    private $dateFinService;

    public function __toString() {
        return $this->nom;
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

    public function getTypeNavire(): ?CategorieMoyen {
        return $this->typeNavire;
    }

    public function setTypeNavire(?CategorieMoyen $typeNavire): self {
        $this->typeNavire = $typeNavire;

        return $this;
    }

    public function getTerrestre(): ?bool {
        return $this->terrestre;
    }

    public function setTerrestre(bool $terrestre): self {
        $this->terrestre = $terrestre;

        return $this;
    }

    public function getServiceProprietaire(): ?Service {
        return $this->serviceProprietaire;
    }

    public function setServiceProprietaire(?Service $serviceProprietaire): self {
        $this->serviceProprietaire = $serviceProprietaire;

        return $this;
    }

    public function getDateDebutService(): ?\DateTimeImmutable
    {
        return $this->dateDebutService;
    }

    public function setDateDebutService(\DateTimeImmutable $dateDebutService): self
    {
        $this->dateDebutService = $dateDebutService;

        return $this;
    }

    public function getDateFinService(): ?\DateTimeImmutable
    {
        return $this->dateFinService;
    }

    public function setDateFinService(?\DateTimeImmutable $dateFinService): self
    {
        $this->dateFinService = $dateFinService;

        return $this;
    }
}

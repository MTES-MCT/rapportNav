<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NavireRepository")
 */
class Navire implements JsonSerializable {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Assert\Length(min = 1)
     */
    private $immatriculation;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $etranger = false;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank
     */
    private $pavillon = "Français";

    /**
     * Identifiant du référentiel Flotteur
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_nav_flotteur;

    /**
     * @ORM\Column(type="string", length=45, nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(min = 1, max = 45)
     */
    private $nom;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longueurHorsTout;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Assert\Length(min = 1, max = 45)
     */
    private $genreNav = "Inconnu";

    /**
     * @ORM\ManyToOne(targetEntity="CategorieUsageNavire")
     */
    private $categorieUsageNavire;

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'immatriculation' => $this->getImmatriculation(),
            'etranger' => $this->getEtranger(),
            'pavillon' => $this->getPavillon(),
            'nom' => $this->getNom(),
            'longueurHorsTout' => $this->getLongueurHorsTout(),
            'genreNav' => $this->getGenreNav(),
            'categorieUsageNavire' => (null === $this->getCategorieUsageNavire()) ? null : $this->getCategorieUsageNavire()->getId(),
        ];
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getImmatriculation(): ?string {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): self {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getIdNavFlotteur(): ?int {
        return $this->id_nav_flotteur;
    }

    public function setIdNavFlotteur(?int $id_nav_flotteur): self {
        $this->id_nav_flotteur = $id_nav_flotteur;

        return $this;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(?string $nom): self {
        $this->nom = $nom;

        return $this;
    }

    public function getLongueurHorsTout(): ?float {
        return $this->longueurHorsTout;
    }

    public function setLongueurHorsTout(?float $longueurHorsTout): self {
        $this->longueurHorsTout = $longueurHorsTout;

        return $this;
    }

    public function getGenreNav(): ?string {
        return $this->genreNav;
    }

    public function setGenreNav(?string $genreNav): self {
        $this->genreNav = $genreNav;
        return $this;
    }

    public function getEtranger(): ?bool {
        return $this->etranger;
    }

    public function setEtranger(bool $etranger): self {
        $this->etranger = $etranger;

        return $this;
    }

    public function getPavillon(): ?string {
        return $this->pavillon;
    }

    public function setPavillon(?string $pavillon): self {
        $this->pavillon = $pavillon;

        return $this;
    }

    public function getCategorieUsageNavire(): ?CategorieUsageNavire {
        return $this->categorieUsageNavire;
    }

    public function setCategorieUsageNavire(?CategorieUsageNavire $categorieUsageNavire): self {
        $this->categorieUsageNavire = $categorieUsageNavire;

        return $this;
    }

    public function __toString() {
        return $this->getNom() . ' - ' . $this->getImmatriculation();
    }
}

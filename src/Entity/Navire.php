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
     * TODO : rename to immatriculation
     */
    private $immatriculation_fr;

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
    private $typeUsage = "Inconnu";

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieControleNavire")
     */
    private $categorieControleNavire;

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'immatriculationFr' => $this->getImmatriculationFr(),
            'etranger' => $this->getEtranger(),
            'pavillon' => $this->getPavillon(),
            'nom' => $this->getNom(),
            'longueurHorsTout' => $this->getLongueurHorsTout(),
            'typeUsage' => $this->getTypeUsage(),
            'categorieControleNavire' => (null === $this->getCategorieControleNavire()) ? null : $this->getCategorieControleNavire()->getId(),
        ];
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getImmatriculationFr(): ?string {
        return $this->immatriculation_fr;
    }

    public function setImmatriculationFr(string $immatriculation_fr): self {
        $this->immatriculation_fr = $immatriculation_fr;

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

    public function getTypeUsage(): ?string {
        return $this->typeUsage;
    }

    public function setTypeUsage(?string $typeUsage): self {
        $this->typeUsage = $typeUsage;
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

    public function getCategorieControleNavire(): ?CategorieControleNavire {
        return $this->categorieControleNavire;
    }

    public function setCategorieControleNavire(?CategorieControleNavire $categorieControleNavire): self {
        $this->categorieControleNavire = $categorieControleNavire;

        return $this;
    }
}

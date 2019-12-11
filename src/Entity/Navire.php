<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NavireRepository")
 */
class  Navire implements JsonSerializable {
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
    private $immatriculation_fr;

    /**
     * Identifiant du référentiel Flotteur
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_nav_flotteur;

    /**
     * @ORM\Column(type="string", length=45)
     * @Assert\NotBlank
     * @Assert\Length(min = 1, max = 45)
     */
    private $nom;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longueurHorsTout;

    /**
     * @ORM\Column(type="string", length=45)
     * @Assert\NotBlank
     * @Assert\Length(min = 1, max = 45)
     */
    private $typeUsage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isErreur = false;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $erreurTexte;

    public function jsonSerialize() {
        $data = [];
        $data['immatriculationFr'] = $this->getImmatriculationFr();
        $data['nom'] = $this->getNom();
        $data['longueurHorsTout'] = $this->getLongueurHorsTout();
        $data['typeUsage'] = $this->getTypeUsage();

        return $data;
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

    public function getIsErreur(): bool {
        return $this->isErreur;
    }

    public function setIsErreur($isErreur): self {
        $this->isErreur = $isErreur;
        return $this;
    }

    public function getErreurTexte(): ?string {
        return $this->erreurTexte;
    }

    public function setErreurTexte($erreurTexte): self {
        $this->erreurTexte = $erreurTexte;
        return $this;
    }
}

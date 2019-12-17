<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtablissementRepository")
 */
class Etablissement implements JsonSerializable {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieEtablissement")
     * @Assert\NotBlank
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commune;

    public function jsonSerialize() {
        return ['id' => $this->getId(),
            'type' => $this->getType()->getId(),
            'nom' => $this->getNom(),
            'adresse' => $this->getAdresse(),
            'commune' => $this->getCommune()
        ];
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getType(): ?CategorieEtablissement {
        return $this->type;
    }

    public function setType(CategorieEtablissement $type): self {
        $this->type = $type;

        return $this;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(string $nom): self {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCommune(): ?string {
        return $this->commune;
    }

    public function setCommune(?string $commune): self {
        $this->commune = $commune;

        return $this;
    }
}

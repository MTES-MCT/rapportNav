<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TacheRepository")
 */
class Tache implements JsonSerializable {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $complementDonnee;

    /**
     * @ORM\Column(type="text")
     */
    private $nom;

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'nom' => $this->getNom()
        ];
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

    public function getComplementDonnee(): ?string {
        return $this->complementDonnee;
    }

    public function setComplementDonnee(string $complementDonnee): self {
        $this->complementDonnee = $complementDonnee;

        return $this;
    }
}

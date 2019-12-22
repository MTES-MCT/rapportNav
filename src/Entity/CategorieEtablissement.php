<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieEtablissementRepository")
 */
class CategorieEtablissement {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $complementDonnee;

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

    public function setComplementDonnee(?string $complementDonnee): self {
        $this->complementDonnee = $complementDonnee;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ZoneGeographiqueRepository")
 */
class ZoneGeographique {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $alias;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $direction;

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

    public function getAlias(): ?string {
        return $this->alias;
    }

    public function setAlias(?string $alias): self {
        $this->alias = $alias;

        return $this;
    }

    public function getDirection(): ?string {
        return $this->direction;
    }

    public function setDirection(string $direction): self {
        $this->direction = $direction;

        return $this;
    }
}

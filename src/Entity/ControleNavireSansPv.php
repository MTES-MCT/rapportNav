<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ControleNavireRepository")
 */
class ControleNavireSansPv implements JsonSerializable {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CategorieControleNavire")
     */
    private $controlesRealises;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreControle;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreControleAireProtegee;

    public function jsonSerialize() {
        $data = [
            'nombreControle' => $this->getNombreControle(),
            'nombreControleAireProtegee' => $this->getNombreControleAireProtegee()
        ];
        $data['controles'] = [];
        foreach($this->getControlesRealises() as $controle) {
            $data['controles'][] = $controle->getId();
        }
        return $data;
    }

    public function __construct()
    {
        $this->controlesRealises = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNombreControle(): ?int {
        return $this->nombreControle;
    }

    public function setNombreControle(int $nombreControle): self {
        $this->nombreControle = $nombreControle;

        return $this;
    }

    public function getNombreControleAireProtegee(): ?int {
        return $this->nombreControleAireProtegee;
    }

    public function setNombreControleAireProtegee(?int $nombreControleAireProtegee): self {
        $this->nombreControleAireProtegee = $nombreControleAireProtegee;

        return $this;
    }

    /**
     * @return Collection|CategorieControleNavire[]
     */
    public function getControlesRealises(): Collection
    {
        return $this->controlesRealises;
    }

    public function addControleRealise(CategorieControleNavire $controle): self
    {
        if (!$this->controlesRealises->contains($controle)) {
            $this->controlesRealises[] = $controle;
        }

        return $this;
    }

    public function removeControleRealise(CategorieControleNavire $controle): self
    {
        if ($this->controlesRealises->contains($controle)) {
            $this->controlesRealises->removeElement($controle);
        }

        return $this;
    }
}

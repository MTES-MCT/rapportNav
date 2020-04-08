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
    private $controleNavireRealises;

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
        $data['controleNavireRealises'] = [];
        foreach($this->getControleNavireRealises() as $controle) {
            $data['controleNavireRealises'][] = $controle->getId();
        }
        return $data;
    }

    public function __construct()
    {
        $this->controleNavireRealises = new ArrayCollection();
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
    public function getControleNavireRealises(): Collection
    {
        return $this->controleNavireRealises;
    }

    public function addControleNavireRealise(CategorieControleNavire $controleNavire): self
    {
        if (!$this->controleNavireRealises->contains($controleNavire)) {
            $this->controleNavireRealises[] = $controleNavire;
        }

        return $this;
    }

    public function removeControleNavireRealise(CategorieControleNavire $controleNavire): self
    {
        if ($this->controleNavireRealises->contains($controleNavire)) {
            $this->controleNavireRealises->removeElement($controleNavire);
        }

        return $this;
    }
}

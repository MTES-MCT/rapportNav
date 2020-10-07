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
    private $nombreControleMer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreControleTerre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreControleAireProtegee;

    public function jsonSerialize() {
        $data = [
            'nombreControleMer' => $this->getNombreControleMer(),
            'nombreControleTerre' => $this->getNombreControleTerre(),
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

    public function getNombreControleMer(): ?int {
        return $this->nombreControleMer;
    }

    public function setNombreControleMer(int $nombreControleMer): self {
        $this->nombreControleMer = $nombreControleMer;

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

    public function getNombreControleTerre(): ?int
    {
        return $this->nombreControleTerre;
    }

    public function setNombreControleTerre(?int $nombreControleTerre): self
    {
        $this->nombreControleTerre = $nombreControleTerre;

        return $this;
    }
}

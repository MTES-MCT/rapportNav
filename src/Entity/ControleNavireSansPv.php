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
     * @ORM\ManyToMany(targetEntity="App\Entity\RapportNavireControle")
     */
    private $controles;

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
        foreach($this->getControles() as $controle) {
            $data['controles'][] = $controle->getId();
        }
        return $data;
    }

    public function __construct()
    {
        $this->controles = new ArrayCollection();
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

    public function getMission(): ?MissionNavire
    {
        return $this->mission;
    }

    public function setMission(MissionNavire $mission): self
    {
        $this->mission = $mission;

        // set the owning side of the relation if necessary
        if ($mission->getControleSansPv() !== $this) {
            $mission->setControleSansPv($this);
        }

        return $this;
    }

    /**
     * @return Collection|RapportNavireControle[]
     */
    public function getControles(): Collection
    {
        return $this->controles;
    }

    public function addControle(RapportNavireControle $controle): self
    {
        if (!$this->controles->contains($controle)) {
            $this->controles[] = $controle;
        }

        return $this;
    }

    public function removeControle(RapportNavireControle $controle): self
    {
        if ($this->controles->contains($controle)) {
            $this->controles->removeElement($controle);
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MissionNavireRepository")
 */
class MissionNavire extends Mission {
    /**
     * @ORM\OneToMany(targetEntity="ControleNavire", mappedBy="rapport", cascade={"persist"}, orphanRemoval=true)
     * @Assert\Valid
     */
    private $navires;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeMissionControle")
     */
    private $typeMissionControle;

    public function getControles() {
        return $this->getNavires();
    }

    public function __construct() {
        parent::__construct();
        $this->navires = new ArrayCollection();
    }

    public function jsonSerialize() {
        $data = parent::jsonSerialize();
        $data['typeMissionControle'] = $this->getTypeMissionControle()->getId();
        $data['controles'] = [];
        foreach($this->getNavires() as $navire) {
            $data['controles'][] = $navire;
        }
        return $data;
    }

    /**
     * @return Collection|ControleNavire[]
     */
    public function getNavires(): Collection {
        return $this->navires;
    }

    public function addNavire(ControleNavire $navire): self {
        if(!$this->navires->contains($navire)) {
            $this->navires[] = $navire;
            $navire->setRapport($this);
        }

        return $this;
    }

    public function removeNavire(ControleNavire $navire): self {
        if($this->navires->contains($navire)) {
            $this->navires->removeElement($navire);
            // set the owning side to null (unless already changed)
            if($navire->getRapport() === $this) {
                $navire->setRapport(null);
            }
        }

        return $this;
    }

    public function getTypeMissionControle(): ?TypeMissionControle {
        return $this->typeMissionControle;
    }

    public function setTypeMissionControle(?TypeMissionControle $typeMissionControle): self {
        $this->typeMissionControle = $typeMissionControle;

        return $this;
    }
}

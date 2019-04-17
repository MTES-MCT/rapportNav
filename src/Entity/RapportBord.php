<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RapportBordRepository")
 */
class RapportBord extends Rapport {
    /**
     * @ORM\OneToMany(targetEntity="RapportNavire", mappedBy="rapport", cascade={"persist"})
     * @Assert\Valid
     */
    private $navires;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $typeMission;

    public function __construct() {
        parent::__construct();
        $this->navires = new ArrayCollection();
    }

    /**
     * @return Collection|RapportNavire[]
     */
    public function getNavires(): Collection {
        return $this->navires;
    }

    public function addNavire(RapportNavire $navire): self {
        if(!$this->navires->contains($navire)) {
            $this->navires[] = $navire;
            $navire->setRapport($this);
        }

        return $this;
    }

    public function removeNavire(RapportNavire $navire): self {
        if($this->navires->contains($navire)) {
            $this->navires->removeElement($navire);
            // set the owning side to null (unless already changed)
            if($navire->getRapport() === $this) {
                $navire->setRapport(null);
            }
        }

        return $this;
    }

    public function getTypeMission(): ?int {
        return $this->typeMission;
    }

    public function setTypeMission(int $typeMission): self {
        $this->typeMission = $typeMission;

        return $this;
    }
}

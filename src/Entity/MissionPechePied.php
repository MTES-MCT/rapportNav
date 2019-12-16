<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MissionPechePiedRepository")
 */
class MissionPechePied extends Mission {
    /**
     * @ORM\OneToMany(targetEntity="ControlePecheurPied", mappedBy="rapport", cascade={"persist", "remove"},
     *                                                    orphanRemoval=true)
     * @Assert\Valid
     */
    private $pecheursPied;

    public function getControles() {
        return $this->getPecheursPied();
    }

    public function __construct() {
        parent::__construct();
        $this->pecheursPied = new ArrayCollection();
    }

    public function jsonSerialize() {
        $data = parent::jsonSerialize();
        $data['controles'] = $this->getPecheursPied()->toArray();
        return $data;
    }

    /**
     * @return Collection|ControlePecheurPied[]
     */
    public function getPecheursPied(): Collection {
        return $this->pecheursPied;
    }

    public function addPecheursPied(ControlePecheurPied $pecheursPied): self {
        if(!$this->pecheursPied->contains($pecheursPied)) {
            $this->pecheursPied[] = $pecheursPied;
            $pecheursPied->setRapport($this);
        }

        return $this;
    }

    public function removePecheursPied(ControlePecheurPied $pecheursPied): self {
        if($this->pecheursPied->contains($pecheursPied)) {
            $this->pecheursPied->removeElement($pecheursPied);
            // set the owning side to null (unless already changed)
            if($pecheursPied->getRapport() === $this) {
                $pecheursPied->setRapport(null);
            }
        }

        return $this;
    }
}

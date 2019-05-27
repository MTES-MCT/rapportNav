<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RapportPechePiedRepository")
 */
class RapportPechePied extends Rapport {
    use RapportControle;

    /**
     * @ORM\OneToMany(targetEntity="RapportPecheurPied", mappedBy="rapport", cascade={"persist"})
     * @Assert\Valid
     */
    private $pecheursPied;

    public function __construct() {
        parent::__construct();
        $this->pecheursPied = new ArrayCollection();
    }

    /**
     * @return Collection|RapportPecheurPied[]
     */
    public function getPecheursPied(): Collection {
        return $this->pecheursPied;
    }

    public function addPecheursPied(RapportPecheurPied $pecheursPied): self {
        if(!$this->pecheursPied->contains($pecheursPied)) {
            $this->pecheursPied[] = $pecheursPied;
            $pecheursPied->setRapport($this);
        }

        return $this;
    }

    public function removePecheursPied(RapportPecheurPied $pecheursPied): self {
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

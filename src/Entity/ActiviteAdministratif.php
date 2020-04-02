<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ActiviteAdministratifRepository")
 */
class ActiviteAdministratif extends Activite {
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ControleTache", mappedBy="rapport", orphanRemoval=true,
     *                                                         cascade={"persist", "remove"})
     */
    private $taches;

    public function __construct() {
        parent::__construct();
        $this->taches = new ArrayCollection();
    }


    public function jsonSerialize() {
        $data = parent::jsonSerialize();
        $data['controles'] = $this->getTaches()->toArray();
        return $data;
    }


    public function getControles() {
        return $this->getTaches();
    }

    /**
     * @return Collection|ControleTache[]
     */
    public function getTaches(): Collection {
        return $this->taches;
    }

    public function addTache(ControleTache $tache): self {
        if(!$this->taches->contains($tache)) {
            $this->taches[] = $tache;
            $tache->setRapport($this);
        }

        return $this;
    }

    public function removeTache(ControleTache $tache): self {
        if($this->taches->contains($tache)) {
            $this->taches->removeElement($tache);
            // set the owning side to null (unless already changed)
            if($tache->getRapport() === $this) {
                $tache->setRapport(null);
            }
        }

        return $this;
    }
}
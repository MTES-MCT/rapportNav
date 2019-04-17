<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RapportCommerceRepository")
 */
class RapportCommerce extends Rapport {
    /**
     * @ORM\OneToMany(targetEntity="RapportEtablissement", mappedBy="rapport", cascade={"persist"})
     * @Assert\Valid
     */
    private $etablissements;

    public function __construct() {
        parent::__construct();
        $this->etablissements = new ArrayCollection();
    }

    /**
     * @return Collection|RapportEtablissement[]
     */
    public function getEtablissements(): Collection {
        return $this->etablissements;
    }

    public function addEtablissement(RapportEtablissement $etablissement): self {
        if(!$this->etablissements->contains($etablissement)) {
            $this->etablissements[] = $etablissement;
            $etablissement->setRapport($this);
        }

        return $this;
    }

    public function removeEtablissement(RapportEtablissement $etablissement): self {
        if($this->etablissements->contains($etablissement)) {
            $this->etablissements->removeElement($etablissement);
            // set the owning side to null (unless already changed)
            if($etablissement->getRapport() === $this) {
                $etablissement->setRapport(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActiviteCommerceRepository")
 */
class ActiviteCommerce extends Activite {
    /**
     * @ORM\OneToMany(targetEntity="ControleEtablissement", mappedBy="activite", cascade={"persist", "remove"},
     *                                                      orphanRemoval=true)
     * @Assert\Valid
     */
    private $etablissements;

    public function getControles() {
        return $this->getEtablissements();
    }

    public function __construct() {
        parent::__construct();
        $this->etablissements = new ArrayCollection();
    }

    public function jsonSerialize() {
        $data = parent::jsonSerialize();
        $data['controles'] = $this->getEtablissements()->toArray();

        return $data;
    }

    /**
     * @return Collection|ControleEtablissement[]
     */
    public function getEtablissements(): Collection {
        return $this->etablissements;
    }

    public function addEtablissement(ControleEtablissement $etablissement): self {
        if(!$this->etablissements->contains($etablissement)) {
            $this->etablissements[] = $etablissement;
            $etablissement->setActivite($this);
        }

        return $this;
    }

    public function removeEtablissement(ControleEtablissement $etablissement): self {
        if($this->etablissements->contains($etablissement)) {
            $this->etablissements->removeElement($etablissement);
            // set the owning side to null (unless already changed)
            if($etablissement->getActivite() === $this) {
                $etablissement->setActivite(null);
            }
        }

        return $this;
    }
}

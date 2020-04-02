<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivitePechePiedRepository")
 */
class ActivitePechePied extends Activite {
    /**
     * @ORM\OneToMany(targetEntity="ControlePecheurPied", mappedBy="activite", cascade={"persist", "remove"},
     *                                                    orphanRemoval=true)
     * @Assert\Valid
     */
    private $pecheursPied;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ControlePecheurPiedSansPv", cascade={"persist", "remove"})
     */
    private $controleProSansPv;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ControlePecheurPiedSansPv", cascade={"persist", "remove"})
     */
    private $controlePlaisanceSansPv;

    public function getControles() {
        return $this->getPecheursPied();
    }

    public function __construct() {
        parent::__construct();
        $this->pecheursPied = new ArrayCollection();
        $this->controleProSansPv = new ControlePecheurPiedSansPv();
        $this->controleProSansPv->setProfessionnel(true);
        $this->controlePlaisanceSansPv = new ControlePecheurPiedSansPv();
        $this->controlePlaisanceSansPv->setProfessionnel(false);
    }

    public function jsonSerialize() {
        $data = parent::jsonSerialize();
        $data['controles'] = $this->getPecheursPied()->toArray();
        $data['controleProSansPv'] = $this->getControleProSansPv();
        $data['controlePlaisanceSansPv'] = $this->getControlePlaisanceSansPv();
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
            $pecheursPied->setActivite($this);
        }

        return $this;
    }

    public function removePecheursPied(ControlePecheurPied $pecheursPied): self {
        if($this->pecheursPied->contains($pecheursPied)) {
            $this->pecheursPied->removeElement($pecheursPied);
            // set the owning side to null (unless already changed)
            if($pecheursPied->getActivite() === $this) {
                $pecheursPied->setActivite(null);
            }
        }

        return $this;
    }

    public function getControleProSansPv(): ?ControlePecheurPiedSansPv
    {
        return $this->controleProSansPv;
    }

    public function setControleProSansPv(?ControlePecheurPiedSansPv $controleProSansPv): self
    {
        $this->controleProSansPv = $controleProSansPv;

        return $this;
    }

    public function getControlePlaisanceSansPv(): ?ControlePecheurPiedSansPv
    {
        return $this->controlePlaisanceSansPv;
    }

    public function setControlePlaisanceSansPv(?ControlePecheurPiedSansPv $controlePlaisanceSansPv): self
    {
        $this->controlePlaisanceSansPv = $controlePlaisanceSansPv;

        return $this;
    }
}

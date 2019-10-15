<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ControlePecheurPiedRepository")
 */
class ControlePecheurPied implements JsonSerializable {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="MissionPechePied", inversedBy="pecheursPied")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rapport;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PecheurPied", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $pecheurPied;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pv;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Natinf", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $natinfs;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    public function jsonSerialize() {
        $data = [];
        $data['pv'] = $this->getPv();

        $data['natinfs'] = [];
        foreach($this->getNatinfs() as $natinf) {
            $data['natinfs'][] = $natinf->getNumero();
        }

        $data['commentaire'] = $this->getCommentaire();

        $data['pecheurPied'] = [];
        foreach($this->getPecheurPied() as $pp) {
            $data['pecheurPied'][] = $pp;
        }
        return $data;
    }

    public function __construct() {
        $this->natinfs = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getRapport(): ?MissionPechePied {
        return $this->rapport;
    }

    public function setRapport(?MissionPechePied $rapport): self {
        $this->rapport = $rapport;

        return $this;
    }

    public function getPecheurPied(): ?PecheurPied {
        return $this->pecheurPied;
    }

    public function setPecheurPied(?PecheurPied $pecheurPied): self {
        $this->pecheurPied = $pecheurPied;

        return $this;
    }

    public function getPv(): ?bool {
        return $this->pv;
    }

    public function setPv(bool $pv): self {
        $this->pv = $pv;

        return $this;
    }

    public function getCommentaire(): ?string {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * @return Collection|Natinf[]
     */
    public function getNatinfs(): Collection {
        return $this->natinfs;
    }

    public function addNatinf(Natinf $natinf): self {
        if(!$this->natinfs->contains($natinf)) {
            $this->natinfs[] = $natinf;
        }

        return $this;
    }

    public function removeNatinf(Natinf $natinf): self {
        if($this->natinfs->contains($natinf)) {
            $this->natinfs->removeElement($natinf);
        }

        return $this;
    }
}

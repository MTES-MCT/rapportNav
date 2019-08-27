<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RapportNavireRepository")
 */
class RapportNavire {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="MissionNavire", inversedBy="navires")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid
     */
    private $rapport;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Navire", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid
     */
    private $navire;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RapportNavireControle")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid
     */
    private $controles;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type(type="bool")
     */
    private $pv = false;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Natinf", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $natinfs;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;

    public function __construct() {
        $this->controles = new ArrayCollection();
        $this->natinfs = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNavire(): ?Navire {
        return $this->navire;
    }

    public function setNavire(?Navire $navire): self {
        $this->navire = $navire;

        return $this;
    }

    public function getPv(): bool {
        return $this->pv;
    }

    public function setPv(bool $pv): self {
        $this->pv = $pv;

        return $this;
    }

    public function getRapport(): ?Mission {
        return $this->rapport;
    }

    public function setRapport(?Mission $rapport): self {
        $this->rapport = $rapport;

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

    /**
     * @return Collection|RapportNavireControle[]
     */
    public function getControles(): Collection {
        return $this->controles;
    }

    public function addControle(RapportNavireControle $controle): self {
        if(!$this->controles->contains($controle)) {
            $this->controles[] = $controle;
        }

        return $this;
    }

    public function removeControle(RapportNavireControle $controle): self {
        if($this->controles->contains($controle)) {
            $this->controles->removeElement($controle);
        }

        return $this;
    }
}

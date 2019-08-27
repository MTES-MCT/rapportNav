<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ControleEtablissementRepository")
 */
class ControleEtablissement {
    use RapportControle;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="MissionCommerce", inversedBy="etablissements")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid
     */
    private $rapport;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etablissement", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid
     */
    private $etablissement;

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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bateauxControles;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;

    public function __construct() {
        $this->natinfs = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
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

    public function getRapport(): ?MissionCommerce {
        return $this->rapport;
    }

    public function setRapport(?MissionCommerce $rapport): self {
        $this->rapport = $rapport;

        return $this;
    }

    public function getEtablissement(): ?Etablissement {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): self {
        $this->etablissement = $etablissement;

        return $this;
    }

    public function getBateauxControles(): ?int {
        return $this->bateauxControles;
    }

    public function setBateauxControles(?int $bateauxControles): self {
        $this->bateauxControles = $bateauxControles;

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

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RapportEtablissementRepository")
 */
class RapportEtablissement {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="RapportCommerce", inversedBy="etablissements")
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
     * @ORM\Column(type="array", nullable=true)
     */
    private $natinf;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bateauxControles;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;

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

    public function getNatinf(): ?array {
        return $this->natinf;
    }

    public function setNatinf(?array $natinf): self {
        $this->natinf = $natinf;

        return $this;
    }

    public function getCommentaire(): ?string {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getRapport(): ?RapportCommerce {
        return $this->rapport;
    }

    public function setRapport(?RapportCommerce $rapport): self {
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
}

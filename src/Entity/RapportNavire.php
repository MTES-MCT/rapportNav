<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="RapportBord", inversedBy="navires")
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
     * @ORM\Column(type="array", nullable=true)
     */
    private $controles;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type(type="bool")
     */
    private $pv = false;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $natinf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;

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

    public function getPv() {
        return $this->pv;
    }

    public function setPv($pv): self {
        $this->pv = $pv;

        return $this;
    }

    public function getRapport(): ?Rapport {
        return $this->rapport;
    }

    public function setRapport(?Rapport $rapport): self {
        $this->rapport = $rapport;

        return $this;
    }

    public function getNatinf(): ?string
    {
        return $this->natinf;
    }

    public function setNatinf(?string $natinf): self
    {
        $this->natinf = $natinf;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getControles(): ?array
    {
        return $this->controles;
    }

    public function setControles(?array $controles): self
    {
        $this->controles = $controles;

        return $this;
    }
}

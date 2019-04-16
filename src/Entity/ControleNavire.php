<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ControleNavireRepository")
 */
class ControleNavire {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ControlePeche", inversedBy="navires")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid
     */
    private $controle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Navire", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid
     */
    private $navire;

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

    public function getControle(): ?ControlePeche {
        return $this->controle;
    }

    public function setControle(?ControlePeche $controle): self {
        $this->controle = $controle;

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
}

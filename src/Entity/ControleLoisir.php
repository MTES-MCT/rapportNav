<?php

namespace App\Entity;

use JsonSerializable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ControleLoisirRepository")
 * @Assert\Expression("this.getNombreControle() >= this.getNombrePv()", message = "Le nombre de PV ne peut être
                                               supérieur au nombre de contrôles. ")
 * @Assert\Expression("this.getNombreControle() >= this.getNombreControleAireProtegee()", message = "Le nombre de
                                               controles en aire marine protégee ne peut être supérieur au nombre de
                                               contrôles total. ")
 */
class ControleLoisir implements JsonSerializable {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="ActiviteLoisir", inversedBy="loisirs")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $activite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Loisir", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $loisir;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $detailLoisir;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(value = 0, message = "Nombre de contrôles invalide")
     */
    protected $nombreControle;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreControleAireProtegee;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(value = 0, message = "Nombre de contrôles invalide")
     *
     */
    protected $nombrePv = 0;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Natinf", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $natinfs;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    public function __construct() {
        $this->natinfs = new ArrayCollection();
    }

    public function jsonSerialize() {
        $natinfs = [];
        foreach($this->getNatinfs() as $natinf) {
            $natinfs[] = $natinf->getNumero();
        }

        return ['id' => $this->getId(),
            'loisir' => $this->getLoisir()->getId(),
            'detailLoisir' => $this->getDetailLoisir(),
            'showDetail' => "Autre" === $this->getLoisir()->getNom(),
            'nombreControle' => $this->getNombreControle(),
            'nombreControleAireProtegee' => $this->getNombreControleAireProtegee(),
            'nombrePv' => $this->getNombrePv(),
            'natinfs' => $natinfs,
            'commentaire' => $this->getCommentaire()
        ];
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getLoisir(): ?Loisir {
        return $this->loisir;
    }

    public function setLoisir(?Loisir $loisir): self {
        $this->loisir = $loisir;

        return $this;
    }

    public function getNombreControle(): ?int {
        return $this->nombreControle;
    }

    public function setNombreControle(int $nombreControle): self {
        $this->nombreControle = $nombreControle;

        return $this;
    }

    public function getActivite(): ?ActiviteLoisir {
        return $this->activite;
    }

    public function setActivite(?ActiviteLoisir $activite): self {
        $this->activite = $activite;

        return $this;
    }

    public function getNombrePv(): ?int {
        return $this->nombrePv;
    }

    public function setNombrePv(?int $nombrePv): self {
        $this->nombrePv = $nombrePv;
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

    public function getCommentaire(): ?string {
        return $this->commentaire;
    }

    public function setCommentaire($commentaire): self {
        $this->commentaire = $commentaire;
        return $this;
    }

    public function getNombreControleAireProtegee(): ?int {
        return $this->nombreControleAireProtegee;
    }

    public function setNombreControleAireProtegee(?int $nombreControleAireProtegee): self {
        $this->nombreControleAireProtegee = $nombreControleAireProtegee;

        return $this;
    }

    public function getDetailLoisir(): ?string
    {
        return $this->detailLoisir;
    }

    public function setDetailLoisir(?string $detailLoisir): self
    {
        $this->detailLoisir = $detailLoisir;

        return $this;
    }
}

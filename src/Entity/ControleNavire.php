<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ControleNavireRepository")
 */
class ControleNavire implements JsonSerializable {
    use RapportControle;

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
     * @ORM\Column(type="boolean")
     */
    private $terrestre;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=8, nullable=true)
     */
    private $lat;

    /**
     * @ORM\Column(type="decimal", precision=11, scale=8, nullable=true)
     */
    private $long;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CategorieControleNavire")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid
     */
    private $controlesRealises;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $detailControle;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Assert\NotBlank()
     */
    private $date;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $aireProtegee = false;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": 0})
     */
    private $chloredeconeTotal = false;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": 0})
     */
    private $chloredeconePartiel = false;

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
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieDeroutement")
     */
    private $deroutement;

    public function jsonSerialize() {
        $data = [
            'pv' => $this->getPv(),
            'terrestre' => $this->getTerrestre(),
            'aireProtegee' => $this->getAireProtegee(),
            'chloredeconeTotal' => $this->getChloredeconeTotal(),
            'chloredeconePartiel' => $this->getChloredeconePartiel(),
            'date' => $this->getDate()->format("Y-m-d H:i"),
            'lat' => $this->getLat(),
            'long' => $this->getLong(),
            'detailControle' => $this->getDetailControle(),
            'isDeroutement' => null !== $this->getDeroutement(),
            'deroutement' => ($this->getDeroutement()) ? $this->getDeroutement()->getId() : null,
            'commentaire' => $this->getCommentaire()
        ];

        foreach($this->getControlesRealises() as $controle) {
            if("Autre" === $controle->getNom()) {
                $data['showDetail'] = true;
            } else {
                $data['showDetail'] = false;
            }
        }

        $data['natinfs'] = [];
        foreach($this->getNatinfs() as $natinf) {
            $data['natinfs'][] = $natinf->getNumero();
        }

        $data['navire'] = $this->getNavire();

        $data['controles'] = [];
        foreach($this->getControlesRealises() as $controle) {
            $data['controles'][] = $controle->getId();
        }

        return $data;
    }

    public function __construct() {
        $this->controlesRealises = new ArrayCollection();
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
     * @return Collection|CategorieControleNavire[]
     */
    public function getControlesRealises(): Collection {
        return $this->controlesRealises;
    }

    public function addControleRealise(CategorieControleNavire $controle): self {
        if(!$this->controlesRealises->contains($controle)) {
            $this->controlesRealises[] = $controle;
        }

        return $this;
    }

    public function removeControleRealise(CategorieControleNavire $controle): self {
        if($this->controlesRealises->contains($controle)) {
            $this->controlesRealises->removeElement($controle);
        }

        return $this;
    }

    public function getAireProtegee(): ?bool {
        return $this->aireProtegee;
    }

    public function setAireProtegee(bool $aireProtegee): self {
        $this->aireProtegee = $aireProtegee;

        return $this;
    }

    public function getDate(): ?DateTimeImmutable {
        return $this->date;
    }

    public function setDate(?DateTimeImmutable $date): self {
        $this->date = $date;

        return $this;
    }

    public function getTerrestre() {
        return $this->terrestre;
    }

    public function setTerrestre($terrestre): self {
        $this->terrestre = $terrestre;
        return $this;
    }

    public function getLat(): ?string {
        return $this->lat;
    }

    public function setLat(?string $lat): self {
        $this->lat = $lat;

        return $this;
    }

    public function getLong(): ?string {
        return $this->long;
    }

    public function setLong(?string $long): self {
        $this->long = $long;

        return $this;
    }

    public function getDeroutement(): ?CategorieDeroutement {
        return $this->deroutement;
    }

    public function setDeroutement(?CategorieDeroutement $deroutement): self {
        $this->deroutement = $deroutement;

        return $this;
    }

    public function getChloredeconeTotal(): ?bool {
        return $this->chloredeconeTotal;
    }

    public function setChloredeconeTotal(bool $chloredeconeTotal): self {
        $this->chloredeconeTotal = $chloredeconeTotal;

        return $this;
    }

    public function getChloredeconePartiel(): ?bool {
        return $this->chloredeconePartiel;
    }

    public function setChloredeconePartiel(bool $chloredeconePartiel): self {
        $this->chloredeconePartiel = $chloredeconePartiel;

        return $this;
    }

    public function getDetailControle(): ?string {
        return $this->detailControle;
    }

    public function setDetailControle(?string $detailControle): self {
        $this->detailControle = $detailControle;

        return $this;
    }
}

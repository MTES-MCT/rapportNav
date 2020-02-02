<?php

namespace App\Entity;

use JsonSerializable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="boolean")
     */
    private $terrestre;

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
     * @ORM\Column(type="datetime_immutable")
     * @Assert\NotBlank()
     */
    private $date;

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
        $data = [
            'id' => $this->getId(),
            'pecheurPied' => $this->getPecheurPied(),
            'terrestre' => $this->getTerrestre(),
            'aireProtegee' => $this->getAireProtegee(),
            'chloredeconeTotal' => $this->getChloredeconeTotal(),
            'chloredeconePartiel' => $this->getChloredeconePartiel(),
            'pv' => $this->getPv(),
            'date' => $this->getDate()->format("Y-m-d H:i"),
            'commentaire' => $this->getCommentaire(),
        ];

        $data['natinfs'] = [];
        foreach($this->getNatinfs() as $natinf) {
            $data['natinfs'][] = $natinf->getNumero();
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

    public function getAireProtegee(): ?bool {
        return $this->aireProtegee;
    }

    public function setAireProtegee(bool $aireProtegee): self {
        $this->aireProtegee = $aireProtegee;

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

    public function getDate(): ?\DateTimeImmutable {
        return $this->date;
    }

    public function setDate(?\DateTimeImmutable $date): self {
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
}

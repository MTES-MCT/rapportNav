<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ControlePecheRepository")
 */
class ControlePeche {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateMission;

    /**
     * @ORM\Column(type="smallint")
     */
    private $typeControle;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Agent")
     */
    private $agents;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Moyen")
     */
    private $moyens;

    /**
     * @ORM\Column(type="smallint")
     */
    private $lieuMission;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $zoneMission;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dureeMission;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    public function getId(): ?int {
        return $this->id;
    }

    public function __construct() {
        $this->agents = new ArrayCollection();
        $this->moyens = new ArrayCollection();
    }

    public function getDateMission(): ?\DateTimeInterface {
        return $this->dateMission;
    }

    public function setDateMission(\DateTimeInterface $dateMission): self {
        $this->dateMission = $dateMission;

        return $this;
    }

    public function getTypeControle(): ?int {
        return $this->typeControle;
    }

    public function setTypeControle(int $typeControle): self {
        $this->typeControle = $typeControle;

        return $this;
    }

    /**
     * @return Collection|Agent[]
     */
    public function getAgents(): Collection {
        return $this->agents;
    }

    public function addAgent(Agent $agent): self {
        if(!$this->agents->contains($agent)) {
            $this->agents[] = $agent;
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self {
        if($this->agents->contains($agent)) {
            $this->agents->removeElement($agent);
        }

        return $this;
    }

    /**
     * @return Collection|Moyen[]
     */
    public function getMoyens(): Collection {
        return $this->moyens;
    }

    public function addMoyen(Moyen $moyen): self {
        if(!$this->moyens->contains($moyen)) {
            $this->moyens[] = $moyen;
        }

        return $this;
    }

    public function removeMoyen(Moyen $moyen): self {
        if($this->moyens->contains($moyen)) {
            $this->moyens->removeElement($moyen);
        }

        return $this;
    }

    public function getLieuMission(): ?int {
        return $this->lieuMission;
    }

    public function setLieuMission(int $lieuMission): self {
        $this->lieuMission = $lieuMission;

        return $this;
    }

    public function getZoneMission(): ?string {
        return $this->zoneMission;
    }

    public function setZoneMission(string $zoneMission): self {
        $this->zoneMission = $zoneMission;

        return $this;
    }

    public function getDureeMission(): ?string {
        return $this->dureeMission;
    }

    public function setDureeMission(string $dureeMission): self {
        $this->dureeMission = $dureeMission;

        return $this;
    }

    public function getCommentaire(): ?string {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self {
        $this->commentaire = $commentaire;

        return $this;
    }
}

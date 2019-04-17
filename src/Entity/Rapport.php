<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RapportRepository")
 */
class Rapport {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     *
     * @var DateTimeInterface
     */
    private $dateMission;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     *
     */
    private $typeControle;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Agent")
     * @Assert\NotBlank()
     * @Assert\Count(min = 1, minMessage = "Vous devez selectionner au moins un agent")
     */
    private $agents;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Moyen")
     * @Assert\NotBlank()
     */
    private $moyens;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     */
    private $lieuMission;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $zoneMission;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\GreaterThan(value="9", message="Cette valeur doit être en minutes")
     */
    private $dureeMission;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity="RapportNavire", mappedBy="controle", cascade={"persist"})
     * @Assert\Valid
     */
    private $navires;

    public function getId(): ?int {
        return $this->id;
    }

    public function __construct() {
        $this->agents = new ArrayCollection();
        $this->moyens = new ArrayCollection();
        $this->navires = new ArrayCollection();
    }

    public function getDateMission(): ?DateTimeInterface {
        return $this->dateMission;
    }

    public function setDateMission(DateTimeInterface $dateMission): self {
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

    /**
     * @return Collection|RapportNavire[]
     */
    public function getNavires(): Collection {
        return $this->navires;
    }

    public function addNavire(RapportNavire $navire): self {
        if(!$this->navires->contains($navire)) {
            $this->navires[] = $navire;
            $navire->setControle($this);
        }

        return $this;
    }

    public function removeNavire(RapportNavire $navire): self {
        if($this->navires->contains($navire)) {
            $this->navires->removeElement($navire);
            // set the owning side to null (unless already changed)
            if($navire->getControle() === $this) {
                $navire->setControle(null);
            }
        }

        return $this;
    }

}

<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RapportRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *     "bord" = "RapportBord",
 *     "commerce" = "RapportCommerce",
 *     "pecheapied" = "RapportPechePied",
 *     "administratif" = "RapportAdministratif",
 *     "formation" = "RapportFormation"
 *     })
 */
abstract class Rapport {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Service")
     * @ORM\JoinColumn(nullable=false)
     */
    private $serviceCreateur;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     *
     * @var DateTimeInterface
     */
    private $dateDebutMission;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     *
     * @var DateTimeInterface
     */
    private $dateFinMission;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Agent")
     * @Assert\NotBlank()
     * @Assert\Count(min = 1, minMessage = "Vous devez selectionner au moins un agent")
     */
    private $agents;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type(type="bool")
     */
    private $terrestre;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ZoneGeographique")
     */
    private $zoneMissions;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $detailHorsZone;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type(type="bool")
     */
    private $arme;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RapportMoyen", mappedBy="rapport", orphanRemoval=true, cascade={"persist"})
     */
    private $moyens;

    public function getId(): ?int {
        return $this->id;
    }

    public function __construct() {
        $this->agents = new ArrayCollection();
        $this->zoneMissions = new ArrayCollection();
        $this->moyens = new ArrayCollection();
    }

    public function getDateDebutMission(): ?DateTimeInterface {
        return $this->dateDebutMission;
    }

    public function setDateDebutMission(DateTimeInterface $dateDebutMission): self {
        $this->dateDebutMission = $dateDebutMission;

        return $this;
    }

    public function getDateFinMission(): ?DateTimeInterface {
        return $this->dateFinMission;
    }

    public function setDateFinMission(DateTimeInterface $dateFinMission): self {
        $this->dateFinMission = $dateFinMission;

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
     * @return Collection|ZoneGeographique[]
     */
    public function getZoneMissions(): Collection {
        return $this->zoneMissions;
    }

    public function addZoneMission(ZoneGeographique $zoneMission): self {
        if(!$this->zoneMissions->contains($zoneMission)) {
            $this->zoneMissions[] = $zoneMission;
        }

        return $this;
    }

    public function removeZoneMission(ZoneGeographique $zoneMission): self {
        if($this->zoneMissions->contains($zoneMission)) {
            $this->zoneMissions->removeElement($zoneMission);
        }

        return $this;
    }

    public function getCommentaire(): ?string {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getArme(): ?bool {
        return $this->arme;
    }

    public function setArme(bool $arme): self {
        $this->arme = $arme;

        return $this;
    }

    public function getDetailHorsZone(): ?string {
        return $this->detailHorsZone;
    }

    public function setDetailHorsZone($detailHorsZone): self {
        $this->detailHorsZone = $detailHorsZone;
        return $this;
    }

    /**
     * @return Collection|RapportMoyen[]
     */
    public function getMoyens(): Collection {
        return $this->moyens;
    }

    public function addMoyen(RapportMoyen $moyen): self {
        if(!$this->moyens->contains($moyen)) {
            $this->moyens[] = $moyen;
            $moyen->setRapport($this);
        }

        return $this;
    }

    public function removeMoyen(RapportMoyen $moyen): self {
        if($this->moyens->contains($moyen)) {
            $this->moyens->removeElement($moyen);
            // set the owning side to null (unless already changed)
            if($moyen->getRapport() === $this) {
                $moyen->setRapport(null);
            }
        }

        return $this;
    }

    public function getTerrestre(): ?bool {
        return $this->terrestre;
    }

    public function setTerrestre(bool $terrestre): self {
        $this->terrestre = $terrestre;

        return $this;
    }

    public function getServiceCreateur(): ?Service {
        return $this->serviceCreateur;
    }

    public function setServiceCreateur(?Service $serviceCreateur): self {
        $this->serviceCreateur = $serviceCreateur;

        return $this;
    }
}

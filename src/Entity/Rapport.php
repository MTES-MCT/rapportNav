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
 * @ORM\DiscriminatorMap({"bord" = "RapportBord", "commerce" = "RapportCommerce"})
 */
abstract class Rapport {
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
    private $methodeCiblage;

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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $distanceTerrestre;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     */
    private $lieuMission;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $zoneMission;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type(type="bool")
     */
    private $arme;

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

    public function getId(): ?int {
        return $this->id;
    }

    public function __construct() {
        $this->agents = new ArrayCollection();
        $this->moyens = new ArrayCollection();
    }

    public function getDateMission(): ?DateTimeInterface {
        return $this->dateMission;
    }

    public function setDateMission(DateTimeInterface $dateMission): self {
        $this->dateMission = $dateMission;

        return $this;
    }

    public function getMethodeCiblage(): ?int {
        return $this->methodeCiblage;
    }

    public function setMethodeCiblage(int $methodeCiblage): self {
        $this->methodeCiblage = $methodeCiblage;

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

    public function getArme(): ?bool {
        return $this->arme;
    }

    public function setArme(bool $arme): self {
        $this->arme = $arme;

        return $this;
    }

    public function getDistanceTerrestre(): ?int {
        return $this->distanceTerrestre;
    }

    public function setDistanceTerrestre(?int $distanceTerrestre): self{
        $this->distanceTerrestre = $distanceTerrestre;
        return $this;
    }

}

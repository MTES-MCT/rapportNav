<?php

namespace App\Request\PAM;

use App\Entity\PAM\PamControle;
use App\Entity\PAM\PamEquipage;

class CreateRapportRequest {
    /**
     * @var ?int
     */
    private $id;

    /**
     * @var ?int
     */
    private $nb_jours_mer;

    /**
     * @var ?int
     */
    private $nav_eff;

    /**
     * @var ?int
     */
    private $mouillage;

    /**
     * @var ?int
     */
    private $maintenance;

    /**
     * @var ?int
     */
    private $meteo;

    /**
     * @var ?int
     */
    private $representation;

    /**
     * @var ?int
     */
    private $administratif;

    /**
     * @var ?int
     */
    private $autre;

    /**
     * @var ?int
     */
    private $contr_port;

    /**
     * @var ?int
     */
    private $technique;

    /**
     * @var ?float
     */
    private $distance;

    /**
     * @var ?float
     */
    private $go_marine;

    /**
     * @var ?float
     */
    private $essence;

    /**
     * @var ?PamEquipageRequest
     */
    private $equipage;

    /**
     * @var ?ControleRequest
     */
    private $controles;

    /**
     * @var PamMissionRequest
     */
    private $missions;

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getNbJoursMer(): ?int {
        return $this->nb_jours_mer;
    }

    /**
     * @param int|null $nb_jours_mer
     */
    public function setNbJoursMer(?int $nb_jours_mer): void {
        $this->nb_jours_mer = $nb_jours_mer;
    }

    /**
     * @return int|null
     */
    public function getNavEff(): ?int {
        return $this->nav_eff;
    }

    /**
     * @param int|null $nav_eff
     */
    public function setNavEff(?int $nav_eff): void {
        $this->nav_eff = $nav_eff;
    }

    /**
     * @return int|null
     */
    public function getMouillage(): ?int {
        return $this->mouillage;
    }

    /**
     * @param int|null $mouillage
     */
    public function setMouillage(?int $mouillage): void {
        $this->mouillage = $mouillage;
    }

    /**
     * @return int|null
     */
    public function getMaintenance(): ?int {
        return $this->maintenance;
    }

    /**
     * @param int|null $maintenance
     */
    public function setMaintenance(?int $maintenance): void {
        $this->maintenance = $maintenance;
    }

    /**
     * @return int|null
     */
    public function getMeteo(): ?int {
        return $this->meteo;
    }

    /**
     * @param int|null $meteo
     */
    public function setMeteo(?int $meteo): void {
        $this->meteo = $meteo;
    }

    /**
     * @return int|null
     */
    public function getRepresentation(): ?int {
        return $this->representation;
    }

    /**
     * @param int|null $representation
     */
    public function setRepresentation(?int $representation): void {
        $this->representation = $representation;
    }

    /**
     * @return int|null
     */
    public function getAdministratif(): ?int {
        return $this->administratif;
    }

    /**
     * @param int|null $administratif
     */
    public function setAdministratif(?int $administratif): void {
        $this->administratif = $administratif;
    }

    /**
     * @return int|null
     */
    public function getAutre(): ?int {
        return $this->autre;
    }

    /**
     * @param int|null $autre
     */
    public function setAutre(?int $autre): void {
        $this->autre = $autre;
    }

    /**
     * @return int|null
     */
    public function getContrPort(): ?int {
        return $this->contr_port;
    }

    /**
     * @param int|null $contr_port
     */
    public function setContrPort(?int $contr_port): void {
        $this->contr_port = $contr_port;
    }

    /**
     * @return int|null
     */
    public function getTechnique(): ?int {
        return $this->technique;
    }

    /**
     * @param int|null $technique
     */
    public function setTechnique(?int $technique): void {
        $this->technique = $technique;
    }

    /**
     * @return float|null
     */
    public function getDistance(): ?float {
        return $this->distance;
    }

    /**
     * @param float|null $distance
     */
    public function setDistance(?float $distance): void {
        $this->distance = $distance;
    }

    /**
     * @return float|null
     */
    public function getGoMarine(): ?float {
        return $this->go_marine;
    }

    /**
     * @param float|null $go_marine
     */
    public function setGoMarine(?float $go_marine): void {
        $this->go_marine = $go_marine;
    }

    /**
     * @return float|null
     */
    public function getEssence(): ?float {
        return $this->essence;
    }

    /**
     * @param float|null $essence
     */
    public function setEssence(?float $essence): void {
        $this->essence = $essence;
    }

    /**
     * @return PamEquipageRequest|null
     */
    public function getEquipage(): ?PamEquipageRequest {
        return $this->equipage;
    }

    /**
     * @param PamEquipageRequest|null $equipage
     */
    public function setEquipage(?PamEquipageRequest $equipage): void {
        $this->equipage = $equipage;
    }

    /**
     * @return ControleRequest|null
     */
    public function getControles(): ?ControleRequest {
        return $this->controles;
    }

    /**
     * @param ControleRequest|null $controles
     */
    public function setControles(?ControleRequest $controles): void {
        $this->controles = $controles;
    }

    /**
     * @return PamMissionRequest
     */
    public function getMissions(): PamMissionRequest {
        return $this->missions;
    }

    /**
     * @param PamMissionRequest $missions
     */
    public function setMissions(PamMissionRequest $missions): void {
        $this->missions = $missions;
    }






}
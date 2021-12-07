<?php

namespace App\Request\PAM;

use App\Entity\PAM\PamControle;
use App\Entity\PAM\PamEquipage;

class CreateRapportRequest {
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTimeImmutable
     */
    private $created_at;

    /**
     * @var \DateTimeImmutable
     */
    private $updated_at;

    /**
     * @var int
     */
    private $nb_jours_mer;

    /**
     * @var int
     */
    private $nav_eff;

    /**
     * @var int
     */
    private $mouillage;

    /**
     * @var int
     */
    private $maintenance;

    /**
     * @var int
     */
    private $meteo;

    /**
     * @var int
     */
    private $representation;

    /**
     * @var int
     */
    private $administratif;

    /**
     * @var int
     */
    private $autre;

    /**
     * @var int
     */
    private $contr_port;

    /**
     * @var int
     */
    private $technique;

    /**
     * @var float
     */
    private $distance;

    /**
     * @var float
     */
    private $go_marine;

    /**
     * @var float
     */
    private $essence;

    /**
     * @var PamEquipage
     */
    private $equipage;

    /**
     * @var PamControle
     */
    private $controles;

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable {
        return $this->created_at;
    }

    /**
     * @param \DateTimeImmutable $created_at
     */
    public function setCreatedAt(\DateTimeImmutable $created_at): void {
        $this->created_at = $created_at;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdatedAt(): \DateTimeImmutable {
        return $this->updated_at;
    }

    /**
     * @param \DateTimeImmutable $updated_at
     */
    public function setUpdatedAt(\DateTimeImmutable $updated_at): void {
        $this->updated_at = $updated_at;
    }

    /**
     * @return int
     */
    public function getNbJoursMer(): int {
        return $this->nb_jours_mer;
    }

    /**
     * @param int $nb_jours_mer
     */
    public function setNbJoursMer(int $nb_jours_mer): void {
        $this->nb_jours_mer = $nb_jours_mer;
    }

    /**
     * @return int
     */
    public function getNavEff(): int {
        return $this->nav_eff;
    }

    /**
     * @param int $nav_eff
     */
    public function setNavEff(int $nav_eff): void {
        $this->nav_eff = $nav_eff;
    }

    /**
     * @return int
     */
    public function getMouillage(): int {
        return $this->mouillage;
    }

    /**
     * @param int $mouillage
     */
    public function setMouillage(int $mouillage): void {
        $this->mouillage = $mouillage;
    }

    /**
     * @return int
     */
    public function getMaintenance(): int {
        return $this->maintenance;
    }

    /**
     * @param int $maintenance
     */
    public function setMaintenance(int $maintenance): void {
        $this->maintenance = $maintenance;
    }

    /**
     * @return int
     */
    public function getMeteo(): int {
        return $this->meteo;
    }

    /**
     * @param int $meteo
     */
    public function setMeteo(int $meteo): void {
        $this->meteo = $meteo;
    }

    /**
     * @return int
     */
    public function getRepresentation(): int {
        return $this->representation;
    }

    /**
     * @param int $representation
     */
    public function setRepresentation(int $representation): void {
        $this->representation = $representation;
    }

    /**
     * @return int
     */
    public function getAdministratif(): int {
        return $this->administratif;
    }

    /**
     * @param int $administratif
     */
    public function setAdministratif(int $administratif): void {
        $this->administratif = $administratif;
    }

    /**
     * @return int
     */
    public function getAutre(): int {
        return $this->autre;
    }

    /**
     * @param int $autre
     */
    public function setAutre(int $autre): void {
        $this->autre = $autre;
    }

    /**
     * @return int
     */
    public function getContrPort(): int {
        return $this->contr_port;
    }

    /**
     * @param int $contr_port
     */
    public function setContrPort(int $contr_port): void {
        $this->contr_port = $contr_port;
    }

    /**
     * @return int
     */
    public function getTechnique(): int {
        return $this->technique;
    }

    /**
     * @param int $technique
     */
    public function setTechnique(int $technique): void {
        $this->technique = $technique;
    }

    /**
     * @return float
     */
    public function getDistance(): float {
        return $this->distance;
    }

    /**
     * @param float $distance
     */
    public function setDistance(float $distance): void {
        $this->distance = $distance;
    }

    /**
     * @return float
     */
    public function getGoMarine(): float {
        return $this->go_marine;
    }

    /**
     * @param float $go_marine
     */
    public function setGoMarine(float $go_marine): void {
        $this->go_marine = $go_marine;
    }

    /**
     * @return float
     */
    public function getEssence(): float {
        return $this->essence;
    }

    /**
     * @param float $essence
     */
    public function setEssence(float $essence): void {
        $this->essence = $essence;
    }

    /**
     * @return PamEquipage
     */
    public function getEquipage(): PamEquipage {
        return $this->equipage;
    }

    /**
     * @param PamEquipage $equipage
     */
    public function setEquipage(PamEquipage $equipage): void {
        $this->equipage = $equipage;
    }

    /**
     * @return PamControle
     */
    public function getControles(): PamControle {
        return $this->controles;
    }

    /**
     * @param PamControle $controles
     */
    public function setControles(PamControle $controles): void {
        $this->controles = $controles;
    }







}
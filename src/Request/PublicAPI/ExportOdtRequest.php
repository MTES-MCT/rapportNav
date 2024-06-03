<?php

namespace App\Request\PublicAPI;

class ExportOdtRequest
{

  private string $id;

  private string $service;

  private \DateTimeImmutable $startDateTime;

  private \DateTimeImmutable $endDateTime;

  private array $presenceMer;

  private array $presenceQuai;

  private array $indisponibilite;

  private int $nbJoursMer;

  private int $dureeMission;

  private ?float $patrouilleSurveillanceEnvInHours = null;

  private ?float $patrouilleMigrantInHours = null;

  private float $distanceMilles;

  private float $goMarine;

  private float $essence;

  private ?array $timeline;

  private ?array $crew;

  private ?string $observations = null;

  private ?array $rescueInfo = null;

  private ?array $nauticalEventsInfo = null;

  private ?array $antiPollutionInfo = null;

  private ?array $baaemAndVigimerInfo = null;
  
  private ?array $traficSurveillanceInfo = null;


  public function getId(): string {
    return $this->id;
  }

  public function setId(string $id): ExportOdtRequest {
    $this->id = $id;
    return $this;
  }

  public function getService(): string {
    return $this->service;
  }

  public function setService(string $service): ExportOdtRequest {
    $this->service = $service;
    return $this;
  }

  public function getStartDateTime(): \DateTimeImmutable {
    return $this->startDateTime;
  }

  public function setStartDateTime(\DateTimeImmutable $startDateTime): ExportOdtRequest {
    $this->startDateTime = $startDateTime;
    return $this;
  }

  public function getEndDateTime(): \DateTimeImmutable {
    return $this->endDateTime;
  }

  public function setEndDateTime(\DateTimeImmutable $endDateTime): ExportOdtRequest {
    $this->endDateTime = $endDateTime;
    return $this;
  }

  public function getPresenceMer(): array {
    return $this->presenceMer;
  }

  public function setPresenceMer(array $presenceMer): ExportOdtRequest {
    $this->presenceMer = $presenceMer;
    return $this;
  }

  public function getPresenceQuai(): array {
    return $this->presenceQuai;
  }

  public function setPresenceQuai(array $presenceQuai): ExportOdtRequest {
    $this->presenceQuai = $presenceQuai;
    return $this;
  }

  public function getIndisponibilite(): array {
    return $this->indisponibilite;
  }

  public function setIndisponibilite(array $indisponibilite): ExportOdtRequest {
    $this->indisponibilite = $indisponibilite;
    return $this;
  }

  public function getNbJoursMer(): int {
    return $this->nbJoursMer;
  }

  public function setNbJoursMer(int $nbJoursMer): ExportOdtRequest {
    $this->nbJoursMer = $nbJoursMer;
    return $this;
  }

  public function getDureeMission(): int {
    return $this->dureeMission;
  }

  public function setDureeMission(int $dureeMission): ExportOdtRequest {
    $this->dureeMission = $dureeMission;
    return $this;
  }

  public function getPatrouilleSurveillanceEnvInHours(): ?float {
    return $this->patrouilleSurveillanceEnvInHours;
  }

  public function setPatrouilleSurveillanceEnvInHours(?float $patrouilleSurveillanceEnvInHours): ExportOdtRequest {
    $this->patrouilleSurveillanceEnvInHours = $patrouilleSurveillanceEnvInHours;
    return $this;
  }

  public function getPatrouilleMigrantInHours(): ?float {
    return $this->patrouilleMigrantInHours;
  }

  public function setPatrouilleMigrantInHours(?float $patrouilleMigrantInHours): ExportOdtRequest {
    $this->patrouilleMigrantInHours = $patrouilleMigrantInHours;
    return $this;
  }

  public function getDistanceMilles(): float {
    return $this->distanceMilles;
  }

  public function setDistanceMilles(float $distanceMilles): ExportOdtRequest {
    $this->distanceMilles = $distanceMilles;
    return $this;
  }

  public function getGoMarine(): float {
    return $this->goMarine;
  }

  public function setGoMarine(float $goMarine): ExportOdtRequest {
    $this->goMarine = $goMarine;
    return $this;
  }

  public function getEssence(): float {
    return $this->essence;
  }

  public function setEssence(float $essence): ExportOdtRequest {
    $this->essence = $essence;
    return $this;
  }

  public function getTimeline(): array {
    return $this->timeline;
  }

  public function setTimeline(array $timeline): ExportOdtRequest {
    $this->timeline = $timeline;
    return $this;
  }

  public function getCrew(): array {
    return $this->crew;
  }

  public function setCrew(array $crew): ExportOdtRequest {
    $this->crew = $crew;
    return $this;
  }

  public function getObservations(): ?string {
    return $this->observations;
  }

  public function setObservations(?string $observations): ExportOdtRequest {
    $this->observations = $observations;
    return $this;
  }

  public function getRescueInfo(): ?array {
    return $this->rescueInfo;
  }

  public function setRescueInfo(?array $rescueInfo): ExportOdtRequest {
    $this->rescueInfo = $rescueInfo;
    return $this;
  }

  public function getNauticalEventsInfo(): ?array {
    return $this->nauticalEventsInfo;
  }

  public function setNauticalEventsInfo(?array $nauticalEventsInfo): ExportOdtRequest {
    $this->nauticalEventsInfo = $nauticalEventsInfo;
    return $this;
  }

  public function getAntiPollutionInfo(): ?array {
    return $this->antiPollutionInfo;
  }

  public function setAntiPollutionInfo(?array $antiPollutionInfo): ExportOdtRequest {
    $this->antiPollutionInfo = $antiPollutionInfo;
    return $this;
  }

  public function getVigimerInfo(): ?array {
    return $this->baaemAndVigimerInfo;
  }

  public function setVigimerInfo(?array $baaemAndVigimerInfo): ExportOdtRequest {
    $this->baaemAndVigimerInfo = $baaemAndVigimerInfo;
    return $this;
  }

  public function getTraficSurveillanceInfo(): ?array {
    return $this->traficSurveillanceInfo;
  }

  public function setTraficSurveillanceInfo(?array $traficSurveillanceInfo): ExportOdtRequest {
    $this->traficSurveillanceInfo = $traficSurveillanceInfo;
    return $this;
  }
}

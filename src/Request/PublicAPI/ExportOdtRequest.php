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

  private int $patrouilleEnv;

  private int $patrouilleMigrant;

  private int $distanceMilles;

  private int $goMarine;

  private int $essence;

  private array $timeline;

  private array $crew;

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

  public function getPatrouilleEnv(): int {
    return $this->patrouilleEnv;
  }

  public function setPatrouilleEnv(int $patrouilleEnv): ExportOdtRequest {
    $this->patrouilleEnv = $patrouilleEnv;
    return $this;
  }

  public function getPatrouilleMigrant(): int {
    return $this->patrouilleMigrant;
  }

  public function setPatrouilleMigrant(int $patrouilleMigrant): ExportOdtRequest {
    $this->patrouilleMigrant = $patrouilleMigrant;
    return $this;
  }

  public function getDistanceMilles(): int {
    return $this->distanceMilles;
  }

  public function setDistanceMilles(int $distanceMilles): ExportOdtRequest {
    $this->distanceMilles = $distanceMilles;
    return $this;
  }

  public function getGoMarine(): int {
    return $this->goMarine;
  }

  public function setGoMarine(int $goMarine): ExportOdtRequest {
    $this->goMarine = $goMarine;
    return $this;
  }

  public function getEssence(): int {
    return $this->essence;
  }

  public function setEssence(int $essence): ExportOdtRequest {
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
}

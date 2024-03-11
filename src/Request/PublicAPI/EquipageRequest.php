<?php

namespace App\Request\PublicAPI;

class EquipageRequest {

  private string $nomAgent;

  private string $role;

  private ?string $comment;

  public function getNomAgent(): string {
    return $this->nomAgent;
  }

  public function setNomAgent(string $nomAgent): EquipageRequest {
    $this->nomAgent = $nomAgent;
    return $this;
  }

  public function getRole(): string {
    return $this->role;
  }

  public function setRole(string $role): EquipageRequest {
    $this->role = $role;
    return $this;
  }

  public function getComment(): ?string {
    return $this->comment;
  }

  public function setComment(?string $comment): EquipageRequest {
    $this->comment = $comment;
    return $this;
  }





}

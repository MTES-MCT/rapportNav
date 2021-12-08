<?php

namespace App\Request\PAM;

class PamEquipageRequest {

    /**
     * @var ?PamMembreRequest[]
     */
    private $membres;

    /**
     * @return PamMembreRequest[]|null
     */
    public function getMembres(): ?array {
        return $this->membres;
    }

    /**
     * @param PamMembreRequest[]|null $membres
     */
    public function setMembres(?array $membres): void {
        $this->membres = $membres;
    }

}
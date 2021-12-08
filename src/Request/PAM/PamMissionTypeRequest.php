<?php

namespace App\Request\PAM;

class PamMissionTypeRequest {

    /**
     * @var ?PamMissionIndicateurRequest[]
     */
    private $indicateurs;

    /**
     * @return PamMissionIndicateurRequest[]|null
     */
    public function getIndicateurs(): ?array {
        return $this->indicateurs;
    }

    /**
     * @param PamMissionIndicateurRequest[]|null $indicateurs
     */
    public function setIndicateurs(?array $indicateurs): void {
        $this->indicateurs = $indicateurs;
    }



}
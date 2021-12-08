<?php

namespace App\Request\PAM;

class PamMissionRequest {

    /**
     * @var ?PamMissionTypeRequest[]
     */
    private $types;

    /**
     * @return PamMissionTypeRequest[]|null
     */
    public function getTypes(): ?array {
        return $this->types;
    }

    /**
     * @param PamMissionTypeRequest[]|null $types
     */
    public function setTypes(?array $types): void {
        $this->types = $types;
    }



}
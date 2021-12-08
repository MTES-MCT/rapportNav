<?php

namespace App\Request\PAM;

class PamMissionTypeRequest {

    /**
     * @var ?int
     */
    private $id;

    /**
     * @var string
     */
    private $label;

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
     * @return string
     */
    public function getLabel(): string {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void {
        $this->label = $label;
    }


}
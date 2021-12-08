<?php

namespace App\Request\PAM;

use App\Entity\PAM\PamMissionType;

class PamMissionRequest {

    /**
     * @var PamMissionTypeRequest
     */
    private $type;

    /**
     * @var bool
     */
    private $checked = false;

    /**
     * @var bool
     */
    private $is_main = false;

    /**
     * @var ?string
     */
    private $start_date;

    /**
     * @var ?string
     */
    private $start_time;

    /**
     * @var ?string
     */
    private $end_date;

    /**
     * @var ?string
     */
    private $end_time;

    /**
     * @var ?PamMissionIndicateurRequest[]
     */
    private $indicateurs;

    /**
     * @return bool
     */
    public function isChecked(): bool {
        return $this->checked;
    }

    /**
     * @param bool $checked
     */
    public function setChecked(bool $checked): void {
        $this->checked = $checked;
    }

    /**
     * @return bool
     */
    public function isIsMain(): bool {
        return $this->is_main;
    }

    /**
     * @param bool $is_main
     */
    public function setIsMain(bool $is_main): void {
        $this->is_main = $is_main;
    }

    /**
     * @return string|null
     */
    public function getStartDate(): ?string {
        return $this->start_date;
    }

    /**
     * @param string|null $start_date
     */
    public function setStartDate(?string $start_date): void {
        $this->start_date = $start_date;
    }

    /**
     * @return string|null
     */
    public function getStartTime(): ?string {
        return $this->start_time;
    }

    /**
     * @param string|null $start_time
     */
    public function setStartTime(?string $start_time): void {
        $this->start_time = $start_time;
    }

    /**
     * @return string|null
     */
    public function getEndDate(): ?string {
        return $this->end_date;
    }

    /**
     * @param string|null $end_date
     */
    public function setEndDate(?string $end_date): void {
        $this->end_date = $end_date;
    }

    /**
     * @return string|null
     */
    public function getEndTime(): ?string {
        return $this->end_time;
    }

    /**
     * @param string|null $end_time
     */
    public function setEndTime(?string $end_time): void {
        $this->end_time = $end_time;
    }

    /**
     * @return PamMissionTypeRequest
     */
    public function getType(): PamMissionTypeRequest {
        return $this->type;
    }

    /**
     * @param PamMissionTypeRequest $type
     */
    public function setType(PamMissionTypeRequest $type): void {
        $this->type = $type;
    }

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
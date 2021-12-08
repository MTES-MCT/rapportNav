<?php

namespace App\Request\PAM;

class PamMissionIndicateurRequest {

    /**
     * @var ?int
     */
    private $principale;
    /**
     * @var ?int
     */
    private $secondaire;
    /**
     * @var ?int
     */
    private $total;
    /**
     * @var ?string
     */
    private $observations;

    /**
     * @return int|null
     */
    public function getPrincipale(): ?int {
        return $this->principale;
    }

    /**
     * @param int|null $principale
     */
    public function setPrincipale(?int $principale): void {
        $this->principale = $principale;
    }

    /**
     * @return int|null
     */
    public function getSecondaire(): ?int {
        return $this->secondaire;
    }

    /**
     * @param int|null $secondaire
     */
    public function setSecondaire(?int $secondaire): void {
        $this->secondaire = $secondaire;
    }

    /**
     * @return int|null
     */
    public function getTotal(): ?int {
        return $this->total;
    }

    /**
     * @param int|null $total
     */
    public function setTotal(?int $total): void {
        $this->total = $total;
    }

    /**
     * @return string|null
     */
    public function getObservations(): ?string {
        return $this->observations;
    }

    /**
     * @param string|null $observations
     */
    public function setObservations(?string $observations): void {
        $this->observations = $observations;
    }






}
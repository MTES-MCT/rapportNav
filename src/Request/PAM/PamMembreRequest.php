<?php

namespace App\Request\PAM;

class PamMembreRequest {

    /**
     * @var ?int
     */
    private $id;

    /**
     * @var ?string
     */
    private $nom;

    /**
     * @var ?string
     */
    private $role;

    /**
     * @var ?string
     */
    private $observations;

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
     * @return string|null
     */
    public function getNom(): ?string {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     */
    public function setNom(?string $nom): void {
        $this->nom = $nom;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string {
        return $this->role;
    }

    /**
     * @param string|null $role
     */
    public function setRole(?string $role): void {
        $this->role = $role;
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
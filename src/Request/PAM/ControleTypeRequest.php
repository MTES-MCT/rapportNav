<?php

namespace App\Request\PAM;

class ControleTypeRequest {

    /**
     * @var int
     */
    private $id;

    /**
     * @var ?PavillonRequest[]
     */
    private $pavillons;

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void {
        $this->id = $id;
    }


    /**
     * @return PavillonRequest[]|null
     */
    public function getPavillons(): ?array {
        return $this->pavillons;
    }

    /**
     * @param PavillonRequest[]|null $pavillons
     */
    public function setPavillons(?array $pavillons): void {
        $this->pavillons = $pavillons;
    }



}
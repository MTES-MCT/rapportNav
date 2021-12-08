<?php

namespace App\Request\PAM;

class ControleRequest {

    /**
     * @var ?ControleTypeRequest[]
     */
    private $types;

    /**
     * @return ControleTypeRequest[]|null
     */
    public function getTypes(): ?array {
        return $this->types;
    }

    /**
     * @param ControleTypeRequest[]|null $types
     */
    public function setTypes(?array $types): void {
        $this->types = $types;
    }







}
<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ControleNavireRepository")
 */
class ControlePecheurPiedSansPv implements JsonSerializable {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $professionnel = false;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreControle;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreControleAireProtegee;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreControleChlordeconeTotale;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreControleChlordeconePartiel;

    public function jsonSerialize() {
        return [
            'nombreControle' => $this->getNombreControle(),
            'nombreControleAireProtegee' => $this->getNombreControleAireProtegee(),
            'nombreControleChlordeconeTotale' => $this->getNombreControleChlordeconeTotale(),
            'nombreControleChlordeconePartiel' => $this->getNombreControleChlordeconePartiel(),
        ];
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNombreControle(): ?int {
        return $this->nombreControle;
    }

    public function setNombreControle(int $nombreControle): self {
        $this->nombreControle = $nombreControle;

        return $this;
    }

    public function getNombreControleAireProtegee(): ?int {
        return $this->nombreControleAireProtegee;
    }

    public function setNombreControleAireProtegee(?int $nombreControleAireProtegee): self {
        $this->nombreControleAireProtegee = $nombreControleAireProtegee;

        return $this;
    }

    public function getProfessionnel(): bool {
        return $this->professionnel;
    }

    public function setProfessionnel(bool $professionnel): self {
        $this->professionnel = $professionnel;
        return $this;
    }

    public function getNombreControleChlordeconeTotale(): ?int {
        return $this->nombreControleChlordeconeTotale;
    }

    public function setNombreControleChlordeconeTotale($nombreControleChlordeconeTotale): self {
        $this->nombreControleChlordeconeTotale = $nombreControleChlordeconeTotale;
        return $this;
    }

    public function getNombreControleChlordeconePartiel(): ?int {
        return $this->nombreControleChlordeconePartiel;
    }

    public function setNombreControleChlordeconePartiel($nombreControleChlordeconePartiel): self {
        $this->nombreControleChlordeconePartiel = $nombreControleChlordeconePartiel;
        return $this;
    }
}

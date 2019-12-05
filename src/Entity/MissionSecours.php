<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MissionSecoursRepository")
 */
class MissionSecours extends Mission {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $dureeSecours;

    public function jsonSerialize() {
        $data = parent::jsonSerialize();
        $data['duree'] = $this->getDureeSecours();
        return $data;
    }

    public function getControles() {
        return null;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getDureeSecours(): ?DateTimeInterface {
        return $this->dureeSecours;
    }

    public function setDureeSecours(?DateTimeInterface $dureeSecours): self {
        $this->dureeSecours = $dureeSecours;

        return $this;
    }
}

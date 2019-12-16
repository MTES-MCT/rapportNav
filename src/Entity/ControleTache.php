<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ControleTacheRepository")
 */
class ControleTache implements JsonSerializable {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MissionAdministratif", inversedBy="taches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rapport;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tache")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tache;

    /**
     * @ORM\Column(type="integer")
     */
    private $dureeTache;

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'tache' => $this->getTache(),
            'dureeTache' => $this->getDureeTache()
        ];
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getTache(): ?Tache {
        return $this->tache;
    }

    public function setTache(?Tache $tache): self {
        $this->tache = $tache;

        return $this;
    }

    public function getRapport(): ?MissionAdministratif {
        return $this->rapport;
    }

    public function setRapport(?MissionAdministratif $rapport): self {
        $this->rapport = $rapport;

        return $this;
    }

    public function getDureeTache(): ?int {
        return $this->dureeTache;
    }

    public function setDureeTache(int $dureeTache): self {
        $this->dureeTache = $dureeTache;

        return $this;
    }
}

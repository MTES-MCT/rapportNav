<?php

namespace App\Entity;

use App\Repository\MoisClosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MoisClosRepository")
 * @ORM\Table(name="mois_clos", indexes={@ORM\Index(name="date_index", columns={"date"})})
 */
class MoisClos {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $service;

    public function getId(): ?int {
        return $this->id;
    }

    public function getDate(): ?\DateTimeImmutable {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): self {
        $this->date = $date;

        return $this;
    }

    public function getService(): ?Service {
        return $this->service;
    }

    public function setService(?Service $service): self {
        $this->service = $service;

        return $this;
    }

}

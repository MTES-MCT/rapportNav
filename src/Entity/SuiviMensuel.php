<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SuiviMensuelRepository")
 */
class SuiviMensuel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $arretTravail;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Service")
     * @ORM\JoinColumn(nullable=false)
     */
    private $service;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $congeAnnuel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArretTravail(): ?int
    {
        return $this->arretTravail;
    }

    public function setArretTravail(int $arretTravail): self
    {
        $this->arretTravail = $arretTravail;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCongeAnnuel(): ?int
    {
        return $this->congeAnnuel;
    }

    public function setCongeAnnuel(int $congeAnnuel): self
    {
        $this->congeAnnuel = $congeAnnuel;

        return $this;
    }
}

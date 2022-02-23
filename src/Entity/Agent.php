<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AgentRepository")
 */
class Agent {

    /**
     * @Groups({"view", "draft", "save_rapport", "autocomplete"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"view", "draft", "save_rapport", "autocomplete"})
     * @ORM\Column(type="string", length=45)
     */
    private $nom;

    /**
     * @Groups({"view", "draft", "save_rapport", "autocomplete"})
     * @ORM\Column(type="string", length=45)
     */
    private $prenom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Service")
     * @ORM\JoinColumn(nullable=true)
     */
    private $service;

    /**
     * @Groups({"view", "draft", "save_rapport", "autocomplete"})
     * @ORM\Column(type="date_immutable")
     */
    private $dateArrivee;

    /**
     * @Groups({"view", "draft", "save_rapport", "autocomplete"})
     * @ORM\Column(type="date_immutable", nullable=true)
     */
    private $dateDepart;

    public function __toString() {
        return $this->prenom." ".$this->nom;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(string $nom): self {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self {
        $this->prenom = $prenom;

        return $this;
    }

    public function getService(): ?Service {
        return $this->service;
    }

    public function setService(Service $service): self {
        $this->service = $service;

        return $this;
    }

    public function getDateArrivee(): ?\DateTimeImmutable
    {
        return $this->dateArrivee;
    }

    public function setDateArrivee(\DateTimeImmutable $dateArrivee): self
    {
        $this->dateArrivee = $dateArrivee;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeImmutable
    {
        return $this->dateDepart;
    }

    public function setDateDepart(?\DateTimeImmutable $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }
}

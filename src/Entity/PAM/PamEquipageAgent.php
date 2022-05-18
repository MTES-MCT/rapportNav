<?php

namespace App\Entity\PAM;

use App\Entity\FonctionAgent;
use App\Entity\FonctionParticuliereAgent;
use App\Repository\PAM\PamEquipageAgentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Agent;

/**
 * @ORM\Entity(repositoryClass=PamEquipageAgentRepository::class)
 */
class PamEquipageAgent
{
    /**
     * @Groups({"view"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=PamEquipage::class, inversedBy="membres", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipage;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\ManyToOne(targetEntity=Agent::class, cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $agent;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observations;

    /**
     *
     * @var FonctionParticuliereAgent
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\ManyToOne(targetEntity=FonctionParticuliereAgent::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $fonctionParticuliere;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\ManyToOne(targetEntity=FonctionAgent::class, cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $fonction;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateDepart;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateArrivee;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isPresent = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEquipage(): ?PamEquipage
    {
        return $this->equipage;
    }

    public function setEquipage(?PamEquipage $equipage): self
    {
        $this->equipage = $equipage;

        return $this;
    }

    public function getAgent(): ?Agent
    {
        return $this->agent;
    }

    public function setAgent(?Agent $agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    public function getObservations(): ?string
    {
        return $this->observations;
    }

    public function setObservations(?string $observations): self
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * @return FonctionParticuliereAgent
     */
    public function getFonctionParticuliere(): ?FonctionParticuliereAgent {
        return $this->fonctionParticuliere;
    }

    /**
     * @param FonctionParticuliereAgent $fonctionParticuliere
     */
    public function setFonctionParticuliere(?FonctionParticuliereAgent $fonctionParticuliere): void {
        $this->fonctionParticuliere = $fonctionParticuliere;
    }

    public function getFonction(): ?FonctionAgent
    {
        return $this->fonction;
    }

    public function setFonction(?FonctionAgent $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(?\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getDateArrivee(): ?\DateTimeInterface
    {
        return $this->dateArrivee;
    }

    public function setDateArrivee(?\DateTimeInterface $dateArrivee): self
    {
        $this->dateArrivee = $dateArrivee;

        return $this;
    }

    public function getIsPresent(): ?bool
    {
        return $this->isPresent;
    }

    public function setIsPresent(?bool $isPresent): self
    {
        $this->isPresent = $isPresent;

        return $this;
    }


}

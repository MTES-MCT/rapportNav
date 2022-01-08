<?php

namespace App\Entity\PAM;

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
     * @ORM\ManyToOne(targetEntity=PamEquipage::class, inversedBy="membre")
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
     * @ORM\Column(type="string", length=64)
     */
    private $role;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observations;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="boolean")
     */
    private $is_absent = false;

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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

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

    public function getIsAbsent(): ?bool
    {
        return $this->is_absent;
    }

    public function setIsAbsent(bool $is_absent): self
    {
        $this->is_absent = $is_absent;

        return $this;
    }
}

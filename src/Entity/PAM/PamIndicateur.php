<?php

namespace App\Entity\PAM;

use App\Repository\PAM\PamIndicateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PamIndicateurRepository::class)
 */
class PamIndicateur
{
    /**
     * @Groups({"view", "save_rapport"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $principale;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $secondaire;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $total;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $observations;

    /**
     * @ORM\ManyToOne(targetEntity=PamMission::class, inversedBy="indicateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mission;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\ManyToOne(targetEntity=CategoryPamIndicateur::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isAutomaticCell;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $automaticEnabled;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $automaticValue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrincipale(): ?int
    {
        return $this->principale;
    }

    public function setPrincipale(?int $principale): self
    {
        $this->principale = $principale;

        return $this;
    }

    public function getSecondaire(): ?int
    {
        return $this->secondaire;
    }

    public function setSecondaire(?int $secondaire): self
    {
        $this->secondaire = $secondaire;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(?int $total): self
    {
        $this->total = $total;

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

    public function getMission(): ?PamMission
    {
        return $this->mission;
    }

    public function setMission(?PamMission $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getCategory(): ?CategoryPamIndicateur
    {
        return $this->category;
    }

    public function setCategory(?CategoryPamIndicateur $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getIsAutomaticCell(): ?bool
    {
        return $this->isAutomaticCell;
    }

    public function setIsAutomaticCell(?bool $isAutomaticCell): self
    {
        $this->isAutomaticCell = $isAutomaticCell;

        return $this;
    }

    public function getAutomaticEnabled(): ?bool
    {
        return $this->automaticEnabled;
    }

    public function setAutomaticEnabled(?bool $automaticEnabled): self
    {
        $this->automaticEnabled = $automaticEnabled;

        return $this;
    }

    public function getAutomaticValue(): ?int
    {
        return $this->automaticValue;
    }

    public function setAutomaticValue(?int $automaticValue): self
    {
        $this->automaticValue = $automaticValue;

        return $this;
    }
}

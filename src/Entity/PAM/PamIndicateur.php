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
     * @Groups({"view"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"view"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $principale;

    /**
     * @Groups({"view"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $secondaire;

    /**
     * @Groups({"view"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $total;

    /**
     * @Groups({"view"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observations;

    /**
     * @ORM\ManyToOne(targetEntity=PamMission::class, inversedBy="indicateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mission;

    /**
     * @Groups({"view"})
     * @ORM\ManyToOne(targetEntity=PamIndicateurType::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

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

    public function getType(): ?PamIndicateurType
    {
        return $this->type;
    }

    public function setType(?PamIndicateurType $type): self
    {
        $this->type = $type;

        return $this;
    }
}

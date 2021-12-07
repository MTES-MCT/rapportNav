<?php

namespace App\Entity\PAM;

use App\Repository\PAM\PamCheckMissionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PamCheckMissionRepository::class)
 */
class PamCheckMission
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
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @Groups({"view"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $checked;

    /**
     * @Groups({"view"})
     * @ORM\Column(type="date", nullable=true)
     */
    private $start_date;

    /**
     * @Groups({"view"})
     * @ORM\Column(type="time", nullable=true)
     */
    private $start_time;

    /**
     * @Groups({"view"})
     * @ORM\Column(type="date", nullable=true)
     */
    private $end_date;

    /**
     * @Groups({"view"})
     * @ORM\Column(type="time", nullable=true)
     */
    private $end_time;

    /**
     * @Groups({"view"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_main;

    /**
     * @ORM\ManyToOne(targetEntity=PamRapport::class, inversedBy="checkMissions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rapport;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getChecked(): ?bool
    {
        return $this->checked;
    }

    public function setChecked(?bool $checked): self
    {
        $this->checked = $checked;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(?\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->start_time;
    }

    public function setStartTime(?\DateTimeInterface $start_time): self
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->end_time;
    }

    public function setEndTime(?\DateTimeInterface $end_time): self
    {
        $this->end_time = $end_time;

        return $this;
    }

    public function getIsMain(): ?bool
    {
        return $this->is_main;
    }

    public function setIsMain(?bool $is_main): self
    {
        $this->is_main = $is_main;

        return $this;
    }

    public function getRapport(): ?PamRapport
    {
        return $this->rapport;
    }

    public function setRapport(?PamRapport $rapport): self
    {
        $this->rapport = $rapport;

        return $this;
    }
}

<?php

namespace App\Entity\PAM;

use App\Repository\PAM\PamMissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PamMissionRepository::class)
 */
class PamMission
{
    /**
     * @Groups({"view"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\OneToMany(targetEntity=PamIndicateur::class, mappedBy="mission", orphanRemoval=true, cascade={"persist"})
     */
    private $indicateurs;

    /**
     * @ORM\ManyToOne(targetEntity=PamRapport::class, inversedBy="missions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rapport;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\ManyToOne(targetEntity=PamMissionType::class, inversedBy="missions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;


    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="boolean")
     */
    private $checked = false;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="boolean")
     */
    private $is_main = false;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $start_datetime;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $end_datetime;

    public function __construct()
    {
        $this->indicateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|PamIndicateur[]
     */
    public function getIndicateurs(): Collection
    {
        return $this->indicateurs;
    }

    public function addIndicateur(PamIndicateur $indicateur): self
    {
        if (!$this->indicateurs->contains($indicateur)) {
            $this->indicateurs[] = $indicateur;
            $indicateur->setMission($this);
        }

        return $this;
    }

    public function removeIndicateur(PamIndicateur $indicateur): self
    {
        if ($this->indicateurs->removeElement($indicateur)) {
            // set the owning side to null (unless already changed)
            if ($indicateur->getMission() === $this) {
                $indicateur->setMission(null);
            }
        }

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

    public function getType(): ?PamMissionType
    {
        return $this->type;
    }

    public function setType(?PamMissionType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return bool
     */
    public function isChecked(): bool {
        return $this->checked;
    }

    /**
     * @param bool $checked
     */
    public function setChecked(bool $checked): void {
        $this->checked = $checked;
    }

    /**
     * @return bool
     */
    public function isIsMain(): bool {
        return $this->is_main;
    }

    /**
     * @param bool $is_main
     */
    public function setIsMain(bool $is_main): void {
        $this->is_main = $is_main;
    }

    public function getStartDatetime(): ?\DateTimeInterface
    {
        return $this->start_datetime;
    }

    public function setStartDatetime(?\DateTimeInterface $start_datetime): self
    {
        $this->start_datetime = $start_datetime;

        return $this;
    }

    public function getEndDatetime(): ?\DateTimeInterface
    {
        return $this->end_datetime;
    }

    public function setEndDatetime(?\DateTimeInterface $end_datetime): self
    {
        $this->end_datetime = $end_datetime;

        return $this;
    }
}

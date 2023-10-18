<?php

namespace App\Entity;

use App\Entity\PAM\PamDraft;
use App\Entity\PAM\PamPlanning;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class
Service {
    /**
     * @Groups({"draft", "me", "view"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"draft", "me", "view"})
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ZoneGeographique")
     */
    private $zoneGeographique;

    /**
     * @ORM\OneToMany(targetEntity=PamDraft::class, mappedBy="created_by", orphanRemoval=true)
     */
    private $pamDrafts;

    /**
     * @Groups({"draft", "me", "view"})
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $quadrigramme;

    /**
     * @ORM\OneToOne(targetEntity=Service::class, cascade={"persist", "remove"})
     */
    private $bordeeLiee;

    /**
     * @ORM\OneToMany(targetEntity=PamPlanning::class, mappedBy="service")
     */
    private $pamPlannings;

    public function __construct()
    {
        $this->pamDrafts = new ArrayCollection();
        $this->pamPlannings = new ArrayCollection();
    }

    public function __toString() {
        return $this->getNom();
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

    public function getZoneGeographique(): ?ZoneGeographique {
        return $this->zoneGeographique;
    }

    public function setZoneGeographique(?ZoneGeographique $zoneGeographique): self {
        $this->zoneGeographique = $zoneGeographique;

        return $this;
    }

    /**
     * @return Collection|PamDraft[]
     */
    public function getPamDrafts(): Collection
    {
        return $this->pamDrafts;
    }

    public function addPamDraft(PamDraft $pamDraft): self
    {
        if (!$this->pamDrafts->contains($pamDraft)) {
            $this->pamDrafts[] = $pamDraft;
            $pamDraft->setCreatedBy($this);
        }

        return $this;
    }

    public function removePamDraft(PamDraft $pamDraft): self
    {
        if ($this->pamDrafts->removeElement($pamDraft)) {
            // set the owning side to null (unless already changed)
            if ($pamDraft->getCreatedBy() === $this) {
                $pamDraft->setCreatedBy(null);
            }
        }

        return $this;
    }

    public function getQuadrigramme(): ?string
    {
        return $this->quadrigramme;
    }

    public function setQuadrigramme(?string $quadrigramme): self
    {
        $this->quadrigramme = $quadrigramme;

        return $this;
    }

    public function getBordeeLiee(): ?self
    {
        return $this->bordeeLiee;
    }

    public function setBordeeLiee(?self $bordeeLiee): self
    {
        $this->bordeeLiee = $bordeeLiee;

        return $this;
    }

    /**
     * @return Collection<int, PamPlanning>
     */
    public function getPamPlannings(): Collection
    {
        return $this->pamPlannings;
    }

    public function addPamPlanning(PamPlanning $pamPlanning): self
    {
        if (!$this->pamPlannings->contains($pamPlanning)) {
            $this->pamPlannings[] = $pamPlanning;
            $pamPlanning->setService($this);
        }

        return $this;
    }

    public function removePamPlanning(PamPlanning $pamPlanning): self
    {
        if ($this->pamPlannings->removeElement($pamPlanning)) {
            // set the owning side to null (unless already changed)
            if ($pamPlanning->getService() === $this) {
                $pamPlanning->setService(null);
            }
        }

        return $this;
    }
}

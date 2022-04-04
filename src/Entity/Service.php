<?php

namespace App\Entity;

use App\Entity\PAM\PamDraft;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service {
    /**
     * @Groups({"draft"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"draft"})
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
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $quadrigramme;

    public function __construct()
    {
        $this->pamDrafts = new ArrayCollection();
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
}

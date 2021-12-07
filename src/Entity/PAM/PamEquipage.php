<?php

namespace App\Entity\PAM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="App\Repository\PAM\PamEquipageRepository")
 */
class PamEquipage
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
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @Groups({"view"})
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\OneToOne(targetEntity=PamRapport::class, mappedBy="equipage", cascade={"persist", "remove"})
     */
    private $rapport;

    /**
     * @ORM\ManyToMany(targetEntity=PamMembre::class)
     */
    private $membres;

    public function __construct()
    {
        $this->membres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }


    public function getRapport(): ?PamRapport
    {
        return $this->rapport;
    }

    public function setRapport(PamRapport $rapport): self
    {
        // set the owning side of the relation if necessary
        if ($rapport->getEquipage() !== $this) {
            $rapport->setEquipage($this);
        }

        $this->rapport = $rapport;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @return void
     */
    public function setCreatedAtValue()
    {
        $this->created_at = new \DateTimeImmutable();
    }

    /**
     * @return Collection|PamMembre[]
     */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembre(PamMembre $membre): self
    {
        if (!$this->membres->contains($membre)) {
            $this->membres[] = $membre;
        }

        return $this;
    }

    public function removeMembre(PamMembre $membre): self
    {
        $this->membres->removeElement($membre);

        return $this;
    }
}

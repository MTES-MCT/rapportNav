<?php

namespace App\Entity;

use App\Entity\NavPro\ControleLot;
use App\Repository\CategorieControleArmementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieControleArmementRepository::class)
 */
class CategorieControleArmement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\ManyToMany(targetEntity=ControleLot::class, mappedBy="controlesRealisesArmement")
     */
    private $controleLots;

    public function __construct()
    {
        $this->controleLots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return Collection<int, ControleLot>
     */
    public function getControleLots(): Collection
    {
        return $this->controleLots;
    }

    public function addControleLot(ControleLot $controleLot): self
    {
        if (!$this->controleLots->contains($controleLot)) {
            $this->controleLots[] = $controleLot;
            $controleLot->addControlesRealisesArmement($this);
        }

        return $this;
    }

    public function removeControleLot(ControleLot $controleLot): self
    {
        if ($this->controleLots->removeElement($controleLot)) {
            $controleLot->removeControlesRealisesArmement($this);
        }

        return $this;
    }

    public function __toString() {
        return $this->getTitre();
    }
}

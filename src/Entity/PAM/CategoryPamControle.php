<?php

namespace App\Entity\PAM;

use App\Repository\PAM\CategoryPamControleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CategoryPamControleRepository::class)
 */
class CategoryPamControle
{
    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="string", length=124)
     */
    private $nom;

    public function __construct()
    {
        $this->controles = new ArrayCollection();
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|PamControle[]
     */
    public function getControles(): Collection
    {
        return $this->controles;
    }

    public function addControle(PamControle $controle): self
    {
        if (!$this->controles->contains($controle)) {
            $this->controles[] = $controle;
            $controle->setCategory($this);
        }

        return $this;
    }

    public function removeControle(PamControle $controle): self
    {
        if ($this->controles->removeElement($controle)) {
            // set the owning side to null (unless already changed)
            if ($controle->getCategory() === $this) {
                $controle->setCategory(null);
            }
        }

        return $this;
    }
}

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
}

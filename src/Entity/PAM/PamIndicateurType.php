<?php

namespace App\Entity\PAM;

use App\Repository\PAM\PamIndicateurTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PamIndicateurTypeRepository::class)
 */
class PamIndicateurType
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
    private $label;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
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
}

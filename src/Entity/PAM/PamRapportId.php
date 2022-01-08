<?php

namespace App\Entity\PAM;

use App\Repository\PAM\PamRapportIdRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PamRapportIdRepository::class)
 */
class PamRapportId
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $id;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
}

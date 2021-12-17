<?php

namespace App\Entity\PAM;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PAM\PamMembreRepository")
 */
class PamMembre
{
    /**
     * @Groups({"view", "draft"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="string", length=124)
     */
    private $role;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observations;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id)
    {
        $this->id = $id;
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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getObservations(): ?string
    {
        return $this->observations;
    }

    public function setObservations(?string $observations): self
    {
        $this->observations = $observations;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PecheurPiedRepository")
 */
class PecheurPied {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estPro = false;

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

    public function getPrenom(): ?string {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEstPro(): ?bool {
        return $this->estPro;
    }

    public function setEstPro(bool $estPro): self {
        $this->estPro = $estPro;

        return $this;
    }
}

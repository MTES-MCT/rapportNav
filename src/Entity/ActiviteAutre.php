<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ActiviteAutreRepository")
 */
class ActiviteAutre extends Activite {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ControleAutre", mappedBy="rapport", orphanRemoval=true,
     *                                                         cascade={"persist", "remove"})
     */
    private $controles;

    public function __construct() {
        parent::__construct();
        $this->controles = new ArrayCollection();
    }

    public function jsonSerialize() {
        $data = parent::jsonSerialize();

        $data['controles'] = $this->getControles()->toArray();
        return $data;
    }

    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return Collection|ControleAutre[]
     */
    public function getControles(): Collection {
        return $this->controles;
    }

    public function addControle(ControleAutre $controle): self {
        if(!$this->controles->contains($controle)) {
            $this->controles[] = $controle;
            $controle->setRapport($this);
        }

        return $this;
    }

    public function removeControle(ControleAutre $controle): self {
        if($this->controles->contains($controle)) {
            $this->controles->removeElement($controle);
            // set the owning side to null (unless already changed)
            if($controle->getRapport() === $this) {
                $controle->setRapport(null);
            }
        }

        return $this;
    }
}

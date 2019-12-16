<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MissionLoisirRepository")
 */
class MissionLoisir extends Mission {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ControleLoisir", mappedBy="rapport", orphanRemoval=true,
     *                                                          cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     *
     * @Assert\Valid()
     *
     * @var Collection|ControleLoisir[]
     */
    private $loisirs;

    public function __construct() {
        parent::__construct();
        $this->loisirs = new ArrayCollection();
    }

    public function jsonSerialize() {
        $data = parent::jsonSerialize();
        $data['controles'] = $this->getLoisirs()->toArray();
        return $data;
    }

    /**
     * @return Collection|ControleLoisir[]
     */
    public function getControles(): Collection {
        return $this->getLoisirs();
    }

    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return Collection|ControleLoisir[]
     */
    public function getLoisirs(): Collection {
        return $this->loisirs;
    }

    public function addLoisir(ControleLoisir $loisir): self {
        if(!$this->loisirs->contains($loisir)) {
            $this->loisirs[] = $loisir;
            $loisir->setRapport($this);
        }

        return $this;
    }

    public function removeLoisir(ControleLoisir $loisir): self {
        if($this->loisirs->contains($loisir)) {
            $this->loisirs->removeElement($loisir);
            // set the owning side to null (unless already changed)
            if($loisir->getRapport() === $this) {
                $loisir->setRapport(null);
            }
        }

        return $this;
    }
}

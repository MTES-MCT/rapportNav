<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ControleAutreRepository")
 */
class ControleAutre implements JsonSerializable {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="ActiviteAutre", inversedBy="controles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $activite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieControleAutre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $controle;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(value = 0, message = "Nombre de contrôles invalide")
     */
    private $nombreControle;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(value = 0, message = "Nombre de contrôles invalide")
     */
    private $nombrePv;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Natinf")
     */
    private $natinfs;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreChlordecone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreDetruit;

    public function __construct() {
        $this->natinfs = new ArrayCollection();
    }

    public function jsonSerialize() {
        $natinfs = [];
        foreach($this->getNatinfs() as $natinf) {
            $natinfs[] = $natinf->getNumero();
        }
        return [
            'controle' => $this->getControle()->getId(),
            'nombreControle' => $this->getNombreControle(),
            'nombrePv' => $this->getNombrePv(),
            'nombreChlordecone' => $this->getNombreChlordecone(),
            'nombreDetruit' => $this->getNombreDetruit(),
            'natinfs' => $natinfs,
            'commentaire' => $this->getCommentaire()
        ];
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getActivite(): ?ActiviteAutre {
        return $this->activite;
    }

    public function setActivite(?ActiviteAutre $activite): self {
        $this->activite = $activite;

        return $this;
    }

    public function getControle(): ?CategorieControleAutre {
        return $this->controle;
    }

    public function setControle(?CategorieControleAutre $controle): self {
        $this->controle = $controle;

        return $this;
    }

    public function getNombreControle(): ?int {
        return $this->nombreControle;
    }

    public function setNombreControle(int $nombreControle): self {
        $this->nombreControle = $nombreControle;

        return $this;
    }

    public function getNombrePv(): ?int {
        return $this->nombrePv;
    }

    public function setNombrePv(int $nombrePv): self {
        $this->nombrePv = $nombrePv;

        return $this;
    }

    /**
     * @return Collection|Natinf[]
     */
    public function getNatinfs(): Collection {
        return $this->natinfs;
    }

    public function addNatinf(Natinf $natinf): self {
        if(!$this->natinfs->contains($natinf)) {
            $this->natinfs[] = $natinf;
        }

        return $this;
    }

    public function removeNatinf(Natinf $natinf): self {
        if($this->natinfs->contains($natinf)) {
            $this->natinfs->removeElement($natinf);
        }

        return $this;
    }

    public function getCommentaire(): ?string {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getNombreChlordecone(): ?int {
        return $this->nombreChlordecone;
    }

    public function setNombreChlordecone(?int $nombreChlordecone): self {
        $this->nombreChlordecone = $nombreChlordecone;

        return $this;
    }

    public function getNombreDetruit(): ?int {
        return $this->nombreDetruit;
    }

    public function setNombreDetruit(?int $nombreDetruit): self {
        $this->nombreDetruit = $nombreDetruit;

        return $this;
    }
}

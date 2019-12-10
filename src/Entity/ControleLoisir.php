<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ControleLoisirRepository")
 */
class ControleLoisir implements JsonSerializable {
  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\MissionLoisir", inversedBy="loisirs")
   * @ORM\JoinColumn(nullable=false)
   */
  private $rapport;

  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\Loisir", cascade={"persist"})
   * @ORM\JoinColumn(nullable=false)
   */
  private $loisir;

  /**
   * @ORM\Column(type="integer")
   */
  private $nombreControle;

  /**
   * @ORM\Column(type="integer")
   */
  private $nombrePv = 0;

  /**
   * @ORM\ManyToMany(targetEntity="App\Entity\Natinf", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true)
   */
  private $natinfs;

  /**
   * @ORM\Column(type="text", nullable=true)
   */
  private $commentaire;

  public function __construct() {
    $this->natinfs = new ArrayCollection();
  }

  public function jsonSerialize() {
    $data = [];
    $data['id'] = $this->getId();
    $data['loisir'] = $this->getLoisir();
    $data['nombreControle'] = $this->getNombreControle();
    $data['nombrePv'] = $this->getNombrePv();

    return $data;
  }

  public function getId(): ?int {
    return $this->id;
  }

  public function getLoisir(): ?Loisir {
    return $this->loisir;
  }

  public function setLoisir(?Loisir $loisir): self {
    $this->loisir = $loisir;

    return $this;
  }

  public function getNombreControle(): ?int {
    return $this->nombreControle;
  }

  public function setNombreControle(int $nombreControle): self {
    $this->nombreControle = $nombreControle;

    return $this;
  }

  public function getRapport(): ?MissionLoisir {
    return $this->rapport;
  }

  public function setRapport(?MissionLoisir $rapport): self {
    $this->rapport = $rapport;

    return $this;
  }

  public function getNombrePv(): ?int {
    return $this->nombrePv;
  }

  public function setNombrePv(?int $nombrePv): self {
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

  public function setCommentaire($commentaire): self {
    $this->commentaire = $commentaire;
    return $this;
  }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="RapportPecheurPiedRepository")
 */
class RapportPecheurPied {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RapportPechePied", inversedBy="pecheursPied")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rapport;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PecheurPied", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $pecheurPied;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pv;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $natinf;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    public function getId(): ?int {
        return $this->id;
    }

    public function getRapport(): ?RapportPechePied {
        return $this->rapport;
    }

    public function setRapport(?RapportPechePied $rapport): self {
        $this->rapport = $rapport;

        return $this;
    }

    public function getPecheurPied(): ?PecheurPied {
        return $this->pecheurPied;
    }

    public function setPecheurPied(?PecheurPied $pecheurPied): self {
        $this->pecheurPied = $pecheurPied;

        return $this;
    }

    public function getPv(): ?bool {
        return $this->pv;
    }

    public function setPv(bool $pv): self {
        $this->pv = $pv;

        return $this;
    }

    public function getNatinf(): ?array {
        return $this->natinf;
    }

    public function setNatinf(array $natinf): self {
        $this->natinf = $natinf;

        return $this;
    }

    public function getCommentaire(): ?string {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self {
        $this->commentaire = $commentaire;

        return $this;
    }
}

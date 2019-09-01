<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DraftRepository")
 */
class Draft {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    private $data = [];

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Service")
     * @ORM\JoinColumn(nullable=false)
     *
     * @var int
     */
    private $owner;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastEdit;

    public function getId(): ?int {
        return $this->id;
    }

    public function getData(): ?array {
        return $this->data;
    }

    public function setData(array $data): self {
        $this->data = $data;

        return $this;
    }

    public function getOwner(): ?string {
        return $this->owner;
    }

    public function setOwner(Service $owner): self {
        $this->owner = $owner;

        return $this;
    }

    public function getRapportType(): string {
        return $this->rapportType;
    }

    public function setRapportType(string $rapportType): self {
//        if(array_key_exists($rapportType, Rapport::RAPPORTTYPES)) {
            $this->rapportType = $rapportType;
//        } else {
//            throw new \InvalidArgumentException("Expecting a Rapport type (see Rapport::RAPPORTTYPE), got ".$rapportType);
//        }

        return $this;
    }

    public function getLastEdit(): ?\DateTimeInterface {
        return $this->lastEdit;
    }

    public function setLastEdit(\DateTimeInterface $lastEdit): self {
        $this->lastEdit = $lastEdit;

        return $this;
    }
}

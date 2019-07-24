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
     * @ORM\Column(type="string", length=45)
     */
    private $owner;

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

    public function setOwner(string $owner): self {
        $this->owner = $owner;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubmissionRepository")
 */
class Submission {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastEdition;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Form", inversedBy="submissions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $relatedForm;

    /**
     * @ORM\Column(type="json", options={"jsonb"=true})
     */
    private $data;

    public function getId(): ?int {
        return $this->id;
    }

    public function getLastEdition(): ?\DateTimeInterface {
        return $this->lastEdition;
    }

    public function setLastEdition(\DateTimeInterface $lastEdition): self {
        $this->lastEdition = $lastEdition;

        return $this;
    }

    public function getRelatedForm(): ?Form {
        return $this->relatedForm;
    }

    public function setRelatedForm(?Form $relatedForm): self {
        $this->relatedForm = $relatedForm;

        return $this;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data): self {
        $this->data = $data;

        return $this;
    }
}

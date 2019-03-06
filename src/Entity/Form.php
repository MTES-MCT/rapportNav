<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormRepository")
 */
class Form {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Form")
     * @ORM\JoinColumn(nullable=false)
     */
    private $activeVersion;

    /**
     * @ORM\Column(type="integer")
     */
    private $version;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endUse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Form", inversedBy="children")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Form", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\Column(type="json", options={"jsonb"=true})
     */
    private $data;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Submission", mappedBy="relatedForm", orphanRemoval=true)
     */
    private $submissions;

    public function __construct() {
        $this->children = new ArrayCollection();
        $this->submissions = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    public function getActiveVersion(): ?self {
        return $this->activeVersion;
    }

    public function setActiveVersion(?self $activeVersion): self {
        $this->activeVersion = $activeVersion;

        return $this;
    }

    public function getVersion(): ?int {
        return $this->version;
    }

    public function setVersion(int $version): self {
        $this->version = $version;

        return $this;
    }

    public function getCreation(): ?\DateTimeInterface {
        return $this->creation;
    }

    public function setCreation(\DateTimeInterface $creation): self {
        $this->creation = $creation;

        return $this;
    }

    public function getEndUse(): ?\DateTimeInterface {
        return $this->endUse;
    }

    public function setEndUse(?\DateTimeInterface $endUse): self {
        $this->endUse = $endUse;

        return $this;
    }

    public function getParent(): ?self {
        return $this->parent;
    }

    public function setParent(?self $parent): self {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildren(): Collection {
        return $this->children;
    }

    public function addChildren(self $children): self {
        if(!$this->children->contains($children)) {
            $this->children[] = $children;
            $children->setParent($this);
        }

        return $this;
    }

    public function removeChildren(self $children): self {
        if($this->children->contains($children)) {
            $this->children->removeElement($children);
            // set the owning side to null (unless already changed)
            if($children->getParent() === $this) {
                $children->setParent(null);
            }
        }

        return $this;
    }

    public function setChildren(?self $children): self {
        $this->children = $children;

        return $this;
    }

    public function getComment(): ?string {
        return $this->comment;
    }

    public function setComment(?string $comment): self {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Collection|Submission[]
     */
    public function getSubmissions(): Collection {
        return $this->submissions;
    }

    public function addSubmission(Submission $submission): self {
        if(!$this->submissions->contains($submission)) {
            $this->submissions[] = $submission;
            $submission->setRelatedForm($this);
        }

        return $this;
    }

    public function removeSubmission(Submission $submission): self {
        if($this->submissions->contains($submission)) {
            $this->submissions->removeElement($submission);
            // set the owning side to null (unless already changed)
            if($submission->getRelatedForm() === $this) {
                $submission->setRelatedForm(null);
            }
        }

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

<?php

namespace App\Entity\PAM;

use App\Entity\User;
use App\Repository\PAM\PamDraftRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PamDraftRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class PamDraft
{
    /**
     * @Groups({"draft"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"draft"})
     * @var string
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @Groups({"draft"})
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @Groups({"draft"})
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updated_at;

    /**
     * @Groups({"draft"})
     * @ORM\Column(type="string", length=20)
     */
    private $number;

    /**
     * @Groups({"draft"})
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="pamDrafts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $created_by;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getBody(): string {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void {
        $this->body = $body;
    }


    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     * @return void
     */
    public function setCreatedAtValue()
    {
        $this->created_at = new \DateTimeImmutable();
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->created_by;
    }

    public function setCreatedBy(?User $created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }
}

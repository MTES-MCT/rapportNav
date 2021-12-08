<?php

namespace App\Entity\PAM;

use App\Repository\PAM\PamDraftRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PamDraftRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class PamDraft
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updated_at;

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
}

<?php

namespace App\Entity\Helper;

use App\Entity\User;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait BlameAndTimestamp {
    /**
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="created_by_id", referencedColumnName="id")
     */
    protected $createdBy;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    protected $createdAt;

    /**
     * @var User $updatedBy
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="updated_by_id", referencedColumnName="id")
     */
    protected $updatedBy;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    protected $updatedAt;

    public function setCreatedBy(?User $createdBy): self {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedBy(): ?User {
        return $this->createdBy;
    }

    public function setCreatedAt(?DateTimeInterface $createdAt): self {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface {
        return $this->createdAt;
    }

    public function setUpdatedBy(?User $updatedBy): self {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getUpdatedBy(): ?User {
        return $this->updatedBy;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): self {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface {
        return $this->updatedAt;
    }
}
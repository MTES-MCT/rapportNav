<?php

namespace App\Entity;

use App\Entity\NavPro\ControleLot;
use App\Entity\NavPro\ControleUnitaire;
use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Vich\Uploadable()
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 */
class Document
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $fileName;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity=ControleLot::class, inversedBy="documents")
     */
    private $navProControleLot;

    /**
     * @Vich\UploadableField(mapping="documents", fileNameProperty="fileName", size="size")
     *
     */
    private ?File $file;

    /**
     * @ORM\ManyToOne(targetEntity=ControleUnitaire::class, inversedBy="documents")
     */
    private $navProControleUnitaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getNavProControleLot(): ?ControleLot
    {
        return $this->navProControleLot;
    }

    public function setNavProControleLot(?ControleLot $navProControleLot): self
    {
        $this->navProControleLot = $navProControleLot;

        return $this;
    }

    /**
     * @return File
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param File|null $file
     */
    public function setFile(?File $file): void
    {
        $this->file = $file;
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getNavProControleUnitaire(): ?ControleUnitaire
    {
        return $this->navProControleUnitaire;
    }

    public function setNavProControleUnitaire(?ControleUnitaire $navProControleUnitaire): self
    {
        $this->navProControleUnitaire = $navProControleUnitaire;

        return $this;
    }
}

<?php

namespace App\Entity\NavPro;

use App\Entity\CategorieControleArmement;
use App\Entity\CategorieControlePersonnel;
use App\Entity\Document;
use App\Entity\Service;
use App\Repository\NavPro\ControleLotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ControleLotRepository::class)
 */
class ControleLot
{

    const TYPE_CONTROLE_ADMINISTRATIF = 'controle_administratif';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private $pvEmis;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="boolean")
     */
    private $brouillon = false;

    /**
     * @ORM\ManyToMany(targetEntity=CategorieControleArmement::class, inversedBy="controleLots")
     */
    private $controlesRealisesArmement;

    /**
     * @ORM\ManyToMany(targetEntity=CategorieControlePersonnel::class, inversedBy="controleLots")
     */
    private $controlesRealisesPersonnel;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $type = self::TYPE_CONTROLE_ADMINISTRATIF;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class)
     */
    private $createdBy;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbPv;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pvFile;

    /**
     * @ORM\OneToMany(targetEntity=Document::class, mappedBy="navProControleLot", cascade={"persist", "remove"})
     */
    private $documents;

    public function __construct()
    {
        $this->controlesRealisesArmement = new ArrayCollection();
        $this->controlesRealisesPersonnel = new ArrayCollection();
        $this->date = new \DateTime();
        $this->documents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?int
    {
        return $this->nombre;
    }

    public function setNombre(int $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPvEmis(): ?bool
    {
        return $this->pvEmis;
    }

    public function setPvEmis(bool $pvEmis): self
    {
        $this->pvEmis = $pvEmis;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getBrouillon(): ?bool
    {
        return $this->brouillon;
    }

    public function setBrouillon(bool $brouillon): self
    {
        $this->brouillon = $brouillon;

        return $this;
    }

    /**
     * @return Collection<int, CategorieControleArmement>
     */
    public function getControlesRealisesArmement(): Collection
    {
        return $this->controlesRealisesArmement;
    }

    public function addControlesRealisesArmement(CategorieControleArmement $controlesRealisesArmement): self
    {
        if (!$this->controlesRealisesArmement->contains($controlesRealisesArmement)) {
            $this->controlesRealisesArmement[] = $controlesRealisesArmement;
        }

        return $this;
    }

    public function removeControlesRealisesArmement(CategorieControleArmement $controlesRealisesArmement): self
    {
        $this->controlesRealisesArmement->removeElement($controlesRealisesArmement);

        return $this;
    }

    /**
     * @return Collection<int, CategorieControlePersonnel>
     */
    public function getControlesRealisesPersonnel(): Collection
    {
        return $this->controlesRealisesPersonnel;
    }

    public function addControlesRealisesPersonnel(CategorieControlePersonnel $controleRealisesPersonnel): self
    {
        if (!$this->controlesRealisesPersonnel->contains($controleRealisesPersonnel)) {
            $this->controlesRealisesPersonnel[] = $controleRealisesPersonnel;
        }

        return $this;
    }

    public function removeControlesRealisesPersonnel(CategorieControlePersonnel $controleRealisesPersonnel): self
    {
        $this->controlesRealisesPersonnel->removeElement($controleRealisesPersonnel);

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCreatedBy(): ?Service
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?Service $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNbPv(): ?int
    {
        return $this->nbPv;
    }

    public function setNbPv(?int $nbPv): self
    {
        $this->nbPv = $nbPv;

        return $this;
    }

    public function getPvFichiers(): ?string
    {
        return $this->pvFichiers;
    }

    public function setPvFichiers(?string $pvFichiers): self
    {
        $this->pvFichiers = $pvFichiers;

        return $this;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setNavProControleLot($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getNavProControleLot() === $this) {
                $document->setNavProControleLot(null);
            }
        }

        return $this;
    }
}

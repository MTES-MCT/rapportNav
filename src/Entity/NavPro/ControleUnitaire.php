<?php

namespace App\Entity\NavPro;

use App\Entity\CategorieControleArmement;
use App\Entity\CategorieControlePersonnel;
use App\Entity\Document;
use App\Entity\Navire;
use App\Entity\Service;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=App\Repository\NavPro\ControleUnitaireRepository::class)
 */
class ControleUnitaire
{

    const TYPE_CONTROLE_TERRAIN_MER = 'controle_terrain_mer_unitaire';
    const TYPE_CONTROLE_TERRAIN_QUAI = 'controle_terrain_quai_unitaire';
    const TYPE_CONTROLE_ADMINISTRATIF = 'controle_administratif_unitaire';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $pvEmis = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $navireEtranger = false;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="boolean")
     */
    private $brouillon = true;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity=CategorieControleArmement::class)
     */
    private $controleRealisesArmement;

    /**
     * @ORM\ManyToMany(targetEntity=CategorieControlePersonnel::class)
     */
    private $controleRealisesGM;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class)
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=Navire::class)
     */
    private $navire;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbPv;

    /**
     * @ORM\OneToMany(targetEntity=Document::class, mappedBy="navProControleUnitaire", cascade={"persist", "remove"})
     */
    private $documents;

    public function __construct()
    {
        $this->controleRealisesArmement = new ArrayCollection();
        $this->controleRealisesGM = new ArrayCollection();
        $this->date = new \DateTime();
        $this->documents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNavireEtranger(): ?bool
    {
        return $this->navireEtranger;
    }

    public function setNavireEtranger(bool $navireEtranger): self
    {
        $this->navireEtranger = $navireEtranger;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, CategorieControleArmement>
     */
    public function getControleRealisesArmement(): Collection
    {
        return $this->controleRealisesArmement;
    }

    public function addControleRealisesArmement(CategorieControleArmement $controleRealisesArmement): self
    {
        if (!$this->controleRealisesArmement->contains($controleRealisesArmement)) {
            $this->controleRealisesArmement[] = $controleRealisesArmement;
        }

        return $this;
    }

    public function removeControleRealisesArmement(CategorieControleArmement $controleRealisesArmement): self
    {
        $this->controleRealisesArmement->removeElement($controleRealisesArmement);

        return $this;
    }

    /**
     * @return Collection<int, CategorieControlePersonnel>
     */
    public function getControleRealisesGM(): Collection
    {
        return $this->controleRealisesGM;
    }

    public function addControleRealisesGM(CategorieControlePersonnel $controleRealisesGM): self
    {
        if (!$this->controleRealisesGM->contains($controleRealisesGM)) {
            $this->controleRealisesGM[] = $controleRealisesGM;
        }

        return $this;
    }

    public function removeControleRealisesGM(CategorieControlePersonnel $controleRealisesGM): self
    {
        $this->controleRealisesGM->removeElement($controleRealisesGM);

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

    public function getCreatedBy(): ?Service
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?Service $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getNavire(): ?Navire
    {
        return $this->navire;
    }

    public function setNavire(?Navire $navire): self
    {
        $this->navire = $navire;

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
            $document->setNavProControleUnitaire($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getNavProControleUnitaire() === $this) {
                $document->setNavProControleUnitaire(null);
            }
        }

        return $this;
    }
}

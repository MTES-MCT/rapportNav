<?php

namespace App\Entity\NavPro;

use App\Entity\CategorieControleArmement;
use App\Entity\CategorieControlePersonnel;
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

    public function __construct()
    {
        $this->controlesRealisesArmement = new ArrayCollection();
        $this->controlesRealisesPersonnel = new ArrayCollection();
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
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieControleNavireRepository")
 */
class CategorieControleNavire {

    const PECHE_SANITAIRE = 'Contrôles Pêche / Sanitaire';
    const EQUIPEMENT_SECURITE_PERMIS = 'Équipement de sécurité / Permis de navigation';
    const POLICE_NAVIGATION = 'Police de la navigation';
    const ENVIRONNEMENT_POLLUTION = 'Environnement / pollution';
    const REGLEMENTATION_TRAVAIL_MARITIME = 'Réglementation du travail maritime';
    const AUTRE = 'Autre';


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $nom;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isGMArmement;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isGMArmementSousItem;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $active;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isGMPersonnelSousItem;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isGMPersonnel;

    public function __toString() {
        return $this->getNom();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(string $nom): self {
        $this->nom = $nom;

        return $this;
    }

    public function getIsGMArmement(): ?bool
    {
        return $this->isGMArmement;
    }

    public function setIsGMArmement(?bool $isGMArmement): self
    {
        $this->isGMArmement = $isGMArmement;

        return $this;
    }

    public function getIsGMArmementSousItem(): ?bool
    {
        return $this->isGMArmementSousItem;
    }

    public function setIsGMArmementSousItem(?bool $isGMArmementSousItem): self
    {
        $this->isGMArmementSousItem = $isGMArmementSousItem;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getIsGMPersonnelSousItem(): ?bool
    {
        return $this->isGMPersonnelSousItem;
    }

    public function setIsGMPersonnelSousItem(?bool $isGMPersonnelSousItem): self
    {
        $this->isGMPersonnelSousItem = $isGMPersonnelSousItem;

        return $this;
    }

    public function getIsGMPersonnel(): ?bool
    {
        return $this->isGMPersonnel;
    }

    public function setIsGMPersonnel(?bool $isGMPersonnel): self
    {
        $this->isGMPersonnel = $isGMPersonnel;

        return $this;
    }
}

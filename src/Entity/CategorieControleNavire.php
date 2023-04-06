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
}

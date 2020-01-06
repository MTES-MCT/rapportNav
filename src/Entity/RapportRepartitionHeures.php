<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RapportRepartitionHeuresRepository")
 */
class RapportRepartitionHeures {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Rapport", inversedBy="repartitionHeures", cascade={"persist",
     *                                                  "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $rapport;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $controleMer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $controleTerre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $controleAireProtegeeMer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $controleAireProtegeeTerre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $visiteSecurite;


    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreVisiteSecurite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $surveillanceManifestationMer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $surveillanceManifestationTerre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $surveillanceDpmMer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $surveillanceDpmTerre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $surete;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maintienOrdre;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreOperationMaintienOrdre;

    public function getId(): ?int {
        return $this->id;
    }

    public function getControleMer(): ?int {
        return $this->controleMer;
    }

    public function setControleMer(?int $controleMer): self {
        $this->controleMer = $controleMer;

        return $this;
    }

    public function getControleTerre(): ?int {
        return $this->controleTerre;
    }

    public function setControleTerre(?int $controleTerre): self {
        $this->controleTerre = $controleTerre;

        return $this;
    }

    public function getControleAireProtegeeMer(): ?int {
        return $this->controleAireProtegeeMer;
    }

    public function setControleAireProtegeeMer(?int $controleAireProtegeeMer): self {
        $this->controleAireProtegeeMer = $controleAireProtegeeMer;

        return $this;
    }

    public function getControleAireProtegeeTerre(): ?int {
        return $this->controleAireProtegeeTerre;
    }

    public function setControleAireProtegeeTerre(?int $controleAireProtegeeTerre): self {
        $this->controleAireProtegeeTerre = $controleAireProtegeeTerre;

        return $this;
    }

    public function getVisiteSecurite(): ?int {
        return $this->visiteSecurite;
    }

    public function setVisiteSecurite(?int $visiteSecurite): self {
        $this->visiteSecurite = $visiteSecurite;

        return $this;
    }

    public function getSurveillanceManifestationMer(): ?int {
        return $this->surveillanceManifestationMer;
    }

    public function setSurveillanceManifestationMer(?int $surveillanceManifestationMer): self {
        $this->surveillanceManifestationMer = $surveillanceManifestationMer;

        return $this;
    }

    public function getSurveillanceManifestationTerre(): ?int {
        return $this->surveillanceManifestationTerre;
    }

    public function setSurveillanceManifestationTerre(?int $surveillanceManifestationTerre): self {
        $this->surveillanceManifestationTerre = $surveillanceManifestationTerre;

        return $this;
    }

    public function getSurveillanceDpmMer(): ?int {
        return $this->surveillanceDpmMer;
    }

    public function setSurveillanceDpmMer(?int $surveillanceDpmMer): self {
        $this->surveillanceDpmMer = $surveillanceDpmMer;

        return $this;
    }

    public function getSurveillanceDpmTerre(): ?int {
        return $this->surveillanceDpmTerre;
    }

    public function setSurveillanceDpmTerre(?int $surveillanceDpmTerre): self {
        $this->surveillanceDpmTerre = $surveillanceDpmTerre;

        return $this;
    }

    public function getRapport(): ?Rapport {
        return $this->rapport;
    }

    public function setRapport(Rapport $rapport): self {
        $this->rapport = $rapport;

        return $this;
    }

    public function getSurete(): ?int {
        return $this->surete;
    }

    public function setSurete(?int $surete): self {
        $this->surete = $surete;

        return $this;
    }

    public function getMaintienOrdre(): ?int {
        return $this->maintienOrdre;
    }

    public function setMaintienOrdre(?int $maintienOrdre): self {
        $this->maintienOrdre = $maintienOrdre;

        return $this;
    }

    public function getNombreOperationMaintienOrdre(): ?int {
        return $this->nombreOperationMaintienOrdre;
    }

    public function setNombreOperationMaintienOrdre(?int $nombreOperationMaintienOrdre): self {
        $this->nombreOperationMaintienOrdre = $nombreOperationMaintienOrdre;

        return $this;
    }

    public function getNombreVisiteSecurite(): ?int {
        return $this->nombreVisiteSecurite;
    }

    public function setNombreVisiteSecurite(?int $nombreVisiteSecurite): self {
        $this->nombreVisiteSecurite = $nombreVisiteSecurite;

        return $this;
    }

}

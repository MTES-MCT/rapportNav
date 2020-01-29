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
    private $controleAerien;

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
    private $controleAireProtegeeAerien;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $controlePollutionMer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $controlePollutionTerre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $controlePollutionAerien;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $controleEnvironnementMer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $controleEnvironnementTerre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $controleEnvironnementAerien;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $controleCroise;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $immigration;

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
    private $assistance;

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

    public function getNombreVisiteSecurite(): ?int {
        return $this->nombreVisiteSecurite;
    }

    public function setNombreVisiteSecurite(?int $nombreVisiteSecurite): self {
        $this->nombreVisiteSecurite = $nombreVisiteSecurite;

        return $this;
    }

    public function getControleCroise(): ?int {
        return $this->controleCroise;
    }

    public function setControleCroise(?int $controleCroise): self {
        $this->controleCroise = $controleCroise;

        return $this;
    }

    public function getImmigration(): ?int {
        return $this->immigration;
    }

    public function setImmigration(?int $immigration): self {
        $this->immigration = $immigration;

        return $this;
    }

    public function getAssistance(): ?int {
        return $this->assistance;
    }

    public function setAssistance(?int $assistance): self {
        $this->assistance = $assistance;

        return $this;
    }

    public function getControleAireProtegeeAerien(): ?int {
        return $this->controleAireProtegeeAerien;
    }

    public function setControleAireProtegeeAerien(?int $controleAireProtegeeAerien): self {
        $this->controleAireProtegeeAerien = $controleAireProtegeeAerien;

        return $this;
    }

    public function getControlePollutionMer(): ?int {
        return $this->controlePollutionMer;
    }

    public function setControlePollutionMer(?int $controlePollutionMer): self {
        $this->controlePollutionMer = $controlePollutionMer;
        return $this;
    }

    public function getControlePollutionTerre(): ?int {
        return $this->controlePollutionTerre;
    }

    public function setControlePollutionTerre(?int $controlePollutionTerre): self {
        $this->controlePollutionTerre = $controlePollutionTerre;
        return $this;
    }

    public function getControlePollutionAerien(): ?int {
        return $this->controlePollutionAerien;
    }

    public function setControlePollutionAerien(?int $controlePollutionAerien): self {
        $this->controlePollutionAerien = $controlePollutionAerien;
        return $this;
    }

    public function getControleEnvironnementMer(): ?int {
        return $this->controleEnvironnementMer;
    }

    public function setControleEnvironnementMer(?int $controleEnvironnementMer): self {
        $this->controleEnvironnementMer = $controleEnvironnementMer;
        return $this;
    }

    public function getControleEnvironnementTerre(): ?int {
        return $this->controleEnvironnementTerre;
    }

    public function setControleEnvironnementTerre(?int $controleEnvironnementTerre): self {
        $this->controleEnvironnementTerre = $controleEnvironnementTerre;
        return $this;
    }

    public function getControleEnvironnementAerien(): ?int {
        return $this->controleEnvironnementAerien;
    }

    public function setControleEnvironnementAerien(?int $controleEnvironnementAerien): self {
        $this->controleEnvironnementAerien = $controleEnvironnementAerien;
        return $this;
    }

    public function getControleAerien(): ?int {
        return $this->controleAerien;
    }

    public function setControleAerien(?int $controleAerien): self {
        $this->controleAerien = $controleAerien;
        return $this;
    }


}

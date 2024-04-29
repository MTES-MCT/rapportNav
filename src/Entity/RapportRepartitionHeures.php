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
    private $controleChlordeconeTotalMer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $controleChlordeconeTotalTerre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $controleChlordeconePartielMer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $controleChlordeconePartielTerre;

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

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $plongee;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sauvegardeHumaineNbHeureMer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sauvegardeHumaineNbHeuresVol;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sauvegardeHumaineNbOpeConduites;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sauvegardeHumaineNbPersonnesSecourues;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sauvegardeHumaineMigratoireNbHeuresMer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sauvegardeHumaineMigratoireNbHeuresVol;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sauvegardeHumaineMigratoireNbOpeConduite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sauvegardeHumaineMigratoireNbEmbarcationsSansIntervention;

    /**
     * @ORM\Column(type="integer", nullable=true, name="sauvegarde_humaine_migratoire_nb_embarcations_assistees_terre")
     */
    private $sauvegardeHumaineMigratoireNbEmbarcationsAssisteesRetourTerre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sauvegardeHumaineMigratoireNbOpeSauvetageConduites;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sauvegardeHumaineMigratoireNbPersonnesSecourues;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $assistanceNbHeuresMer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $assistanceNbHeuresVol;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $assistanceNbOpeANED;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $assistanceNbInterventionMiseEnDemeure;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $assistanceNbMiseEnDemeureEvaluation;

    /**
     * @ORM\Column(type="integer", nullable=true, name="assistance_nb_mise_en_oeuvre_capinav")
     */
    private $assistanceNbMiseEnOeuvreCAPINAV;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $assistanceNbRemorquages;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $assistanceNbOpeMaintenanceSignalisation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $assistanceNbOpeDeminage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $assistanceNbMunitionsDetruites;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $assistancePoidsMatiereActive;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lutteTraficArmesNbHeuresMer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lutteTraficArmesNbHeureVol;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lutteTraficArmesNbOpeMer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lutteTraficArmesNbInspectionsMer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lutteTraficArmesNbNaviresSaisisMer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lutteTraficArmesNbArmesMunitionsSaisies;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
      private $lutteTraficStupefiantNbHeuresMer;

      /**
       * @ORM\Column(type="integer", nullable=true)
       */
      private $lutteTraficStupefiantNbHeuresVol;

      /**
       * @ORM\Column(type="integer", nullable=true)
       */
      private $lutteTraficStupefiantNbOpeNARCO;

      /**
       * @ORM\Column(type="integer", nullable=true)
       */
      private $lutteTraficStupefiantNbInspectionsMer;

      /**
       * @ORM\Column(type="integer", nullable=true)
       */
      private $lutteTraficStupefiantNbNavireSaisisMer;

      /**
       * @ORM\Column(type="integer", nullable=true)
       */
      private $lutteTraficStupefiantKgSaisis;

      /**
       * @ORM\Column(type="integer", nullable=true)
       */
      private $lutteTraficEspecesNbHeuresMer;

      /**
       * @ORM\Column(type="integer", nullable=true)
       */
      private $lutteTraficEspecesNbHeuresVol;

      /**
       * @ORM\Column(type="integer", nullable=true)
       */
      private $lutteTraficEspecesNbNaviresSaisisMer;

      /**
       * @ORM\Column(type="integer", nullable=true)
       */
      private $lutteTraficEspecesNbSaisis;

      /**
       * @ORM\Column(type="integer", nullable=true)
       */
      private $immigrationNbHeuresVol;

      /**
       * @ORM\Column(type="integer", nullable=true)
       */
      private $immigrationNbNaviresInterceptes;

      /**
       * @ORM\Column(type="integer", nullable=true)
       */
      private $immigrationNbMigrantInterceptes;

      /**
       * @ORM\Column(type="integer", nullable=true)
       */
      private $immigrationNbPasseursInterceptes;

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

    public function getControleChlordeconeTotalMer(): ?int {
        return $this->controleChlordeconeTotalMer;
    }

    public function setControleChlordeconeTotalMer($controleChlordeconeTotalMer): self {
        $this->controleChlordeconeTotalMer = $controleChlordeconeTotalMer;
        return $this;
    }

    public function getControleChlordeconeTotalTerre(): ?int {
        return $this->controleChlordeconeTotalTerre;
    }

    public function setControleChlordeconeTotalTerre($controleChlordeconeTotalTerre): self {
        $this->controleChlordeconeTotalTerre = $controleChlordeconeTotalTerre;
        return $this;
    }

    public function getControleChlordeconePartielMer(): ?int {
        return $this->controleChlordeconePartielMer;
    }

    public function setControleChlordeconePartielMer($controleChlordeconePartielMer): self {
        $this->controleChlordeconePartielMer = $controleChlordeconePartielMer;
        return $this;
    }

    public function getControleChlordeconePartielTerre(): ?int {
        return $this->controleChlordeconePartielTerre;
    }

    public function setControleChlordeconePartielTerre($controleChlordeconePartielTerre): self {
        $this->controleChlordeconePartielTerre = $controleChlordeconePartielTerre;
        return $this;
    }

    public function getPlongee(): ?int {
        return $this->plongee;
    }

    public function setPlongee(?int $plongee): self {
        $this->plongee = $plongee;
        return $this;
    }

    public function getSauvegardeHumaineNbHeureMer(): ?int
    {
        return $this->sauvegardeHumaineNbHeureMer;
    }

    public function setSauvegardeHumaineNbHeureMer(?int $sauvegardeHumaineNbHeureMer): self
    {
        $this->sauvegardeHumaineNbHeureMer = $sauvegardeHumaineNbHeureMer;

        return $this;
    }

    public function getSauvegardeHumaineNbHeuresVol(): ?int
    {
        return $this->sauvegardeHumaineNbHeuresVol;
    }

    public function setSauvegardeHumaineNbHeuresVol(?int $sauvegardeHumaineNbHeuresVol): self
    {
        $this->sauvegardeHumaineNbHeuresVol = $sauvegardeHumaineNbHeuresVol;

        return $this;
    }

    public function getSauvegardeHumaineNbOpeConduites(): ?int
    {
        return $this->sauvegardeHumaineNbOpeConduites;
    }

    public function setSauvegardeHumaineNbOpeConduites(?int $sauvegardeHumaineNbOpeConduites): self
    {
        $this->sauvegardeHumaineNbOpeConduites = $sauvegardeHumaineNbOpeConduites;

        return $this;
    }

    public function getSauvegardeHumaineNbPersonnesSecourues(): ?int
    {
        return $this->sauvegardeHumaineNbPersonnesSecourues;
    }

    public function setSauvegardeHumaineNbPersonnesSecourues(?int $sauvegardeHumaineNbPersonnesSecourues): self
    {
        $this->sauvegardeHumaineNbPersonnesSecourues = $sauvegardeHumaineNbPersonnesSecourues;

        return $this;
    }

    public function getSauvegardeHumaineMigratoireNbHeuresMer(): ?int
    {
        return $this->sauvegardeHumaineMigratoireNbHeuresMer;
    }

    public function setSauvegardeHumaineMigratoireNbHeuresMer(?int $sauvegardeHumaineMigratoireNbHeuresMer): self
    {
        $this->sauvegardeHumaineMigratoireNbHeuresMer = $sauvegardeHumaineMigratoireNbHeuresMer;

        return $this;
    }

    public function getSauvegardeHumaineMigratoireNbHeuresVol(): ?int
    {
        return $this->sauvegardeHumaineMigratoireNbHeuresVol;
    }

    public function setSauvegardeHumaineMigratoireNbHeuresVol(?int $sauvegardeHumaineMigratoireNbHeuresVol): self
    {
        $this->sauvegardeHumaineMigratoireNbHeuresVol = $sauvegardeHumaineMigratoireNbHeuresVol;

        return $this;
    }

    public function getSauvegardeHumaineMigratoireNbOpeConduite(): ?int
    {
        return $this->sauvegardeHumaineMigratoireNbOpeConduite;
    }

    public function setSauvegardeHumaineMigratoireNbOpeConduite(?int $sauvegardeHumaineMigratoireNbOpeConduite): self
    {
        $this->sauvegardeHumaineMigratoireNbOpeConduite = $sauvegardeHumaineMigratoireNbOpeConduite;

        return $this;
    }

    public function getSauvegardeHumaineMigratoireNbEmbarcationsSansIntervention(): ?int
    {
        return $this->sauvegardeHumaineMigratoireNbEmbarcationsSansIntervention;
    }

    public function setSauvegardeHumaineMigratoireNbEmbarcationsSansIntervention(?int $sauvegardeHumaineMigratoireNbEmbarcationsSansIntervention): self
    {
        $this->sauvegardeHumaineMigratoireNbEmbarcationsSansIntervention = $sauvegardeHumaineMigratoireNbEmbarcationsSansIntervention;

        return $this;
    }

    public function getSauvegardeHumaineMigratoireNbEmbarcationsAssisteesRetourTerre(): ?int
    {
        return $this->sauvegardeHumaineMigratoireNbEmbarcationsAssisteesRetourTerre;
    }

    public function setSauvegardeHumaineMigratoireNbEmbarcationsAssisteesRetourTerre(?int $sauvegardeHumaineMigratoireNbEmbarcationsAssisteesRetourTerre): self
    {
        $this->sauvegardeHumaineMigratoireNbEmbarcationsAssisteesRetourTerre = $sauvegardeHumaineMigratoireNbEmbarcationsAssisteesRetourTerre;

        return $this;
    }

    public function getSauvegardeHumaineMigratoireNbOpeSauvetageConduites(): ?int
    {
        return $this->sauvegardeHumaineMigratoireNbOpeSauvetageConduites;
    }

    public function setSauvegardeHumaineMigratoireNbOpeSauvetageConduites(?int $sauvegardeHumaineMigratoireNbOpeSauvetageConduites): self
    {
        $this->sauvegardeHumaineMigratoireNbOpeSauvetageConduites = $sauvegardeHumaineMigratoireNbOpeSauvetageConduites;

        return $this;
    }

    public function getSauvegardeHumaineMigratoireNbPersonnesSecourues(): ?int
    {
        return $this->sauvegardeHumaineMigratoireNbPersonnesSecourues;
    }

    public function setSauvegardeHumaineMigratoireNbPersonnesSecourues(?int $sauvegardeHumaineMigratoireNbPersonnesSecourues): self
    {
        $this->sauvegardeHumaineMigratoireNbPersonnesSecourues = $sauvegardeHumaineMigratoireNbPersonnesSecourues;

        return $this;
    }

    public function getAssistanceNbHeuresMer(): ?int
    {
        return $this->assistanceNbHeuresMer;
    }

    public function setAssistanceNbHeuresMer(?int $assistanceNbHeuresMer): self
    {
        $this->assistanceNbHeuresMer = $assistanceNbHeuresMer;

        return $this;
    }

    public function getAssistanceNbHeuresVol(): ?int
    {
        return $this->assistanceNbHeuresVol;
    }

    public function setAssistanceNbHeuresVol(?int $assistanceNbHeuresVol): self
    {
        $this->assistanceNbHeuresVol = $assistanceNbHeuresVol;

        return $this;
    }

    public function getAssistanceNbOpeANED(): ?int
    {
        return $this->assistanceNbOpeANED;
    }

    public function setAssistanceNbOpeANED(?int $assistanceNbOpeANED): self
    {
        $this->assistanceNbOpeANED = $assistanceNbOpeANED;

        return $this;
    }

    public function getAssistanceNbInterventionMiseEnDemeure(): ?int
    {
        return $this->assistanceNbInterventionMiseEnDemeure;
    }

    public function setAssistanceNbInterventionMiseEnDemeure(?int $assistanceNbInterventionMiseEnDemeure): self
    {
        $this->assistanceNbInterventionMiseEnDemeure = $assistanceNbInterventionMiseEnDemeure;

        return $this;
    }

    public function getAssistanceNbMiseEnDemeureEvaluation(): ?int
    {
        return $this->assistanceNbMiseEnDemeureEvaluation;
    }

    public function setAssistanceNbMiseEnDemeureEvaluation(?int $assistanceNbMiseEnDemeureEvaluation): self
    {
        $this->assistanceNbMiseEnDemeureEvaluation = $assistanceNbMiseEnDemeureEvaluation;

        return $this;
    }

    public function getAssistanceNbMiseEnOeuvreCAPINAV(): ?int
    {
        return $this->assistanceNbMiseEnOeuvreCAPINAV;
    }

    public function setAssistanceNbMiseEnOeuvreCAPINAV(?int $assistanceNbMiseEnOeuvreCAPINAV): self
    {
        $this->assistanceNbMiseEnOeuvreCAPINAV = $assistanceNbMiseEnOeuvreCAPINAV;

        return $this;
    }

    public function getAssistanceNbRemorquages(): ?int
    {
        return $this->assistanceNbRemorquages;
    }

    public function setAssistanceNbRemorquages(?int $assistanceNbRemorquages): self
    {
        $this->assistanceNbRemorquages = $assistanceNbRemorquages;

        return $this;
    }

    public function getAssistanceNbOpeMaintenanceSignalisation(): ?int
    {
        return $this->assistanceNbOpeMaintenanceSignalisation;
    }

    public function setAssistanceNbOpeMaintenanceSignalisation(?int $assistanceNbOpeMaintenanceSignalisation): self
    {
        $this->assistanceNbOpeMaintenanceSignalisation = $assistanceNbOpeMaintenanceSignalisation;

        return $this;
    }

    public function getAssistanceNbOpeDeminage(): ?int
    {
        return $this->assistanceNbOpeDeminage;
    }

    public function setAssistanceNbOpeDeminage(?int $assistanceNbOpeDeminage): self
    {
        $this->assistanceNbOpeDeminage = $assistanceNbOpeDeminage;

        return $this;
    }

    public function getAssistanceNbMunitionsDetruites(): ?int
    {
        return $this->assistanceNbMunitionsDetruites;
    }

    public function setAssistanceNbMunitionsDetruites(?int $assistanceNbMunitionsDetruites): self
    {
        $this->assistanceNbMunitionsDetruites = $assistanceNbMunitionsDetruites;

        return $this;
    }

    public function getAssistancePoidsMatiereActive(): ?int
    {
        return $this->assistancePoidsMatiereActive;
    }

    public function setAssistancePoidsMatiereActive(?int $assistancePoidsMatiereActive): self
    {
        $this->assistancePoidsMatiereActive = $assistancePoidsMatiereActive;

        return $this;
    }

    public function getLutteTraficArmesNbHeuresMer(): ?int
    {
        return $this->lutteTraficArmesNbHeuresMer;
    }

    public function setLutteTraficArmesNbHeuresMer(?int $lutteTraficArmesNbHeuresMer): self
    {
        $this->lutteTraficArmesNbHeuresMer = $lutteTraficArmesNbHeuresMer;

        return $this;
    }

    public function getLutteTraficArmesNbHeureVol(): ?int
    {
        return $this->lutteTraficArmesNbHeureVol;
    }

    public function setLutteTraficArmesNbHeureVol(?int $lutteTraficArmesNbHeureVol): self
    {
        $this->lutteTraficArmesNbHeureVol = $lutteTraficArmesNbHeureVol;

        return $this;
    }

    public function getLutteTraficArmesNbOpeMer(): ?int
    {
        return $this->lutteTraficArmesNbOpeMer;
    }

    public function setLutteTraficArmesNbOpeMer(?int $lutteTraficArmesNbOpeMer): self
    {
        $this->lutteTraficArmesNbOpeMer = $lutteTraficArmesNbOpeMer;

        return $this;
    }

    public function getLutteTraficArmesNbInspectionsMer(): ?int
    {
        return $this->lutteTraficArmesNbInspectionsMer;
    }

    public function setLutteTraficArmesNbInspectionsMer(?int $lutteTraficArmesNbInspectionsMer): self
    {
        $this->lutteTraficArmesNbInspectionsMer = $lutteTraficArmesNbInspectionsMer;

        return $this;
    }

    public function getLutteTraficArmesNbNaviresSaisisMer(): ?int
    {
        return $this->lutteTraficArmesNbNaviresSaisisMer;
    }

    public function setLutteTraficArmesNbNaviresSaisisMer(?int $lutteTraficArmesNbNaviresSaisisMer): self
    {
        $this->lutteTraficArmesNbNaviresSaisisMer = $lutteTraficArmesNbNaviresSaisisMer;

        return $this;
    }

    public function getLutteTraficArmesNbArmesMunitionsSaisies(): ?int
    {
        return $this->lutteTraficArmesNbArmesMunitionsSaisies;
    }

    public function setLutteTraficArmesNbArmesMunitionsSaisies(?int $lutteTraficArmesNbArmesMunitionsSaisies): self
    {
        $this->lutteTraficArmesNbArmesMunitionsSaisies = $lutteTraficArmesNbArmesMunitionsSaisies;

        return $this;
    }

    public function getLutteTraficStupefiantNbHeuresMer(): ?int
    {
        return $this->lutteTraficStupefiantNbHeuresMer;
    }

    public function setLutteTraficStupefiantNbHeuresMer(?int $lutteTraficStupefiantNbHeuresMer): self
    {
        $this->lutteTraficStupefiantNbHeuresMer = $lutteTraficStupefiantNbHeuresMer;

        return $this;
    }

    public function getLutteTraficStupefiantNbHeuresVol(): ?int
    {
        return $this->lutteTraficStupefiantNbHeuresVol;
    }

    public function setLutteTraficStupefiantNbHeuresVol(?int $lutteTraficStupefiantNbHeuresVol): self
    {
        $this->lutteTraficStupefiantNbHeuresVol = $lutteTraficStupefiantNbHeuresVol;

        return $this;
    }

    public function getLutteTraficStupefiantNbOpeNARCO(): ?int
    {
        return $this->lutteTraficStupefiantNbOpeNARCO;
    }

    public function setLutteTraficStupefiantNbOpeNARCO(?int $lutteTraficStupefiantNbOpeNARCO): self
    {
        $this->lutteTraficStupefiantNbOpeNARCO = $lutteTraficStupefiantNbOpeNARCO;

        return $this;
    }

    public function getLutteTraficStupefiantNbInspectionsMer(): ?int
    {
        return $this->lutteTraficStupefiantNbInspectionsMer;
    }

    public function setLutteTraficStupefiantNbInspectionsMer(?int $lutteTraficStupefiantNbInspectionsMer): self
    {
        $this->lutteTraficStupefiantNbInspectionsMer = $lutteTraficStupefiantNbInspectionsMer;

        return $this;
    }

    public function getLutteTraficStupefiantNbNavireSaisisMer(): ?int
    {
        return $this->lutteTraficStupefiantNbNavireSaisisMer;
    }

    public function setLutteTraficStupefiantNbNavireSaisisMer(?int $lutteTraficStupefiantNbNavireSaisisMer): self
    {
        $this->lutteTraficStupefiantNbNavireSaisisMer = $lutteTraficStupefiantNbNavireSaisisMer;

        return $this;
    }

    public function getLutteTraficStupefiantKgSaisis(): ?int
    {
        return $this->lutteTraficStupefiantKgSaisis;
    }

    public function setLutteTraficStupefiantKgSaisis(?int $lutteTraficStupefiantKgSaisis): self
    {
        $this->lutteTraficStupefiantKgSaisis = $lutteTraficStupefiantKgSaisis;

        return $this;
    }

    public function getLutteTraficEspecesNbHeuresMer(): ?int
    {
        return $this->lutteTraficEspecesNbHeuresMer;
    }

    public function setLutteTraficEspecesNbHeuresMer(?int $lutteTraficEspecesNbHeuresMer): self
    {
        $this->lutteTraficEspecesNbHeuresMer = $lutteTraficEspecesNbHeuresMer;

        return $this;
    }

    public function getLutteTraficEspecesNbHeuresVol(): ?int
    {
        return $this->lutteTraficEspecesNbHeuresVol;
    }

    public function setLutteTraficEspecesNbHeuresVol(?int $lutteTraficEspecesNbHeuresVol): self
    {
        $this->lutteTraficEspecesNbHeuresVol = $lutteTraficEspecesNbHeuresVol;

        return $this;
    }

    public function getLutteTraficEspecesNbNaviresSaisisMer(): ?int
    {
        return $this->lutteTraficEspecesNbNaviresSaisisMer;
    }

    public function setLutteTraficEspecesNbNaviresSaisisMer(?int $lutteTraficEspecesNbNaviresSaisisMer): self
    {
        $this->lutteTraficEspecesNbNaviresSaisisMer = $lutteTraficEspecesNbNaviresSaisisMer;

        return $this;
    }

    public function getLutteTraficEspecesNbSaisis(): ?int
    {
        return $this->lutteTraficEspecesNbSaisis;
    }

    public function setLutteTraficEspecesNbSaisis(?int $lutteTraficEspecesNbSaisis): self
    {
        $this->lutteTraficEspecesNbSaisis = $lutteTraficEspecesNbSaisis;

        return $this;
    }

    public function getImmigrationNbHeuresVol(): ?int
    {
        return $this->immigrationNbHeuresVol;
    }

    public function setImmigrationNbHeuresVol(?int $immigrationNbHeuresVol): self
    {
        $this->immigrationNbHeuresVol = $immigrationNbHeuresVol;

        return $this;
    }

    public function getImmigrationNbNaviresInterceptes(): ?int
    {
        return $this->immigrationNbNaviresInterceptes;
    }

    public function setImmigrationNbNaviresInterceptes(?int $immigrationNbNaviresInterceptes): self
    {
        $this->immigrationNbNaviresInterceptes = $immigrationNbNaviresInterceptes;

        return $this;
    }

    public function getImmigrationNbMigrantInterceptes(): ?int
    {
        return $this->immigrationNbMigrantInterceptes;
    }

    public function setImmigrationNbMigrantInterceptes(?int $immigrationNbMigrantInterceptes): self
    {
        $this->immigrationNbMigrantInterceptes = $immigrationNbMigrantInterceptes;

        return $this;
    }

    public function getImmigrationNbPasseursInterceptes(): ?int
    {
        return $this->immigrationNbPasseursInterceptes;
    }

    public function setImmigrationNbPasseursInterceptes(?int $immigrationNbPasseursInterceptes): self
    {
        $this->immigrationNbPasseursInterceptes = $immigrationNbPasseursInterceptes;

        return $this;
    }
}

<template>
    <div>
        <h2>Répartition des heures de la mission</h2>
        <span class="panel__header-extra">Indiquer ici la répartition des heures de mission (selon les indicateurs du suivi AEM et SMC3).
            Le temps est à indiquer <strong>pour l'équipe</strong> (si la mission a compté 6h de contrôle noter 6:00 même s'il y avait plus d'un agent dans le groupe de la mission). </span>
        <table class="table">
            <tr>
                <th/>
                <th style="width: 8em;">En mer</th>
                <th style="width: 8em;">À terre</th>
                <th style="width: 8em;">Aérien</th>
                <th style="width: 8em;"></th>
            </tr>
            <tr>
                <td>Contrôle / surveillance</td>
                <td><input type="time" class="" v-model="controleMer"></td>
                <td><input type="time" class="" v-model="controleTerre"></td>
                <td><input type="time" class="" v-model="controleAerien"></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;dont en aire marine protégée</td>
                <td><input type="time" class="" v-model="controleAireProtegeeMer"></td>
                <td><input type="time" class="" v-model="controleAireProtegeeTerre"></td>
                <td><input type="time" class="" v-model="controleAireProtegeeAerien"></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;dont surveillance et lutte contre les rejets illicite, pollution (AEM 4.1)
                </td>
                <td><input type="time" class="" v-model="controlePollutionMer"></td>
                <td><input type="time" class="" v-model="controlePollutionTerre"></td>
                <td><input type="time" class="" v-model="controlePollutionAerien"></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;dont surveillance et contrôle pour la protection de l'environnement (AEM
                    4.3)
                </td>
                <td><input type="time" class="" v-model="controleEnvironnementMer"></td>
                <td><input type="time" class="" v-model="controleEnvironnementTerre"></td>
                <td><input type="time" class="" v-model="controleEnvironnementAerien"></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;dont en zone de contamination totale Chlordécone (Antilles)</td>
                <td><input type="time" class="" v-model="controleChlordeconeTotalMer"></td>
                <td><input type="time" class="" v-model="controleChlordeconeTotalTerre"></td>
                <td/>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;dont en zone de contamination partielle Chlordécone (Antilles)</td>
                <td><input type="time" class="" v-model="controleChlordeconePartielMer"></td>
                <td><input type="time" class="" v-model="controleChlordeconePartielTerre"></td>
                <td/>
            </tr>
            <tr>
              <td>Participation à une opération de lutte ANTIPOL en mer (simple brassage)</td>
              <td></td>
              <td></td>
              <td></td>
              <td><input type="number" class="" v-model="luttePollutionParticipationANTIPOL"></td>
            </tr>
            <tr>
              <td>Déploiement d’un dispositif de lutte anti-pollution en mer (dispersant, barrage, etc…)</td>
              <td><input type="number" class="" v-model="luttePollutionDeploiementEnMer"></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Nombre d'infractions constatées (Répression contre les rejets illicites, lutte contre les pollutions)</td>
              <td></td>
              <td></td>
              <td></td>
              <td><input type="number" class="" v-model="luttePollutionNbInfractions"></td>
            </tr>
            <tr>
              <td>Nombre de déroutements effectués (Répression contre les rejets illicites, lutte contre les pollutions)</td>
              <td></td>
              <td></td>
              <td></td>
              <td><input type="number" class="" v-model="luttePollutionNbDeroutements"></td>
            </tr>
            <tr>
              <td>Nombre de pollutions détectées et/ou constatées par un agent habilité (AEM 4.2.8)</td>
              <td></td>
              <td></td>
              <td></td>
              <td><input type="number" class="" v-model="luttePollutionNbPollutionsDetectees"></td>
            </tr>
            <tr>
                <td>Contrôle croisés</td>
                <td/>
                <td><input type="time" class="" v-model="controleCroise">
                <td/>
                <td/>
            </tr>

            <tr>
                <td>Visite de sécurité (au titre de l'inspection de la sécurité des navires)</td>
                <td/>
                <td><input type="time" class="" v-model="visiteSecurite">
                <td/>
                <td/>
            </tr>
            <tr>
                <td>Nombre visite de sécurité (au titre de l'inspection de la sécurité des navires)</td>
                <td/>
                <td><input class="" v-model="nombreVisiteSecurite">
                <td/>
                <td/>
            </tr>
            <tr>
                <td>Surveillance de manifestation nautique / plan d'eau</td>
                <td><input type="time" class="" v-model="surveillanceManifestationMer"></td>
                <td><input type="time" class="" v-model="surveillanceManifestationTerre"></td>
                <td/>
            </tr>
            <tr>
                <td>Surveillance du DPM et AOT DPM</td>
                <td><input type="time" class="" v-model="surveillanceDpmMer"></td>
                <td><input type="time" class="" v-model="surveillanceDpmTerre"></td>
                <td/>
            </tr>
            <tr>
                <td>Nombre d'heures pour la sûreté maritime (y compris VIGIMER )</td>
                <td><input type="time" class="" v-model="surete"></td>
                <td></td>
                <td><input type="time" class="" v-model="sureteMaritimeNbHeuresVol"></td>
                <td></td>
            </tr>
            <tr>
                <td>Nombre d'heures de mer de maintien de l'ordre public en mer</td>
                <td><input type="time" class="" v-model="maintienOrdre"></td>
                <td/>
                <td/>
            </tr>
            <tr>
              <td>Nombre d'opérations de maintien de l'ordre public en mer</td>
              <td><input type="number" class="" v-model="sureteMaritimeNbOpeMer"></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Nombre de traversées protégées par des équipes d'agents de l'Etat</td>
              <td></td>
              <td></td>
              <td></td>
              <td><input type="number" class="" v-model="sureteMaritimeNbTraverseesProtegees"></td>
            </tr>
            <tr>
                <td>Nombre d'heures de mer pour assistance aux navires en difficulté et sécurité maritime</td>
                <td><input type="time" class="" v-model="assistance"></td>
                <td/>
                <td/>
            </tr>
            <tr>
                <td>Nombre d'heures de plongée (lors d'une mission)</td>
                <td><input type="time" class="" v-model="plongee"></td>
                <td/>
                <td/>
            </tr>
            <tr>
              <td><strong>Sauvegarde de la vie humaine hors cadre d'un phénomène migratoire</strong></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'heures</td>
              <td><input type="time" class="" v-model="sauvegardeHumaineNbHeureMer"></td>
              <td></td>
              <td><input type="time" class="" v-model="sauvegardeHumaineNbHeuresVol"></td>
              <td></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'opérations conduites</td>
              <td></td>
              <td></td>
              <td></td>
              <td><input type="number" class="" v-model="sauvegardeHumaineNbOpeConduites"></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre de personnes secourues</td>
              <td></td>
              <td></td>
              <td></td>
              <td><input type="number" class="" v-model="sauvegardeHumaineNbPersonnesSecourues" placeholder="0"></td>
            </tr>
          <tr>
            <td><strong>Sauvegarde de la vie humaine dans le cadre d'un phénomène migratoire</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'heures</td>
            <td><input type="time" class="" v-model="sauvegardeHumaineMigratoireNbHeuresMer"></td>
            <td></td>
            <td><input type="time" class="" v-model="sauvegardeHumaineMigratoireNbHeuresVol"></td>
            <td></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'opérations conduites</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="sauvegardeHumaineMigratoireNbOpeConduite" placeholder="0"></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;(SAR migrants) Nombre d'embarcations suivies sans nécessité d'intervention</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="sauvegardeHumaineMigratoireNbEmbarcationsSansIntervention" placeholder="0"></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;(SAR migrants)Nombre d'embarcations assistées pour un retour à terre</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="sauvegardeHumaineMigratoireNbEmbarcationsAssisteesRetourTerre" placeholder="0"></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;(SAR migrants) Nombre d'opérations de sauvetage conduites </td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="sauvegardeHumaineMigratoireNbOpeSauvetageConduites" placeholder="0"></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;(SAR migrants)Nombre de personnes secourues</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="sauvegardeHumaineMigratoireNbPersonnesSecourues" placeholder="0"></td>
          </tr>


          <tr>
            <td><strong>Assistance aux navires en difficulté et sécurité maritime</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'heures</td>
            <td><input type="time" class="" v-model="assistanceNbHeuresMer"></td>
            <td></td>
            <td><input type="time" class="" v-model="assistanceNbHeuresVol"></td>
            <td></td>
          </tr>


          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'opérations ANED (mise en œuvre de moyens nautique ou aérien)</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="assistanceNbOpeANED" placeholder="0"></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'intervention faisant suite à une mise en demeure</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="assistanceNbInterventionMiseEnDemeure" placeholder="0"></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre de mises en œuvre de l'équipe d'évaluation et d'intervention</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="assistanceNbMiseEnDemeureEvaluation" placeholder="0"></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre de mise en oeuvre de la CAPINAV</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="assistanceNbMiseEnOeuvreCAPINAV" placeholder="0"></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre de remorquages</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="assistanceNbRemorquages" placeholder="0"></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'opération de maintenance des systèmes de signalisation maritime</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="assistanceNbOpeMaintenanceSignalisation" placeholder="0"></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'opérations de déminage</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="assistanceNbOpeDeminage" placeholder="0"></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre de munitions détruites</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="assistanceNbMunitionsDetruites" placeholder="0"></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Poids de la matière active correspondante (en kg)</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="assistancePoidsMatiereActive" placeholder="0"></td>
          </tr>



          <tr>
            <td><strong>Lutte contre le trafic en mer d’armes, de munitions ou d’explosifs</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'heures</td>
            <td><input type="time" class="" v-model="lutteTraficArmesNbHeuresMer"></td>
            <td></td>
            <td><input type="time" class="" v-model="lutteTraficArmesNbHeureVol"></td>
            <td></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'opérations</td>
            <td><input type="number" class="" v-model="lutteTraficArmesNbOpeMer"></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d’inspections</td>
            <td><input type="number" class="" v-model="lutteTraficArmesNbInspectionsMer" placeholder="0"></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre de navires ou embarcations déroutés ou saisis en mer</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="lutteTraficArmesNbNaviresSaisisMer" placeholder="0"></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'armes et de munitions saisies suite à ces opérations</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="lutteTraficArmesNbArmesMunitionsSaisies" placeholder="0"></td>
          </tr>


          <tr>
            <td><strong>Lutte contre le trafic en mer de produits stupéfiants</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'heures</td>
            <td><input type="time" class="" v-model="lutteTraficStupefiantNbHeuresMer"></td>
            <td></td>
            <td><input type="time" class="" v-model="lutteTraficStupefiantNbHeuresVol"></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'opérations NARCO en mer</td>
            <td><input type="number" class="" v-model="lutteTraficStupefiantNbOpeNARCO" placeholder="0"></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'inspections</td>
            <td><input type="number" class="" v-model="lutteTraficStupefiantNbInspectionsMer" placeholder="0"></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre de navires ou embarcations déroutés ou saisis</td>
            <td><input type="number" class="" v-model="lutteTraficStupefiantNbNavireSaisisMer" placeholder="0"></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Quantité saisie en kg suite à ces opérations</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="lutteTraficStupefiantKgSaisis" placeholder="0"></td>
          </tr>

          <tr>
            <td><strong>Lutte contre le trafic en mer d’espèces protégées</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'heures</td>
            <td><input type="time" class="" v-model="lutteTraficEspecesNbHeuresMer"></td>
            <td></td>
            <td><input type="time" class="" v-model="lutteTraficEspecesNbHeuresVol"></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre de navires ou embarcations déroutés ou saisis</td>
            <td><input type="number" class="" v-model="lutteTraficEspecesNbNaviresSaisisMer" placeholder="0"></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre de saisies</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="lutteTraficEspecesNbSaisis" placeholder="0"></td>
          </tr>

          <tr>
            <td><strong>Lutte contre l’immigration illégale par voie maritime</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'heures</td>
            <td><input type="time" class="" v-model="immigration"></td>
            <td></td>
            <td><input type="time" class="" v-model="immigrationNbHeuresVol"></td>
            <td></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre de navires/embarcations interceptés </td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="immigrationNbNaviresInterceptes"></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre de migrants interceptés </td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="immigrationNbMigrantInterceptes"></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre de passeurs présumés interceptés</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="immigrationNbPasseursInterceptes"></td>
          </tr>

          <tr>
            <td><strong> Lutte contre les activités de pêche illégale</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre de navires de pêche contrôlés par VHF en mer </td>
            <td><input type="number" class="" v-model="luttePecheNbNavireControleVHFmer" placeholder="0"></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Quantitée de produits de la pêche saisis/rejetés en mer(en kg)</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="luttePecheKgProduitsSaisisMer" placeholder="0"></td>
          </tr>

          <tr>
            <td><strong>Protection des biens culturels maritimes</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'heures</td>
            <td><input type="time" class="" v-model="protectionCulturelNbHeuresMer"></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'opérations scientifiques</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="protectionCulturelNbOpeScientifiques" placeholder="0"></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'opération de police des BCM</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="protectionCulturelNbOpePoliceBCM" placeholder="0"></td>
          </tr>

          <tr>
            <td><strong>Souveraineté et protection des intérêts nationaux </strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre total de navires reconnus dans les approches maritimes (ZEE)</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" class="" v-model="souveraineteNbNavireApprocheMaritime" placeholder="0"></td>
          </tr>

          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d’heures dédiées à un évènement de piraterie ou brigandage</td>
            <td><input type="time" class="" v-model="souveraineteNbHeuresMerPiraterie"></td>
            <td></td>
            <td><input type="time" class="" v-model="souveraineteNbHeuresVolPiraterie"></td>
            <td></td>
          </tr>


        </table>
    </div>
</template>

<script>

    export default {
        name: "timeDivision",
        props: [
            'value',
        ],
        data: function() {
            return {
              controleMer: this.value.controleMer || null,
              controleTerre: this.value.controleTerre || null,
              controleAerien: this.value.controleAerien || null,
              controleAireProtegeeMer: this.value.controleAireProtegeeMer || null,
              controleAireProtegeeTerre: this.value.controleAireProtegeeTerre || null,
              controleAireProtegeeAerien: this.value.controleAireProtegeeAerien || null,
              controlePollutionMer: this.value.controlePollutionMer || null,
              controlePollutionTerre: this.value.controlePollutionTerre || null,
              controlePollutionAerien: this.value.controlePollutionAerien || null,
              controleEnvironnementMer: this.value.controleEnvironnementMer || null,
              controleEnvironnementTerre: this.value.controleEnvironnementTerre || null,
              controleEnvironnementAerien: this.value.controleEnvironnementAerien || null,
              controleChlordeconeTotalMer: this.value.controleChlordeconeTotalMer || null,
              controleChlordeconeTotalTerre: this.value.controleChlordeconeTotalTerre || null,
              controleChlordeconePartielMer: this.value.controleChlordeconePartielMer || null,
              controleChlordeconePartielTerre: this.value.controleChlordeconePartielTerre || null,
              controleCroise: this.value.controleCroise || null,
              immigration: this.value.immigration || null,
              visiteSecurite: this.value.visiteSecurite || null,
              nombreVisiteSecurite: this.value.nombreVisiteSecurite || null,
              surveillanceManifestationMer: this.value.surveillanceManifestationMer || null,
              surveillanceManifestationTerre: this.value.surveillanceManifestationTerre || null,
              surveillanceDpmMer: this.value.surveillanceDpmMer || null,
              surveillanceDpmTerre: this.value.surveillanceDpmTerre || null,
              surete: this.value.surete || null,
              maintienOrdre: this.value.maintienOrdre || null,
              assistance: this.value.assistance || null,
              plongee: this.value.plongee || null,
              sauvegardeHumaineNbHeureMer: this.value.sauvegardeHumaineNbHeureMer || null,
              sauvegardeHumaineNbHeuresVol: this.value.sauvegardeHumaineNbHeuresVol || null,
              sauvegardeHumaineNbOpeConduites: this.value.sauvegardeHumaineNbOpeConduites || null,
              sauvegardeHumaineNbPersonnesSecourues: this.value.sauvegardeHumaineNbPersonnesSecourues || null,
              sauvegardeHumaineMigratoireNbHeuresVol: this.value.sauvegardeHumaineMigratoireNbHeuresVol || null,
              sauvegardeHumaineMigratoireNbHeuresMer: this.value.sauvegardeHumaineMigratoireNbHeuresMer || null,
              sauvegardeHumaineMigratoireNbOpeConduite: this.value.sauvegardeHumaineMigratoireNbOpeConduite || null,
              sauvegardeHumaineMigratoireNbEmbarcationsSansIntervention: this.value.sauvegardeHumaineMigratoireNbEmbarcationsSansIntervention || null,
              sauvegardeHumaineMigratoireNbEmbarcationsAssisteesRetourTerre: this.value.sauvegardeHumaineMigratoireNbEmbarcationsAssisteesRetourTerre || null,
              sauvegardeHumaineMigratoireNbOpeSauvetageConduites: this.value.sauvegardeHumaineMigratoireNbOpeSauvetageConduites,
              sauvegardeHumaineMigratoireNbPersonnesSecourues: this.value.sauvegardeHumaineMigratoireNbPersonnesSecourues,
              assistanceNbOpeANED: this.value.assistanceNbOpeANED || null,
              assistanceNbInterventionMiseEnDemeure: this.value.assistanceNbInterventionMiseEnDemeure || null,
              assistanceNbMiseEnDemeureEvaluation: this.value.assistanceNbMiseEnDemeureEvaluation || null,
              assistanceNbMiseEnOeuvreCAPINAV: this.value.assistanceNbMiseEnOeuvreCAPINAV || null,
              assistanceNbRemorquages: this.value.assistanceNbRemorquages || null,
              assistanceNbOpeMaintenanceSignalisation: this.value.assistanceNbOpeMaintenanceSignalisation || null,
              assistanceNbOpeDeminage: this.value.assistanceNbOpeDeminage || null,
              assistanceNbMunitionsDetruites: this.value.assistanceNbMunitionsDetruites || null,
              assistancePoidsMatiereActive: this.value.assistancePoidsMatiereActive || null,
              assistanceNbHeuresMer: this.value.assistanceNbHeuresMer || null,
              assistanceNbHeuresVol: this.value.assistanceNbHeuresVol || null,
              lutteTraficArmesNbHeuresMer: this.value.lutteTraficArmesNbHeuresMer || null,
              lutteTraficArmesNbHeureVol: this.value.lutteTraficArmesNbHeureVol || null,
              lutteTraficArmesNbOpeMer: this.value.lutteTraficArmesNbOpeMer || null,
              lutteTraficArmesNbInspectionsMer: this.value.lutteTraficArmesNbInspectionsMer || null,
              lutteTraficArmesNbNaviresSaisisMer: this.value.lutteTraficArmesNbNaviresSaisisMer || null,
              lutteTraficArmesNbArmesMunitionsSaisies: this.value.lutteTraficArmesNbArmesMunitionsSaisies || null,
              lutteTraficStupefiantNbHeuresMer: this.value.lutteTraficStupefiantNbHeuresMer || null,
              lutteTraficStupefiantNbHeuresVol: this.value.lutteTraficStupefiantNbHeuresVol || null,
              lutteTraficStupefiantNbOpeNARCO: this.value.lutteTraficStupefiantNbOpeNARCO || null,
              lutteTraficStupefiantNbInspectionsMer: this.value.lutteTraficStupefiantNbInspectionsMer || null,
              lutteTraficStupefiantNbNavireSaisisMer: this.value.lutteTraficStupefiantNbNavireSaisisMer || null,
              lutteTraficStupefiantKgSaisis: this.value.lutteTraficStupefiantKgSaisis || null,
              lutteTraficEspecesNbHeuresMer: this.value.lutteTraficEspecesNbHeuresMer || null,
              lutteTraficEspecesNbHeuresVol: this.value.lutteTraficEspecesNbHeuresVol || null,
              lutteTraficEspecesNbNaviresSaisisMer: this.value.lutteTraficEspecesNbNaviresSaisisMer || null,
              lutteTraficEspecesNbSaisis: this.value.lutteTraficEspecesNbSaisis || null,
              immigrationNbHeuresVol: this.value.immigrationNbHeuresVol || null,
              immigrationNbNaviresInterceptes: this.value.immigrationNbNaviresInterceptes || null,
              immigrationNbMigrantInterceptes: this.value.immigrationNbMigrantInterceptes || null,
              immigrationNbPasseursInterceptes: this.value.immigrationNbPasseursInterceptes || null,
              luttePollutionDeploiementEnMer: this.value.luttePollutionDeploiementEnMer || null,
              luttePollutionNbDeroutements: this.value.luttePollutionNbDeroutements || null,
              luttePollutionNbInfractions: this.value.luttePollutionNbInfractions || null,
              luttePollutionPV: this.value.luttePollutionPV || null,
              luttePollutionParticipationANTIPOL: this.value.luttePollutionParticipationANTIPOL || null,
              luttePollutionNbPollutionsDetectees: this.value.luttePollutionNbPollutionsDetectees || null,
              luttePecheNbNavireControleVHFmer: this.value.luttePecheNbNavireControleVHFmer || null,
              luttePecheKgProduitsSaisisMer: this.value.luttePecheKgProduitsSaisisMer || null,
              protectionCulturelNbHeuresMer: this.value.protectionCulturelNbHeuresMer || null,
              protectionCulturelNbOpePoliceBCM: this.value.protectionCulturelNbOpePoliceBCM || null,
              protectionCulturelNbOpeScientifiques: this.value.protectionCulturelNbOpeScientifiques || null,
              sureteMaritimeNbHeuresVol: this.value.sureteMaritimeNbHeuresVol || null,
              sureteMaritimeNbOpeMer: this.value.sureteMaritimeNbOpeMer || null,
              sureteMaritimeNbTraverseesProtegees: this.value.sureteMaritimeNbTraverseesProtegees || null,
              souveraineteNbNavireApprocheMaritime: this.value.souveraineteNbNavireApprocheMaritime || null,
              souveraineteNbHeuresMerPiraterie: this.value.souveraineteNbHeuresMerPiraterie || null,
              souveraineteNbHeuresVolPiraterie: this.value.souveraineteNbHeuresVolPiraterie || null
            }
        },
        computed: {
            timeDivision: function() {
                return {
                  controleMer: this.controleMer,
                  controleTerre: this.controleTerre,
                  controleAerien: this.controleAerien,
                  controleAireProtegeeMer: this.controleAireProtegeeMer,
                  controleAireProtegeeTerre: this.controleAireProtegeeTerre,
                  controleAireProtegeeAerien: this.controleAireProtegeeAerien,
                  controlePollutionMer: this.controlePollutionMer,
                  controlePollutionTerre: this.controlePollutionTerre,
                  controlePollutionAerien: this.controlePollutionAerien,
                  controleEnvironnementMer: this.controleEnvironnementMer,
                  controleEnvironnementTerre: this.controleEnvironnementTerre,
                  controleEnvironnementAerien: this.controleEnvironnementAerien,
                  controleChlordeconeTotalMer: this.controleChlordeconeTotalMer,
                  controleChlordeconeTotalTerre: this.controleChlordeconeTotalTerre,
                  controleChlordeconePartielMer: this.controleChlordeconePartielMer,
                  controleChlordeconePartielTerre: this.controleChlordeconePartielTerre,
                  controleCroise: this.controleCroise,
                  immigration: this.immigration,
                  visiteSecurite: this.visiteSecurite,
                  nombreVisiteSecurite: this.nombreVisiteSecurite,
                  surveillanceManifestationMer: this.surveillanceManifestationMer,
                  surveillanceManifestationTerre: this.surveillanceManifestationTerre,
                  surveillanceDpmMer: this.surveillanceDpmMer,
                  surveillanceDpmTerre: this.surveillanceDpmTerre,
                  surete: this.surete,
                  maintienOrdre: this.maintienOrdre,
                  assistance: this.assistance,
                  plongee: this.plongee,
                  sauvegardeHumaineNbHeureMer: this.sauvegardeHumaineNbHeureMer,
                  sauvegardeHumaineNbHeuresVol: this.sauvegardeHumaineNbHeuresVol,
                  sauvegardeHumaineNbOpeConduites: this.sauvegardeHumaineNbOpeConduites,
                  sauvegardeHumaineNbPersonnesSecourues: this.sauvegardeHumaineNbPersonnesSecourues,
                  sauvegardeHumaineMigratoireNbHeuresVol: this.sauvegardeHumaineMigratoireNbHeuresVol,
                  sauvegardeHumaineMigratoireNbHeuresMer: this.sauvegardeHumaineMigratoireNbHeuresMer,
                  sauvegardeHumaineMigratoireNbOpeConduite: this.sauvegardeHumaineMigratoireNbOpeConduite,
                  sauvegardeHumaineMigratoireNbEmbarcationsAssisteesRetourTerre: this.sauvegardeHumaineMigratoireNbEmbarcationsAssisteesRetourTerre,
                  sauvegardeHumaineMigratoireNbEmbarcationsSansIntervention: this.sauvegardeHumaineMigratoireNbEmbarcationsSansIntervention,
                  sauvegardeHumaineMigratoireNbPersonnesSecourues: this.sauvegardeHumaineMigratoireNbPersonnesSecourues,
                  sauvegardeHumaineMigratoireNbOpeSauvetageConduites: this.sauvegardeHumaineMigratoireNbOpeSauvetageConduites,
                  assistanceNbOpeANED: this.assistanceNbOpeANED,
                  assistanceNbInterventionMiseEnDemeure: this.assistanceNbInterventionMiseEnDemeure,
                  assistanceNbMiseEnDemeureEvaluation: this.assistanceNbMiseEnDemeureEvaluation,
                  assistanceNbMiseEnOeuvreCAPINAV: this.assistanceNbMiseEnOeuvreCAPINAV,
                  assistanceNbRemorquages: this.assistanceNbRemorquages,
                  assistanceNbOpeMaintenanceSignalisation: this.assistanceNbOpeMaintenanceSignalisation,
                  assistanceNbOpeDeminage: this.assistanceNbOpeDeminage,
                  assistanceNbMunitionsDetruites: this.assistanceNbMunitionsDetruites,
                  assistancePoidsMatiereActive: this.assistancePoidsMatiereActive,
                  assistanceNbHeuresMer: this.assistanceNbHeuresMer,
                  assistanceNbHeuresVol: this.assistanceNbHeuresVol,
                  lutteTraficArmesNbHeuresMer: this.lutteTraficArmesNbHeuresMer ,
                  lutteTraficArmesNbHeureVol: this.lutteTraficArmesNbHeureVol ,
                  lutteTraficArmesNbOpeMer: this.lutteTraficArmesNbOpeMer ,
                  lutteTraficArmesNbInspectionsMer: this.lutteTraficArmesNbInspectionsMer ,
                  lutteTraficArmesNbNaviresSaisisMer: this.lutteTraficArmesNbNaviresSaisisMer ,
                  lutteTraficArmesNbArmesMunitionsSaisies: this.lutteTraficArmesNbArmesMunitionsSaisies ,
                  lutteTraficStupefiantNbHeuresMer: this.lutteTraficStupefiantNbHeuresMer,
                  lutteTraficStupefiantNbHeuresVol: this.lutteTraficStupefiantNbHeuresVol,
                  lutteTraficStupefiantNbOpeNARCO: this.lutteTraficStupefiantNbOpeNARCO,
                  lutteTraficStupefiantNbInspectionsMer: this.lutteTraficStupefiantNbInspectionsMer,
                  lutteTraficStupefiantNbNavireSaisisMer: this.lutteTraficStupefiantNbNavireSaisisMer,
                  lutteTraficStupefiantKgSaisis: this.lutteTraficStupefiantKgSaisis,
                  lutteTraficEspecesNbHeuresMer: this.lutteTraficEspecesNbHeuresMer,
                  lutteTraficEspecesNbHeuresVol: this.lutteTraficEspecesNbHeuresVol,
                  lutteTraficEspecesNbNaviresSaisisMer: this.lutteTraficEspecesNbNaviresSaisisMer,
                  lutteTraficEspecesNbSaisis: this.lutteTraficEspecesNbSaisis,
                  immigrationNbPasseursInterceptes: this.immigrationNbPasseursInterceptes,
                  immigrationNbHeuresVol: this.immigrationNbHeuresVol,
                  immigrationNbNaviresInterceptes: this.immigrationNbNaviresInterceptes,
                  immigrationNbMigrantInterceptes: this.immigrationNbMigrantInterceptes,
                  luttePollutionDeploiementEnMer: this.luttePollutionDeploiementEnMer,
                  luttePollutionNbDeroutements: this.luttePollutionNbDeroutements,
                  luttePollutionNbInfractions: this.luttePollutionNbInfractions,
                  luttePollutionPV: this.luttePollutionPV,
                  luttePollutionParticipationANTIPOL: this.luttePollutionParticipationANTIPOL,
                  luttePollutionNbPollutionsDetectees: this.luttePollutionNbPollutionsDetectees,
                  luttePecheKgProduitsSaisisMer: this.luttePecheKgProduitsSaisisMer,
                  luttePecheNbNavireControleVHFmer: this.luttePecheNbNavireControleVHFmer,
                  protectionCulturelNbHeuresMer: this.protectionCulturelNbHeuresMer,
                  protectionCulturelNbOpePoliceBCM: this.protectionCulturelNbOpePoliceBCM,
                  protectionCulturelNbOpeScientifiques: this.protectionCulturelNbOpeScientifiques,
                  sureteMaritimeNbHeuresVol: this.sureteMaritimeNbHeuresVol,
                  sureteMaritimeNbOpeMer: this.sureteMaritimeNbOpeMer,
                  sureteMaritimeNbTraverseesProtegees: this.sureteMaritimeNbTraverseesProtegees,
                  souveraineteNbNavireApprocheMaritime: this.souveraineteNbNavireApprocheMaritime,
                  souveraineteNbHeuresMerPiraterie: this.souveraineteNbHeuresMerPiraterie,
                  souveraineteNbHeuresVolPiraterie: this.souveraineteNbHeuresVolPiraterie
                };
            }
        },
        watch: {
            timeDivision: function(cm) {
                this.$emit('input', this.timeDivision)
            }
        },
        methods: {}
    }
</script>

<style scoped>

</style>

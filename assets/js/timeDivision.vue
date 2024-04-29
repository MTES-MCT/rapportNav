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
                <td>Contrôle croisés</td>
                <td/>
                <td><input type="time" class="" v-model="controleCroise">
                <td/>
                <td/>
            </tr>
            <tr>
                <td>Lutte contre l'immigration illégale en mer</td>
                <td><input type="time" class="" v-model="immigration">
                <td/>
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
                <td>Nombre d'heures de mer pour la sûreté maritime (y compris VIGIMER )</td>
                <td><input type="time" class="" v-model="surete"></td>
                <td/>
                <td/>
            </tr>
            <tr>
                <td>Nombre d'heures de mer de maintien de l'ordre public en mer</td>
                <td><input type="time" class="" v-model="maintienOrdre"></td>
                <td/>
                <td/>
            </tr>
            <tr>
                <td>Nombre d'heures de mer pour assistance aux navires en difficulté et sécurité maritime (AEM 2.1)</td>
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
                sauvegardeHumaineMigratoireNbPersonnesSecourues: this.value.sauvegardeHumaineMigratoireNbPersonnesSecourues

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
                    sauvegardeHumaineMigratoireNbOpeSauvetageConduites: this.sauvegardeHumaineMigratoireNbOpeSauvetageConduites
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

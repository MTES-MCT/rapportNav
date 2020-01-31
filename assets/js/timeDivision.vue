<template>
    <div>
        <h2>Répartition des heures de la mission</h2>
        <table class="table">
            <tr>
                <th/>
                <th style="width: 8em;">En mer</th>
                <th style="width: 8em;">À terre</th>
                <th style="width: 8em;">Aérien</th>
            </tr>
            <tr>
                <td>Contrôle / surveillance</td>
                <td><input type="time" class="" v-model="controleMer" v-on:input="$emit('update:controle-mer', $event.target.value); localSave();"></td>
                <td><input type="time" class="" v-model="controleTerre" v-on:input="$emit('update:controle-terre', $event.target.value); localSave();"></td>
                <td><input type="time" class="" v-model="controleAerien" v-on:input="$emit('update:controle-aerien', $event.target.value); localSave();"></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;dont en aire marine protégée</td>
                <td><input type="time" class="" v-model="controleAireProtegeeMer" v-on:input="$emit('update:controle-aire-protegee-mer', $event.target.value); localSave();"></td>
                <td><input type="time" class="" v-model="controleAireProtegeeTerre" v-on:input="$emit('update:controle-aire-protegee-terre', $event.target.value); localSave();"></td>
                <td><input type="time" class="" v-model="controleAireProtegeeAerien" v-on:input="$emit('update:controle-aire-protegee-aerien', $event.target.value); localSave();"></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;dont surveillance et lutte contre les rejets illicite, pollution et protection de l'environnement (AEM 4.1)</td>
                <td><input type="time" class="" v-model="controlePollutionMer" v-on:input="$emit('update:controle-polution-mer', $event.target.value); localSave();"></td>
                <td><input type="time" class="" v-model="controlePollutionTerre" v-on:input="$emit('update:controle-polution-terre', $event.target.value); localSave();"></td>
                <td><input type="time" class="" v-model="controlePollutionAerien" v-on:input="$emit('update:controle-polution-aerien', $event.target.value); localSave();"></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;dont surveillance et contrôle pour la protection de l'environnement (AEM 4.3)</td>
                <td><input type="time" class="" v-model="controleEnvironnementMer" v-on:input="$emit('update:controle-environnement-mer', $event.target.value); localSave();"></td>
                <td><input type="time" class="" v-model="controleEnvironnementTerre" v-on:input="$emit('update:controle-environnement-terre', $event.target.value); localSave();"></td>
                <td><input type="time" class="" v-model="controleEnvironnementAerien" v-on:input="$emit('update:controle-environnement-aerien', $event.target.value); localSave();"></td>
            </tr>
            <tr>
                <td>Contrôle croisés</td>
                <td />
                <td><input type="time" class="" v-model="controleCroise" v-on:input="$emit('update:controle-croise', $event.target.value); localSave();"></td>
                <td />
            </tr>
            <tr>
                <td>Lutte contre l'immigration illégale en mer</td>
                <td><input type="time" class="" v-model="immigration" v-on:input="$emit('update:immigration', $event.target.value); localSave();"></td>
                <td />
                <td />
            </tr>
            <tr>
                <td>Visite de sécurité (au titre de l'inspection de la sécurité des navires)</td>
                <td/>
                <td><input type="time" class="" v-model="visiteSecurite" v-on:input="$emit('update:visite-securite', $event.target.value); localSave();"></td>
                <td />
            </tr>
            <tr>
                <td>Nombre visite de sécurité (au titre de l'inspection de la sécurité des navires)</td>
                <td/>
                <td><input class="" v-model="nombreVisiteSecurite" v-on:input="$emit('update:nombre-visite-securite', $event.target.value); localSave();"></td>
                <td />
            </tr>
            <tr>
                <td>Surveillance de manifestation nautique / plan d'eau</td>
                <td><input type="time" class="" v-model="surveillanceManifestationMer" v-on:input="$emit('update:surveillance-manifestation-mer', $event.target.value); localSave();"></td>
                <td><input type="time" class="" v-model="surveillanceManifestationTerre" v-on:input="$emit('update:surveillance-manifestation-terre', $event.target.value); localSave();"></td>
                <td />
            </tr>
            <tr>
                <td>Surveillance du DPM et AOT DPM</td>
                <td><input type="time" class="" v-model="surveillanceDpmMer" v-on:input="$emit('update:surveillance-dpm-mer', $event.target.value); localSave();"></td>
                <td><input type="time" class="" v-model="surveillanceDpmTerre" v-on:input="$emit('update:surveillance-dpm-terre', $event.target.value); localSave();"></td>
                <td />
            </tr>
            <tr>
                <td>Nombre d'heures de mer pour la sûreté maritime (y compris VIGIMER )</td>
                <td><input type="time" class="" v-model="surete" v-on:input="$emit('update:surete', $event.target.value); localSave();"></td>
                <td />
                <td />
            </tr>
            <tr>
                <td>Nombre d'heures de mer de maintien de l'ordre public en mer</td>
                <td><input type="time" class="" v-model="maintienOrdre" v-on:input="$emit('update:maintien-ordre', $event.target.value); localSave();"></td>
                <td />
                <td />
            </tr>
            <tr>
                <td>Nombre d'heures de mer pour assistance aux navires en difficulté et sécurité maritime (AEM 2.1)</td>
                <td><input type="time" class="" v-model="assistance" v-on:input="$emit('update:assistance', $event.target.value); localSave();"></td>
                <td />
                <td />
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        name: "timeDivision",
        props: [
            'controleMer',
            'controleTerre',
            'controleAerien',
            'controleAireProtegeeMer',
            'controleAireProtegeeTerre',
            'controleAireProtegeeAerien',
            'controlePollutionMer',
            'controlePollutionTerre',
            'controlePollutionAerien',
            'controleEnvironnementMer',
            'controleEnvironnementTerre',
            'controleEnvironnementAerien',
            'controleCroise',
            'immigration',
            'visiteSecurite',
            'nombreVisiteSecurite',
            'surveillanceManifestationMer',
            'surveillanceManifestationTerre',
            'surveillanceDpmMer',
            'surveillanceDpmTerre',
            'surete',
            'maintienOrdre',
            "assistance",
        ],
        methods: {
            update: function (data, value) {
                this.$emit('update', value);
            },
            localSave: function() {
                localStorage.setItem('timeDivision', JSON.stringify(this.$props));
            }
        }
    }
</script>

<style scoped>

</style>
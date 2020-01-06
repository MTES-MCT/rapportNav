<template>
    <div>
        <h2>Répartition des heures de la mission</h2>
        <table class="table">
            <tr>
                <th/>
                <th>En mer</th>
                <th>À terre</th>
            </tr>
            <tr>
                <td>Contrôle / surveillance</td>
                <td><input type="time" class="" v-model="controleMer" v-on:input="$emit('update:controle-mer', $event.target.value); localSave();"></td>
                <td><input type="time" class="" v-model="controleTerre" v-on:input="$emit('update:controle-terre', $event.target.value); localSave();"></td>
            </tr>
            <tr>
                <td>dont en aire marine protégée</td>
                <td><input type="time" class="" v-model="controleAireProtegeeMer" v-on:input="$emit('update:controle-aire-protegee-mer', $event.target.value); localSave();"></td>
                <td><input type="time" class="" v-model="controleAireProtegeeTerre" v-on:input="$emit('update:controle-aire-protegee-terre', $event.target.value); localSave();"></td>
            </tr>
            <tr>
                <td>Visite de sécurité (au titre de l'inspection de la sécurité des navires)</td>
                <td/>
                <td><input type="time" class="" v-model="visiteSecurite" v-on:input="$emit('update:visite-securite', $event.target.value); localSave();"></td>
            </tr>
            <tr>
                <td>Nombre visite de sécurité (au titre de l'inspection de la sécurité des navires)</td>
                <td/>
                <td><input class="" v-model="nombreVisiteSecurite" v-on:input="$emit('update:nombre-visite-securite', $event.target.value); localSave();"></td>
            </tr>
            <tr>
                <td>Surveillance de manifestation nautique / plan d'eau</td>
                <td><input type="time" class="" v-model="surveillanceManifestationMer" v-on:input="$emit('update:surveillance-manifestation-mer', $event.target.value); localSave();"></td>
                <td><input type="time" class="" v-model="surveillanceManifestationTerre" v-on:input="$emit('update:surveillance-manifestation-terre', $event.target.value); localSave();"></td>
            </tr>
            <tr>
                <td>Surveillance du DPM et AOT DPM</td>
                <td><input type="time" class="" v-model="surveillanceDpmMer" v-on:input="$emit('update:surveillance-dpm-mer', $event.target.value); localSave();"></td>
                <td><input type="time" class="" v-model="surveillanceDpmTerre" v-on:input="$emit('update:surveillance-dpm-terre', $event.target.value); localSave();"></td>
            </tr>
            <tr>
                <td>Nombre d'heures de mer pou la sûreté maritime (y compris VIGIMER )</td>
                <td><input type="time" class="" v-model="surete" v-on:input="$emit('update:surete', $event.target.value); localSave();"></td>
                <td />
            </tr>
            <tr>
                <td>Nombre d'heures de mer de maintien de l'ordre public en mer</td>
                <td><input type="time" class="" v-model="maintienOrdre" v-on:input="$emit('update:maintien-ordre', $event.target.value); localSave();"></td>
                <td />
            </tr>
            <tr>
                <td>Nombre d’opérations de maintien de l’ordre public en mer</td>
                <td><input type="number" class="" v-model="nombreOperationMaintienOrdre" v-on:input="$emit('update:nombre-operation-maintien-ordre', $event.target.value); localSave();"></td>
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
            'controleAireProtegeeMer',
            'controleAireProtegeeTerre',
            'visiteSecurite',
            'nombreVisiteSecurite',
            'surveillanceManifestationMer',
            'surveillanceManifestationTerre',
            'surveillanceDpmMer',
            'surveillanceDpmTerre',
            'surete',
            'maintienOrdre',
            'nombreOperationMaintienOrdre'
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
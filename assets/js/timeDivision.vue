<template>
    <div>
        <h3>Répartition des heures de la mission</h3>
        <table class="table">
            <tr>
                <th/>
                <th>En mer</th>
                <th>À terre</th>
            </tr>
            <tr>
                <td>Contrôle / surveillance</td>
                <td><input type="time" class="" v-model="controleMer" v-on:input="$emit('update:controle-mer', $event.target.value)"></td>
                <td><input type="time" class="" v-model="controleTerre" v-on:input="$emit('update:controle-terre', $event.target.value)"></td>
            </tr>
            <tr>
                <td>dont en aire marine protégée</td>
                <td><input type="time" class="" v-model="aireProtegeeMer" v-on:input="$emit('update:aire-protegee-mer', $event.target.value)"></td>
                <td><input type="time" class="" v-model="aireProtegeeTerre" v-on:input="$emit('update:aire-protegee-terre', $event.target.value)"></td>
            </tr>
            <tr>
                <td>Visite de sécurité</td>
                <td/>
                <td><input type="time" class="" v-model="visiteSecurite" v-on:input="$emit('update:visite-securite', $event.target.value)"></td>
            </tr>
            <tr>
                <td>Surveillance de manifestation nautique / plan d'eau</td>
                <td><input type="time" class="" v-model="surveillanceManifestationMer" v-on:input="$emit('update:surveillance-manifestation-mer', $event.target.value)"></td>
                <td><input type="time" class="" v-model="surveillanceManifestationTerre" v-on:input="$emit('update:surveillance-manifestation-terre', $event.target.value)"></td>
            </tr>
            <tr>
                <td>Surveillance du DPM et AOT DPM</td>
                <td><input type="time" class="" v-model="surveillanceDpmMer" v-on:input="$emit('update:surveillance-dpm-mer', $event.target.value)"></td>
                <td><input type="time" class="" v-model="surveillanceDpmTerre" v-on:input="$emit('update:surveillance-dpm-mer', $event.target.value)"></td>
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
            'aireProtegeeMer',
            'aireProtegeeTerre',
            'visiteSecurite',
            'surveillanceManifestationMer',
            'surveillanceManifestationTerre',
            'surveillanceDpmMer',
            'surveillanceDpmTerre',
        ],
        methods: {
            update: function (data, value) {
                this.$emit('update', value);
            }
        }
    }
</script>

<style scoped>

</style>
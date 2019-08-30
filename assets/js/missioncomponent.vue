<template>
    <div v-show="mission.active" class="row" style="align-items: center; padding: 1em;border: 2px solid var(--grey); margin-bottom: 1em;">
        <i v-bind:class="mission.logo" style="align-self: center;font-size: 2em;flex-grow: 0;"></i>
        <div class="" style="flex-grow: 1;max-width: 50%">
            <h5 style="margin: 0">Contrôle de {{ mission.type }}</h5>
            <div>
                <span class="label">{{ mission.terrestre ? 'Terre' : 'Mer' }}</span>
                <span v-for="zone in mission.zones">
                    <span class="label">{{ zone }}</span>
                </span>
            </div>
        </div>
        <ul v-if="undefined !== mission.controles" class="no-decoration" style="flex-grow: 1;">
            <li>{{ mission.controles.nombre }} {{mission.type}} contrôlés</li>
            <li>{{ mission.controles.pv }} PV</li>
        </ul>
        <a class="button" style="flex-grow: 0;" v-bind:href="modalHref "><i class="fas fa-pen"></i> Éditer cette mission</a>
    </div>
</template>

<script>
    export default {
        data () {
            return { modalHref: "#modal-" + this.$props.index }
            },
        props: ['mission', 'index']
    }
</script>
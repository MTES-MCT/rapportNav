<template>
    <div v-if="activite.active" class="row"
         style="align-items: center; padding: 1em;border: 2px solid var(--grey); margin-bottom: 1em;">
        <i v-bind:class="activite.logo" style="align-self: center;font-size: 2em;flex-grow: 0;"></i>
        <div class="" style="flex-grow: 1;max-width: 50%">
            <h5 style="margin: 0">{{ activite.type }}</h5>
            <div>
                <!-- TODO : change this for a count of activite.controles terre vs mer -->
<!--                <span class="label">{{ activite.terrestre ? 'Terre' : 'Mer' }}</span>-->
<!--                Todo not currently working properly-->
<!--                <span v-for="zone in activite.zones">-->
<!--                    <span class="label">{{ zone }}</span>-->
<!--                </span>-->
            </div>
        </div>
        <div style="flex-grow: 1">
            <ul v-if="undefined !== activite.controles" class="no-decoration" style="flex-grow: 1;">
                <li v-text="nombreControles + ' contrôle(s) ou action(s)'"></li>
            </ul>
            <ul v-if="'Sauvetage et assistance' === activite.type" class="no-decoration" style="flex-grow: 1;">
                <li v-text="activite.dureeSecours + ' temps de sauvetage'"></li>
            </ul>
        </div>
        <div>
            <a class="button" style="flex-grow: 0;" v-bind:href="modalHref "><i class="fas fa-pen"></i> Éditer cette
            activité</a>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {modalHref: "#modal-" + this.$props.index}
        },
        props: ['activite', 'index'],
        computed: {
            nombreControles: function() {
                return this.activite.controles.length +
                    Number(undefined === this.activite.controleSansPv ? 0 : this.activite.controleSansPv.nombreControle ) +
                    Number(undefined === this.activite.controlePlaisanceSansPv ? 0 : this.activite.controlePlaisanceSansPv.nombreControle) +
                    Number(undefined === this.activite.controleProSansPv ? 0 : this.activite.controleProSansPv.nombreControle)
                    ;
            }
        }
    }
</script>
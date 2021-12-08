<template>
  <div @change="getData" class="fr-mt-6w section" id="shipActivity">
    <h5 class="text-blue-france text-800">Activités du navire</h5>
    <div class="box-shadow-card">
      <div>
        <div class="heading-custom fr-mt-3w">
        <div class="total">
          <span>Total</span>
          <div class="total-values">
            <span class="dayInSea text-blue-france text-bold">{{ activite.nb_jours_mer }} jours en mer</span>
            <span class="missionTrackTime text-blue-france text-bold">52 heures de mission</span>
          </div>
        </div>
      </div>
        <div class="box-shadow-card-body">
          <!-- Présence à la mer -->
          <div class="presenceAtSea">
          <h6>Présence à la mer</h6>
          <div class="fr-container--fluid">
            <div class="fr-grid-row">
              <div class="fr-col-lg-4">
               <InputNumberComponent type="number" label="Nombre de jours en mer" add-on="j" v-model.number="activite.nb_jours_mer"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-3">
                <InputNumberComponent type="number" label="Navigation eff." add-on="h" v-model.number="activite.nav_eff"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-3 space-between">
                <InputNumberComponent type="number" label="Mouillage" add-on="h" v-model.number="activite.mouillage"></InputNumberComponent>
              </div>
            </div>
          </div>
        </div>

          <div class="divider-horizontal"></div>

          <!-- Présence à quai -->
          <div class="presenceAtQuai">
          <h6>Présence à quai</h6>
          <div class="fr-container--fluid">
            <div class="fr-grid-row">
              <div class="fr-col-lg-2 fr-col-md-6">
                <InputNumberComponent label="Maintenance" add-on="h" type="number" v-model.number="activite.maintenance"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-2 fr-col-md6 space-between">
                <InputNumberComponent label="Météo" add-on="h" type="number" v-model.number="activite.meteo"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-2 fr-col-md-6 space-between">
                <InputNumberComponent label="Représentation" add-on="h" type="number" v-model.number="activite.representation"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-2 fr-col-md-6 space-between">
                <InputNumberComponent label="Administratif" add-on="h" type="number" v-model.number="activite.administratif"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-2 fr-col-md-6 space-between">
                <InputNumberComponent label="Autre" add-on="h" type="number" v-model.number="activite.autre"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-2 fr-col-md-6">
                <InputNumberComponent label="Contr. Port" add-on="h" type="number" v-model.number="activite.contr_port"></InputNumberComponent>
              </div>
            </div>
          </div>
        </div>

          <div class="divider-horizontal"></div>

          <!-- Indisponibilité -->
          <div class="unavailability">
          <h6>Indisponibilité</h6>
          <div class="fr-container--fluid">
            <div class="fr-grid-row">
              <div class="fr-col-lg-3 fr-col-md-4 fr-mr-2w">
                <InputNumberComponent label="Technique" type="number" add-on="h" v-model.number="activite.technique"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-3 fr-col-md-4">
                <InputNumberComponent label="Personnel" type="number" add-on="h" v-model.number="activite.personnel"></InputNumberComponent>
              </div>
            </div>
          </div>
        </div>

          <div class="divider-horizontal"></div>

          <!-- Distance et consommation -->
          <div class="distanceAndConso">
          <h6>Distance et consommation</h6>
          <div class="fr-container--fluid">
            <div class="fr-grid-row">
              <div class="fr-col-lg-3 fr-col-md-4">
                <InputNumberComponent add-on="miles" type="number" label="Distance parcourue" v-model.number="activite.distance"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-3 fr-col-md-4">
                <InputNumberComponent label="GO marine consommé" type="number" add-on="litres" v-model.number="activite.go_marine"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-3 fr-col-md-4">
                <InputNumberComponent add-on="litres" type="number" label="Essence consommée" v-model.number="activite.essence"></InputNumberComponent>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</template>

<script>
import InputNumberComponent from "../input/InputNumberComponent";
export default {
  name: "ShipActivityCardComponent",
  components: {
    InputNumberComponent
  },
  props: {
    nb_jours_mer: {
      type: Number,
      default: () => {return 10}
    },
    nav_eff: Number,
    mouillage: Number,
    maintenance: Number,
    meteo: Number,
    representation: Number,
    administratif: Number,
    autre: Number,
    contr_port: Number,
    technique: Number,
    personnel: {
      type: Number,
      default: () => { return 0 }
    },
    distance: Number,
    go_marine: Number,
    essence: Number
  },
  methods: {
    getData() {
      this.$emit('get-activite', this.activite);
    }
  },
  data () {
    return {
        activite: {
          nb_jours_mer: this.nb_jours_mer,
          nav_eff: this.nav_eff,
          mouillage: this.mouillage,
          maintenance: this.maintenance,
          meteo: this.meteo,
          representation: this.representation,
          administratif: this.administratif,
          autre: this.autre,
          contr_port: this.contr_port,
          technique: this.technique,
          personnel: this.personnel,
          distance: this.distance,
          go_marine: this.go_marine,
          essence: this.essence,
        }
    }
  }
}
</script>

<style scoped>

</style>
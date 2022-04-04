<template>
  <div @change="getData" class="fr-mt-6w section" id="shipActivity">
    <div class="card-header">
      <h5 class="text-blue-france text-800">Activités du navire</h5>
      <div class="total">
        <span>Total</span>
        <div class="total-values">
          <span class="dayInSea text-blue-france text-bold">{{ activite.nb_jours_mer || 0 }} jours en mer</span>
          <span class="missionTrackTime text-blue-france text-bold">{{ total }} heures de mission</span>
        </div>
      </div>
    </div>
    <div class="box-shadow-card">
      <div>
        <div class="heading-custom fr-mt-3w">

      </div>
        <div class="box-shadow-card-body">
          <!-- Présence à la mer -->
          <div class="presenceAtSea">
          <h6>Présence à la mer</h6>
          <div class="fr-container--fluid">
            <div class="fr-grid-row">
              <div class="fr-col-lg-3">
               <InputNumberComponent
                   label="Nombre de jours en mer" add-on="j" v-model.number="activite.nb_jours_mer"
                   :error="hasError('nb_jours_mer')" id="nb_jours_mer"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-2">
                <InputNumberComponent
                    label="Navigation eff." add-on="h" v-model.number="activite.nav_eff"
                    :error="hasError('nav_eff')" id="nav_eff"></InputNumberComponent>

              </div>
              <div class="fr-col-lg-2 ">
                <InputNumberComponent
                    label="Mouillage" add-on="h" v-model.number="activite.mouillage"
                    :error="hasError('mouillage')" id="mouillage"></InputNumberComponent>

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
                <InputNumberComponent
                    label="Maintenance" add-on="h"  v-model.number="activite.maintenance"
                    :error="hasError('maintenance')" id="maintenance"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-2 fr-col-md6 ">
                <InputNumberComponent
                    label="Météo" add-on="h"  v-model.number="activite.meteo"
                    :error="hasError('meteo')" id="meteo"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-2 fr-col-md-6 ">
                <InputNumberComponent
                    label="Représentation" add-on="h"  v-model.number="activite.representation"
                    :error="hasError('representation')" id="representation"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-2 fr-col-md-6 ">
                <InputNumberComponent
                    label="Administratif" add-on="h"  v-model.number="activite.administratif"
                    :error="hasError('administratif')" id="administratif"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-2 fr-col-md-6 ">
                <InputNumberComponent
                    label="Autre" add-on="h"  v-model.number="activite.autre"
                    :error="hasError('autre')" id="autre"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-2 fr-col-md-6">
                <InputNumberComponent
                    label="Contr. Port" add-on="h"  v-model.number="activite.contr_port"
                    :error="hasError('contr_port')" id="contr_port"></InputNumberComponent>
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
              <div class="fr-col-lg-3 fr-col-md-4">
                <InputNumberComponent
                    label="Technique"  add-on="h" v-model.number="activite.technique"
                    :error="hasError('technique')" id="technique"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-3 fr-col-md-4">
                <InputNumberComponent
                    label="Personnel"  add-on="h" v-model.number="activite.personnel"
                    :error="hasError('personnel')" id="personnel"></InputNumberComponent>
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
                <InputNumberComponent
                    add-on="miles"  label="Distance parcourue" v-model.number="activite.distance"
                    :error="hasError('distance')" id="distance"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-3 fr-col-md-4">
                <InputNumberComponent
                    label="GO marine consommé"  add-on="litres" v-model.number="activite.go_marine"
                    :error="hasError('go_marine')" id="go_marine"></InputNumberComponent>
              </div>
              <div class="fr-col-lg-3 fr-col-md-4">
                <InputNumberComponent
                    add-on="litres"  label="Essence consommée" v-model.number="activite.essence"
                    :error="hasError('essence')" id="essence"></InputNumberComponent>
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
      default: () => { return 0 }
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
    personnel: Number,
    distance: Number,
    go_marine: Number,
    essence: Number
  },
  mounted() {
    this.calculTotal();
  },
  methods: {
    getData() {
      this.calculTotal();
      this.$emit('get-activite', this.activite);
    },
    checkForm() {
      this.errors = [];
      this.addError(this.activite.nb_jours_mer, 'nb_jours_mer');
      this.addError(this.activite.nav_eff, 'nav_eff');
      this.addError(this.activite.mouillage, 'mouillage');
      this.addError(this.activite.maintenance, 'maintenance');
      this.addError(this.activite.meteo, 'meteo');
      this.addError(this.activite.representation, 'representation');
      this.addError(this.activite.administratif, 'administratif');
      this.addError(this.activite.autre, 'autre');
      this.addError(this.activite.technique, 'technique');
      this.addError(this.activite.personnel, 'personnel');
      this.addError(this.activite.distance, 'distance');
      this.addError(this.activite.go_marine, 'go_marine');
      this.addError(this.activite.essence, 'essence');
      this.addError(this.activite.contr_port, 'contr_port');
      return this.errors;
    },
    addError(element, offset) {
      if(element === null) {
        this.errors.push(offset)
      }
    },
    hasError(value) {
      return this.errors.includes(value)
    },
    calculTotal() {
      this.total =
          this.activite.representation +
          this.activite.maintenance +
          this.activite.meteo +
          this.activite.personnel +
          this.activite.contr_port +
          this.activite.administratif +
          this.activite.technique +
          this.activite.autre +
          this.activite.mouillage +
          this.activite.nav_eff
      ;
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
        },
      total: 0,
      errors: []
    }
  }
}
</script>

<style scoped>

</style>

<template>
  <div id="shipActivity">
    <div class="heading-custom fr-mt-3w">
      <div class="total">
        <span>Total</span>
        <div class="total-values">
          <span class="dayInSea text-blue-france text-bold">{{nbJoursMer}} jours en mer</span>
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
             <InputComponent type="number" label="Nombre de jours en mer" add-on="j" v-model="nbJoursMer"></InputComponent>
            </div>
            <div class="fr-col-lg-3">
              <InputComponent type="number" label="Navigation eff." add-on="h" v-model="navEff"></InputComponent>
            </div>
            <div class="fr-col-lg-3 space-between">
              <InputComponent type="number" label="Mouillage" add-on="h" v-model="mouillage"></InputComponent>
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
              <InputComponent label="Maintenance" add-on="h" type="number" v-model="maintenance"></InputComponent>
            </div>
            <div class="fr-col-lg-2 fr-col-md6 space-between">
              <InputComponent label="Météo" add-on="h" type="number" v-model="meteo"></InputComponent>
            </div>
            <div class="fr-col-lg-2 fr-col-md-6 space-between">
              <InputComponent label="Représentation" add-on="h" type="number" v-model="representation"></InputComponent>
            </div>
            <div class="fr-col-lg-2 fr-col-md-6 space-between">
              <InputComponent label="Administratif" add-on="h" type="number" v-model="administratif"></InputComponent>
            </div>
            <div class="fr-col-lg-2 fr-col-md-6 space-between">
              <InputComponent label="Autre" add-on="h" type="number" v-model="autre"></InputComponent>
            </div>
            <div class="fr-col-lg-2 fr-col-md-6">
              <InputComponent label="Contr. Port" add-on="h" type="number" v-model="contrPort"></InputComponent>
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
              <InputComponent label="Technique" type="number" add-on="h" v-model="technique"></InputComponent>
            </div>
            <div class="fr-col-lg-3 fr-col-md-4">
              <InputComponent label="Personnel" type="number" add-on="h" v-model="personnel"></InputComponent>
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
              <InputComponent add-on="miles" type="number" label="Distance parcourue" v-model="distanceParcourue"></InputComponent>
            </div>
            <div class="fr-col-lg-3 fr-col-md-4">
              <InputComponent label="GO marine consommé" type="number" add-on="litres" v-model="goMarine"></InputComponent>
            </div>
            <div class="fr-col-lg-3 fr-col-md-4">
              <InputComponent add-on="litres" type="number" label="Essence consommée" v-model="essence"></InputComponent>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import InputComponent from "../input/InputComponent";
export default {
  name: "ShipActivityCardComponent",
  components: {
    InputComponent
  },
  methods: {},
  data () {
    return {
      nbJoursMer: null,
      navEff: null,
      mouillage: null,
      maintenance: null,
      meteo: null,
      representation: null,
      administratif: null,
      autre: null,
      contrPort: null,
      technique: null,
      personnel: null,
      distanceParcourue: null,
      goMarine: null,
      essence: null
    }
  }
}
</script>

<style scoped>

</style>
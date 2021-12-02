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
             <InputNumberComponent type="number" label="Nombre de jours en mer" add-on="j" v-model="nbJoursMer"></InputNumberComponent>
            </div>
            <div class="fr-col-lg-3">
              <InputNumberComponent type="number" label="Navigation eff." add-on="h" v-model="navEff"></InputNumberComponent>
            </div>
            <div class="fr-col-lg-3 space-between">
              <InputNumberComponent type="number" label="Mouillage" add-on="h" v-model="mouillage"></InputNumberComponent>
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
              <InputNumberComponent label="Maintenance" add-on="h" type="number" v-model="maintenance"></InputNumberComponent>
            </div>
            <div class="fr-col-lg-2 fr-col-md6 space-between">
              <InputNumberComponent label="Météo" add-on="h" type="number" v-model="meteo"></InputNumberComponent>
            </div>
            <div class="fr-col-lg-2 fr-col-md-6 space-between">
              <InputNumberComponent label="Représentation" add-on="h" type="number" v-model="representation"></InputNumberComponent>
            </div>
            <div class="fr-col-lg-2 fr-col-md-6 space-between">
              <InputNumberComponent label="Administratif" add-on="h" type="number" v-model="administratif"></InputNumberComponent>
            </div>
            <div class="fr-col-lg-2 fr-col-md-6 space-between">
              <InputNumberComponent label="Autre" add-on="h" type="number" v-model="autre"></InputNumberComponent>
            </div>
            <div class="fr-col-lg-2 fr-col-md-6">
              <InputNumberComponent label="Contr. Port" add-on="h" type="number" v-model="contrPort"></InputNumberComponent>
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
              <InputNumberComponent label="Technique" type="number" add-on="h" v-model="technique"></InputNumberComponent>
            </div>
            <div class="fr-col-lg-3 fr-col-md-4">
              <InputNumberComponent label="Personnel" type="number" add-on="h" v-model="personnel"></InputNumberComponent>
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
              <InputNumberComponent add-on="miles" type="number" label="Distance parcourue" v-model="distanceParcourue"></InputNumberComponent>
            </div>
            <div class="fr-col-lg-3 fr-col-md-4">
              <InputNumberComponent label="GO marine consommé" type="number" add-on="litres" v-model="goMarine"></InputNumberComponent>
            </div>
            <div class="fr-col-lg-3 fr-col-md-4">
              <InputNumberComponent add-on="litres" type="number" label="Essence consommée" v-model="essence"></InputNumberComponent>
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
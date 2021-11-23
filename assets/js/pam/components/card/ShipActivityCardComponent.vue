<template>
  <div>
    <div class="heading-custom fr-mt-3w">
      <div class="total">
        <span>Total</span>
        <div class="total-values">
          <span class="dayInSea text-blue-france text-bold">10 jours en mer</span>
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
            <div class="fr-col-lg-4 space-between">
              <label class="fr-label" for="dayAtSeaInput">Nombre de jour en mer</label>
              <input class="fr-input unit-placeholder fr-input-valid" value="10" type="number" id="dayAtSeaInput" name="text-input-number" placeholder="j">
            </div>
            <div class="fr-col-lg-3 space-between">
              <label class="fr-label" for="navEff">Navigation eff.</label>
              <input class="fr-input unit-placeholder fr-input-valid" type="number" value="99" id="navEff" name="text-input-number" placeholder="h">
            </div>
            <div class="fr-col-lg-3 space-between">
              <label class="fr-label" for="mouillage">Mouillage</label>
              <input class="fr-input unit-placeholder" type="number" id="mouillage" name="text-input-number" placeholder="h">
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
            <div class="fr-col-lg-2 fr-col-md-6 space-between">
              <label class="fr-label" for="dayAtSeaInput">Maintenance</label>
              <input class="fr-input unit-placeholder" type="number" id="maintenance" name="text-input-number" placeholder="h">
            </div>
            <div class="fr-col-lg-2 fr-col-md6 space-between">
              <label class="fr-label" for="navEff">Météo</label>
              <input class="fr-input unit-placeholder" type="number" id="meteo" name="text-input-number" placeholder="h">
            </div>
            <div class="fr-col-lg-2 fr-col-md-6 space-between">
              <label class="fr-label" for="representation">Répresentation</label>
              <input class="fr-input unit-placeholder" type="number" id="representation" name="text-input-number" placeholder="h">
            </div>
            <div class="fr-col-lg-2 fr-col-md-6 space-between">
              <label class="fr-label" for="administration">Administration</label>
              <input class="fr-input unit-placeholder" type="number" id="administration" name="text-input-number" placeholder="h">
            </div>
            <div class="fr-col-lg-2 fr-col-md-6 space-between">
              <label class="fr-label" for="autre">Autre</label>
              <input class="fr-input unit-placeholder" type="number" id="autre" name="text-input-number" placeholder="h">
            </div>
            <div class="fr-col-lg-2 fr-col-md-6">
              <label class="fr-label" for="contrPort">Contr. Port</label>
              <input class="fr-input unit-placeholder" type="number" id="contrPort" name="text-input-number" placeholder="h">
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
            <div class="fr-col-lg-3 fr-mr-2w">
              <label class="fr-label" for="technique">Technique</label>
              <input class="fr-input unit-placeholder" type="number" id="technique" name="text-input-number" placeholder="h">
            </div>
            <div class="fr-col-lg-3">
              <label class="fr-label" for="personnel">Personnel</label>
              <input class="fr-input unit-placeholder" type="number" id="personnel" name="text-input-number" placeholder="h">
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
            <div class="fr-col-lg-3 space-between">
              <label class="fr-label" for="traveled">Distance parcourue</label>
              <input class="fr-input unit-placeholder" type="number" id="traveled" name="text-input-number" placeholder="miles">
            </div>
            <div class="fr-col-lg-3 space-between">
              <label class="fr-label" for="goConso">GO marine consommé</label>
              <input class="fr-input unit-placeholder" type="number" id="goConso" name="text-input-number" placeholder="litres">
            </div>
            <div class="fr-col-lg-3 space-between">
              <label class="fr-label" for="essenceConso">Essence consommée</label>
              <input class="fr-input unit-placeholder" type="number" id="essenceConso" name="text-input-number" placeholder="litres">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ShipActivityCardComponent"
}
</script>

<style scoped>

</style>
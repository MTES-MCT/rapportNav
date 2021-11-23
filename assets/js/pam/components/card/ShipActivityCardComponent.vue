<template>
  <div>
    <div class="heading-custom fr-mt-3w">
      <h5 class="text-blue-france text-800 ">Activité du navire</h5>
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
            <div class="fr-col-4 fr-mr-2w">
              <label class="fr-label" for="dayAtSeaInput">Nombre de jour en mer</label>
              <input class="fr-input unit-placeholder fr-input-valid" value="10" type="text" id="dayAtSeaInput" name="text-input-text" placeholder="j">
            </div>
            <div class="fr-col-2 fr-mr-2w">
              <label class="fr-label" for="navEff">Navigation eff.</label>
              <input class="fr-input unit-placeholder fr-input-valid" type="text" value="99" id="navEff" name="text-input-text" placeholder="h">
            </div>
            <div class="fr-col-2">
              <label class="fr-label" for="mouillage">Mouillage</label>
              <input class="fr-input unit-placeholder" type="text" id="mouillage" name="text-input-text" placeholder="h">
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
            <div class="fr-col input-group-100 fr-mr-1w">
              <label class="fr-label" for="dayAtSeaInput">Maintenance</label>
              <input class="fr-input unit-placeholder" type="text" id="maintenance" name="text-input-text" placeholder="h">
            </div>
            <div class="fr-col fr-mr-1w">
              <label class="fr-label" for="navEff">Météo</label>
              <input class="fr-input unit-placeholder" type="text" id="meteo" name="text-input-text" placeholder="h">
            </div>
            <div class="fr-col fr-mr-1w">
              <label class="fr-label" for="representation">Répresentation</label>
              <input class="fr-input unit-placeholder" type="text" id="representation" name="text-input-text" placeholder="h">
            </div>
            <div class="fr-col fr-mr-1w">
              <label class="fr-label" for="administration">Administration</label>
              <input class="fr-input unit-placeholder" type="text" id="administration" name="text-input-text" placeholder="h">
            </div>
            <div class="fr-col fr-mr-1w">
              <label class="fr-label" for="autre">Autre</label>
              <input class="fr-input unit-placeholder" type="text" id="autre" name="text-input-text" placeholder="h">
            </div>
            <div class="fr-col">
              <label class="fr-label" for="contrPort">Contr. Port</label>
              <input class="fr-input unit-placeholder" type="text" id="contrPort" name="text-input-text" placeholder="h">
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
            <div class="fr-col-2 fr-mr-2w">
              <label class="fr-label" for="technique">Technique</label>
              <input class="fr-input unit-placeholder" type="text" id="technique" name="text-input-text" placeholder="h">
            </div>
            <div class="fr-col-2">
              <label class="fr-label" for="personnel">Personnel</label>
              <input class="fr-input unit-placeholder" type="text" id="personnel" name="text-input-text" placeholder="h">
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
            <div class="fr-col-3 fr-mr-2w">
              <label class="fr-label" for="traveled">Distance parcourue</label>
              <input class="fr-input unit-placeholder" type="text" id="traveled" name="text-input-text" placeholder="miles">
            </div>
            <div class="fr-col-3 fr-mr-2w">
              <label class="fr-label" for="goConso">GO marine consommé</label>
              <input class="fr-input unit-placeholder" type="text" id="goConso" name="text-input-text" placeholder="litres">
            </div>
            <div class="fr-col-3">
              <label class="fr-label" for="essenceConso">Essence consommée</label>
              <input class="fr-input unit-placeholder" type="text" id="essenceConso" name="text-input-text" placeholder="litres">
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
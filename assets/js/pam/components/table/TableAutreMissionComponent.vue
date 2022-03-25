<template>
  <div class="table-custom" @keyup="getData">
    <table class="table-controle" :id="id" aria-label="autres-missions">
      <thead class="thead-controle">
        <th></th>
        <th :class="'th-table-controle-' + categoryControleId">Nombre d'opérations</th>
        <th :class="'th-table-controle-' + categoryControleId">Durée (en heures)</th>
        <th :class="'th-table-controle-' + categoryControleId">Nombre de navires interrogés</th>
      </thead>

      <tbody :class="'tbody-controle tbody-controle-' + id" >
        <tr>
          <th scope="row" class="th-row-autre-mission td-pavillon">Assistance et sauvetage</th>
          <TdEditable :value="entity.nbAssistanceSauvetage" v-model="entity.nbAssistanceSauvetage"/>
          <TdEditable :value="entity.dureeAssistanceSauvetage" v-model="entity.dureeAssistanceSauvetage"/>
        </tr>

        <tr>
          <th scope="row" class="th-row-autre-mission td-pavillon">Manifestations nautiques</th>
          <TdEditable :value="entity.nbManifestationsNautiques" v-model="entity.nbManifestationsNautiques"/>
          <TdEditable :value="entity.dureeManifestationsNautiques" v-model="entity.dureeManifestationsNautiques"/>
        </tr>

        <tr>
          <th scope="row" class="th-row-autre-mission td-pavillon">Lutte anti poluttion</th>
          <TdEditable :value="entity.nbLuttePollution" v-model="entity.nbLuttePollution"/>
          <TdEditable :value="entity.dureeLuttePollution" v-model="entity.dureeLuttePollution"/>
        </tr>
        <tr>
          <th scope="row" class="th-row-autre-mission td-pavillon">Opérations de surveillance du trafic</th>
          <TdEditable :value="entity.nbOperationsSurveillanceTrafic" v-model="entity.nbOperationsSurveillanceTrafic"/>
          <TdEditable :value="entity.dureeOperationsSurveillanceTrafic" v-model="entity.dureeOperationsSurveillanceTrafic"/>
          <TdEditable :value="entity.nbNaviresOperationsSurveillanceTrafic" v-model="entity.nbNaviresOperationsSurveillanceTrafic"/>
        </tr>

        <tr>
          <th scope="row" class="th-row-autre-mission td-pavillon">Permanence Vigimer</th>
          <TdEditable :value="entity.nbPermanenceVigimer" v-model="entity.nbPermanenceVigimer"/>
          <TdEditable :value="entity.dureePermanenceVigimer" v-model="entity.dureePermanenceVigimer"/>
          <TdEditable :value="entity.nbNaviresPermanenceVigimer" v-model="entity.nbNaviresPermanenceVigimer"/>
        </tr>

        <tr>
          <th scope="row" class="th-row-autre-mission td-pavillon">Permanence BAAEM</th>
          <TdEditable :value="entity.nbPermanenceBAAEM" v-model="entity.nbPermanenceBAAEM"/>
          <TdEditable :value="entity.dureePermanenceBAAEM" v-model="entity.dureePermanenceBAAEM"/>
          <TdEditable :value="entity.nbNaviresPermanenceBAAEM" v-model="entity.nbNaviresPermanenceBAAEM"/>
        </tr>
      </tbody>
      <tfoot>
      <tr>

      </tr>
      </tfoot>
    </table>
  </div>
</template>

<script>
import TdEditable from "./TdEditable";
export default {
  name: "TableAutreMissionComponent",
  components: {
      TdEditable
  },
  props: {
    categoryControleId: Number,
    id: String,
    entity: Object
  },
  methods: {
    getData() {
      this.$emit('get-autres-missions', this.entity)
    },
  }
}
</script>

<style scoped>

</style>

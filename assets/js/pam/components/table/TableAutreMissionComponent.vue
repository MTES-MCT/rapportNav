<template>
  <div class="table-custom" @keyup="getData">
    <table class="table-controle" :id="id">
      <thead class="thead-controle">
        <th></th>
        <th :class="'th-table-controle-' + categoryControleId">Nombre d'opérations</th>
        <th :class="'th-table-controle-' + categoryControleId">Durée (en heures)</th>
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
          <TdEditable :value="entity.dureeManifestionsNautiques" v-model="entity.dureeManifestionsNautiques"/>
        </tr>

        <tr>
          <th scope="row" class="th-row-autre-mission td-pavillon">Lutte anti poluttion</th>
          <TdEditable :value="entity.nbLuttePollution" v-model="entity.nbLuttePollution"/>
          <TdEditable :value="entity.dureeLuttePollution" v-model="entity.dureeLuttePollution"/>
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
  mounted() {
    if(this.entity) {
      this.model.nbAssistanceSauvetage = this.entity.nbAssistanceSauvetage;
      this.model.dureeAssistanceSauvetage = this.entity.dureeAssistanceSauvetage;
      this.model.nbManifestationsNautiques = this.entity.nbManifestationsNautiques;
      this.model.dureeManifestionsNautiques = this.entity.dureeManifestionsNautiques;
      this.model.nbLuttePollution = this.entity.nbLuttePollution;
      this.model.dureeLuttePollution = this.entity.dureeLuttePollution;
    }
    this.entity = this.model;
  },
  methods: {
    getData() {
      this.$emit('get-autres-missions', this.model)
    },
  },
  data() {
    return {
      model: {
        nbAssistanceSauvetage: 0,
        dureeAssistanceSauvetage: 0,
        nbManifestationsNautiques: 0,
        dureeManifestionsNautiques: 0,
        nbLuttePollution: 0,
        dureeLuttePollution: 0
      }
    }
  }
}
</script>

<style scoped>

</style>

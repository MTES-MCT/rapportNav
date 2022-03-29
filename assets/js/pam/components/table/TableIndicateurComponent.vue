<template>
  <div class="table-custom">
    <table class="table-indicateur">
      <thead class="thead-indicateur">
      <th class="th-indicateur" scope="col">Missions</th>
      <th class="th-indicateur" scope="col">Principale</th>
      <th class="th-indicateur" scope="col">Secondaire</th>
      <th class="total-column th-indicateur" scope="col">Total</th>
      <th class="th-indicateur" scope="col">Observations</th>
      </thead>

      <tbody v-if="category !== 4">
        <tr class="tr-indicateur" v-for="(mission, index) in types">
          <th class="th-tr-indicateur" scope="row" >{{ mission.category.nom }}</th>
          <TdEditableIndicateur :value="mission.principale" @change="setValue(mission, $event, 'principale', index)" />
          <TdEditableIndicateur :value="mission.secondaire" @change="setValue(mission, $event, 'secondaire', index)" />
          <TdEditableIndicateur :value="mission.total" is-total-cell />
          <TdEditableIndicateur v-model="mission.observations" observation />
        </tr>
      </tbody>
      <tbody v-else>
        <tr v-for="(mission, index) in types" :key="mission.category.id" v-if="mission.category.id === 13">
          <th class="th-tr-indicateur-grouped th-tr-indicateur" scope="row">{{ mission.category.nom }}</th>
          <TdEditableIndicateur :value="mission.principale" @change="setValue(mission, $event, 'principale', index)" />
          <TdEditableIndicateur :value="mission.secondaire" @change="setValue(mission, $event, 'secondaire', index)" />
          <TdEditableIndicateur :value="mission.total" is-total-cell />
          <TdEditableIndicateur v-model="mission.observations" observation />
        </tr>

        <tr v-else-if="mission.category.id === 14 || mission.category.id === 15">
          <th class="th-tr-indicateur-grouped th-tr-indicateur-child" scope="row">... {{ mission.category.nom }}</th>
          <TdEditableIndicateur :value="mission.principale" @change="setValue(mission, $event, 'principale', index)" is-indicateur-child />
          <TdEditableIndicateur :value="mission.secondaire" @change="setValue(mission, $event, 'secondaire', index)" is-indicateur-child />
          <TdEditableIndicateur :value="mission.total" is-total-cell />
          <TdEditableIndicateur v-model="mission.observations" observation is-indicateur-child />
        </tr>

        <tr v-else>
          <th class="th-tr-indicateur-grouped th-tr-indicateur" scope="row">{{ mission.category.nom }}</th>
          <TdEditableIndicateur :value="mission.principale" @change="setValue(mission, $event, 'principale', index)" />
          <TdEditableIndicateur :value="mission.secondaire" @change="setValue(mission, $event, 'secondaire', index)" />
          <TdEditableIndicateur :value="mission.total" is-total-cell />
          <TdEditableIndicateur v-model="mission.observations" observation />
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import TdEditable from "./TdEditable";
import TdEditableIndicateur from "./TdEditableIndicateur";
export default {
  name: "TableIndicateurComponent",
  components: {TdEditableIndicateur, TdEditable},
  props: {
    id : {
      type: Number,
      default: null
    },
    category: {
      type: Number,
      default: null
    },
    types: {
      type: Array,
      default: null
    }
  },
  methods: {
    hiddenToggle(className, scope) {
      let tooltip = $('.' + className + '[data-scope="' + scope + '"]');
      tooltip.toggleClass('d-none');
    },
    displayMessage(e, scope) {
      let messageBox = $('.hint-text-automatic-calculate[data-scope="' + scope + '"]');
      messageBox.toggleClass('d-none')
    },
    setValue(mission, value, scope, index) {
      if(scope === 'principale') {
        mission.principale = value;
      } else {
        mission.secondaire = value;
      }
      this.types[index].total = mission.principale + mission.secondaire;

    }
  },
  data() {
    return {
    }
  }
}
</script>

<style scoped>

</style>

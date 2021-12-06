<template>
  <div class="table-custom ">
    <table class="table-indicateur">
      <thead class="thead-indicateur">
      <th class="th-indicateur" scope="col">Missions</th>
      <th class="th-indicateur" scope="col">Principale</th>
      <th class="th-indicateur" scope="col">Secondaire</th>
      <th class="total-column th-indicateur" scope="col">Total</th>
      <th class="th-indicateur" scope="col">Observations</th>
      </thead>

      <tbody>
      <tr class="tr-indicateur" v-for="(mission, index) in types">
        <th class="td-nb-hour-sea td-indicateur th-tr-indicateur" scope="row" >
          {{ mission.type }}
        </th>
        <TdEditable class-list="td-indicateur" v-model="mission.principale"></TdEditable>
        <TdEditable class-list="td-indicateur" v-model="mission.secondaire"></TdEditable>
        <TdEditable class-list="td-indicateur td-total" v-model="mission.total"></TdEditable>
        <TdEditable v-model="mission.observations" observation></TdEditable>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import TdEditable from "./TdEditable";
export default {
  name: "TableIndicateurComponent",
  components: {TdEditable},
  props: {
    id : {
      type: Number,
      default: null
    },
    type: {
      type: Number,
      default: null
    },
    cols: {
      type: Array,
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
    }
  },
  data() {
    return {
    }
  },
  beforeMount() {

   this.cols.forEach((col) => {
     const mission = {
       type: col,
       principale: null,
       secondaire: null,
       total: null,
       observations: null
     };
     this.types.push(mission)
   })
  }
}
</script>

<style scoped>

</style>
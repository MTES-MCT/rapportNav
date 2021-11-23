<template>
  <div>
    <h5 class="text-blue-france text-800">{{ title }}</h5>
    <div :class="'box-shadow-card ' + className">
      <ShipActivityCardComponent v-if="type === 'shipActivity'"></ShipActivityCardComponent>
      <GeneralInformationCardComponent v-if="type === 'informationGeneral'"></GeneralInformationCardComponent>
    </div>
  </div>
</template>

<script>
import ShipActivityCardComponent from "./ShipActivityCardComponent";
import GeneralInformationCardComponent from "./GeneralInformationCardComponent";
export default {
  name: "BoxShadowCardComponent",
  components: {
    ShipActivityCardComponent,
    GeneralInformationCardComponent
  },
  props: {
    className: {
      type: String,
      default: null
    },
    type: {
      type: String,
      default: null
    },
    title: {
      type: String,
      default: null
    }
  }
}
</script>

<style scoped>

</style>
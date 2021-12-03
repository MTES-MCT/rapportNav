<template>
  <div @change="getData">
    <h5 class="text-blue-france text-800">{{ title }}</h5>
    <div :class="'box-shadow-card ' + className">
      <ShipActivityCardComponent v-if="type === 'shipActivity'" v-model="data"></ShipActivityCardComponent>
      <GeneralInformationCardComponent v-if="type === 'informationGeneral'" v-model="data"></GeneralInformationCardComponent>
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
  },
  methods: {
    getData() {
      this.$emit('input', this.data);
    }
  },
  data() {
    return {
      data: null
    }
  }
}
</script>

<style scoped>

</style>
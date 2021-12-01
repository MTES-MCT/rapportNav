<template>
  <div :class="className + ' fr-mt-10w'" :id="identifier">
    <div class="heading-custom heading-custom-space-between">
      <h5 class="text-blue-france text-800">{{ title }}</h5>
      <button class="fr-btn fr-btn--secondary" data-fr-opened="false" aria-controls="fr-modal-10" v-if="type === 'controle'">
        <i class="ri-add-circle-fill fr-mt-1v fr-mr-1w"></i> <span class="text-bold">Ajouter un contrôle</span>
      </button>
    </div>

    <RapportAccordionComponent
        title="Contrôle en mer des navires de pêche professionnelle"
        type="controle"
        identifier="controle"
        remove-btn
    >
    </RapportAccordionComponent>

  </div>
</template>

<script>
import RapportAccordionComponent from "./RapportAccordionComponent";
import ModalAddControle from "../ModalAddControle";
export default {
  name: "AccordionGroupComponent",
  components: {
    RapportAccordionComponent,
    ModalAddControle
  },
  props: {
    title: {
      type: String,
      default: null
    },
    className: {
      type: String,
      default: null
    },
    type: {
      type: String,
      default: null
    },
    identifier: {
      type: String,
      default: null
    }
  },
  methods: {

  },
  data: function() {
    return {
      id: this._uid,
      controles: []
    }
  }
}
</script>

<style scoped>

</style>
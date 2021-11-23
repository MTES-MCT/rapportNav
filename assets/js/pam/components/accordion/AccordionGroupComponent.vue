<template>
  <div :class="className + ' fr-mt-10w'">
    <div class="heading-custom heading-custom-space-between">
      <h5 class="text-blue-france text-800">{{ title }}</h5>
      <button class="fr-btn fr-btn--secondary" data-fr-opened="false" aria-controls="fr-modal-10" v-if="type === 'controle'">
        <i class="ri-add-circle-fill fr-mt-1v fr-mr-1w"></i> <span class="text-bold">Ajouter un contrôle</span>
      </button>
    </div>

    <div class="box-dropdown fr-mt-2w">
      <ul class="fr-accordions-group" v-if="type === 'controle'">
        <li>
          <RapportAccordionComponent
              title="Contrôle en mer des navires de pêche professionnelle"
              type="controle"
              remove-btn
          >
          </RapportAccordionComponent>
        </li>
      </ul>

      <ul class="fr-accordions-group" v-if="type === 'indicateur'">
        <li>
          <RapportAccordionComponent
              title="Contrôle en mer des navires de pêche professionnelle"
              type="indicateur"
          >
          </RapportAccordionComponent>
        </li>
      </ul>
    </div>



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
    }
  },
  data: function() {
    return {
      id: this._uid
    }
  }
}
</script>

<style scoped>

</style>
<template>
  <div class="box-shadow-card">
    <section class="fr-accordion box-shadow-card-body">
      <div class="fr-accordion__title ">
        <div class="fr-container--fluid">
          <div class="fr-grid-row">
            <div class="fr-col-11">
              <button class="fr-accordion__btn fr-fi-arrow-down-s-line fr-btn--icon-left" aria-expanded="true" :aria-controls="'accordion-' + id">
                {{ title }}
              </button>
            </div>
            <div class="fr-col-1 fr-mt-2v" v-if="removeBtn === true">
              <button class="fr-fi-delete-fill btn-remove" aria-hidden="true"></button>
            </div>
          </div>
        </div>
      </div>
      <div class="fr-collapse" :id="'accordion-' + id ">


          <div class="divider-horizontal--accordion"></div>
          <TableControleComponent v-if="type === 'controle'"></TableControleComponent>
          <TableIndicateurComponent v-if="type === 'indicateur'"></TableIndicateurComponent>

      </div>
    </section>
  </div>
</template>

<script>
import TableControleComponent from "../table/TableControleComponent";
import TableIndicateurComponent from "../table/TableIndicateurComponent";
export default {
  name: "RapportAccordionComponent",
  components: { TableControleComponent, TableIndicateurComponent },
  props: {
    title: {
      type: String,
      default: null
    },
    type: {
      type: String,
      default: null
    },
    removeBtn: {
      type: Boolean,
      default: false
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
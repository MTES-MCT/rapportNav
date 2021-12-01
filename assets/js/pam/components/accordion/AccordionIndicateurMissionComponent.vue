<template>
  <div :class="className + ' fr-mt-10w'" :id="identifier">
    <div class="heading-custom heading-custom-space-between">
      <h5 class="text-blue-france text-800">Indicateurs de mission</h5>
      <button class="fr-btn fr-btn--secondary" data-fr-opened="false" aria-controls="fr-modal-10" v-if="type === 'controle'">
        <i class="ri-add-circle-fill fr-mt-1v fr-mr-1w"></i> <span class="text-bold">Ajouter un contrôle</span>
      </button>
    </div>
    <div class="box-dropdown fr-mt-2w">
      <ul class="fr-accordions-group">
        <li>
          <div class="box-shadow-card" :id="id">
            <section class="fr-accordion box-shadow-card-body">
              <div class="fr-accordion__title ">
                <div class="fr-container--fluid">
                  <div class="fr-grid-row">
                    <div class="fr-col-11">
                      <button class="fr-accordion__btn fr-fi-arrow-down-s-line fr-btn--icon-left" aria-expanded="true" :aria-controls="'accordion-' + id">
                        {{ title }}
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="fr-collapse" :id="'accordion-' + id ">
                <div class="divider-horizontal--accordion"></div>
                <TableIndicateurComponent :id="id"></TableIndicateurComponent>
              </div>
            </section>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import TableIndicateurComponent from "../table/TableIndicateurComponent";
export default {
  name: "AccordionIndicateurMissionComponent",
  props: {
    title: {
      type: String,
      default: null
    }
  },
  components: {
    TableIndicateurComponent
  },
  methods: {}
}
</script>

<style scoped>

</style>
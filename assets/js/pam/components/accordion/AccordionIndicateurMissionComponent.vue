<template>
  <div class="fr-mt-2w">
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
                <TableIndicateurComponent
                    :id="id"
                    :types="indicateurs"
                ></TableIndicateurComponent>
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
    },
    type: {
      type: Number,
      default: null
    },
    indicateurs: {
      type: Array,
      default: null
    }
  },
  components: {
    TableIndicateurComponent
  },
  methods: {},
  data: function() {
    return {
      id: this._uid
    }
  }
}
</script>

<style scoped>

</style>
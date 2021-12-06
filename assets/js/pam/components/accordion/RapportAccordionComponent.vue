<template>
  <div class="operationalControl fr-mt-10w section" id="controle">
      <div class="heading-custom heading-custom-space-between">
        <h5 class="text-blue-france text-800">Contrôles opérationnel</h5>
        <button class="fr-btn fr-btn--secondary" data-fr-opened="false" aria-controls="fr-modal-10">
          <i class="ri-add-circle-fill fr-mt-1v fr-mr-1w"></i> <span class="text-bold">Ajouter un contrôle</span>
        </button>
      </div>
      <div class="box-dropdown fr-mt-2w">
        <ul class="fr-accordions-group" >
          <li v-for="(type, index) in types">
            <div class="box-shadow-card" :id="type.id">
              <section class="fr-accordion box-shadow-card-body">
                <div class="fr-accordion__title ">
                  <div class="fr-container--fluid">
                    <div class="fr-grid-row">
                      <div class="fr-col-11">
                        <button class="fr-accordion__btn fr-fi-arrow-down-s-line fr-btn--icon-left" aria-expanded="true" :aria-controls="'accordion-' + type.id">
                         {{type.title}}
                        </button>
                      </div>
                      <div class="fr-col-1 fr-mt-2v">
                        <button class="fr-fi-delete-fill btn-remove" aria-hidden="true" @click="removeType(index)"></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="fr-collapse" :id="'accordion-' + type.id ">
                  <div class="divider-horizontal--accordion"></div>
                  <TableControleComponent
                      :id="type.id"
                      :type="type"
                  >
                  </TableControleComponent>
                </div>
              </section>
            </div>
          </li>
        </ul>
        <ModalAddControle @clicked="onClickModal"></ModalAddControle>
      </div>
  </div>
</template>

<script>
import TableControleComponent from "../table/TableControleComponent";
import TableIndicateurComponent from "../table/TableIndicateurComponent";
import ModalAddControle from "../ModalAddControle";
export default {
  name: "RapportAccordionComponent",
  components: { TableControleComponent, TableIndicateurComponent, ModalAddControle },
  props: {
    types: {
      type: Array,
      default: null
    }
  },
  data: function() {
    return {
      id: this._uid,
    }
  },
  methods: {
    onClickModal(value, id) {
      let newType = {
        title: value,
        id: id,
        pavillons: [
          {
            pavillon: 'FR',
            nb_navire_controle: null,
            pv_peche_sanitaire: null,
            pv_equipement_securite: null,
            pv_titre_nav: null,
            pv_police_nav: null,
            pv_env_pollution: null,
            autre_pv: null,
            nb_nav_deroute: null,
            nb_nav_interroge: null
          }
        ]
      };
      this.types.push(newType);
    },
    removeType(index) {
      this.types.splice(index, 1);
    },
    getData() {

    }
  }
}
</script>

<style scoped>

</style>
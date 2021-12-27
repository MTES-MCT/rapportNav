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
          <li v-for="(controle, index) in controlesByType">
            <div class="box-shadow-card" :id="controle.id">
              <section class="fr-accordion box-shadow-card-body">
                <div class="fr-accordion__title ">
                  <div class="fr-container--fluid">
                    <div class="fr-grid-row">
                      <div class="fr-col-11">
                        <button class="fr-accordion__btn fr-fi-arrow-down-s-line fr-btn--icon-left" aria-expanded="true" :aria-controls="'accordion-' + controle.id">
                         {{ controle.label }}
                        </button>
                      </div>
                      <div class="fr-col-1 fr-mt-2v">
                        <button class="fr-fi-delete-fill btn-remove" aria-hidden="true" @click="removeType(index, controle)"></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="fr-collapse" :id="'accordion-' + controle.id ">
                  <div class="divider-horizontal--accordion"></div>
                  <TableControleComponent
                      :id="controle.id"
                      :pavillons="controle.pavillons"
                      @get-controles="getPav"
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
    controles: {
      type: Array,
      default: () => {
        return  []
        },
      }
  },
  mounted() {
    this.formatPavillons();
    this.displayControleMounted(this.controlesNavirePechePro);
    this.displayControleMounted(this.controlesNavirePlaisancePro);
    this.displayControleMounted(this.controlesNavirePlaisanceLoisir)
    this.displayControleMounted(this.controlesTerrePechePro);
    this.displayControleMounted(this.autresMission);
  },
  data: function() {
    return {
      id: this._uid,
      controlesNavirePechePro: {
        id: 1,
        pavillons: []
      },
      controlesNavirePlaisancePro: {
        id: 2,
        pavillons: []
      },
      controlesNavirePlaisanceLoisir: {
        id: 3,
        pavillons: []
      },
      controlesTerrePechePro: {
        id: 4,
        pavillons: []
      },
      autresMission: {
        id: 5,
        pavillons: []
      },
      controlesByType: [],
      result: []
    }
  },
  methods: {
    onClickModal(label, id) {
      let controle = {
        type: {
          id: id,
          label: label
        },
        pavillon: 'FR',
        nb_navire_controle: null,
        nb_pv_peche_sanitaire: null,
        nb_pv_equipement_securite: null,
        nb_pv_titre_nav: null,
        nb_pv_police_nav: null,
        nb_pv_env_pollution: null,
        nb_autre_pv: null,
        nb_nav_deroute: null,
        nb_nav_interroge: null
      }
      let newType = {
        id: id,
        label: label,
        pavillons: []
      }
      newType.pavillons.push(controle);
      this.controlesByType.push(newType);
    },
    getPav(datas) {
      this.result = this.controles
      datas.forEach((data, index) => {
        this.result.push(data);
      })
      this.result = this.result.filter(this.onlyUnique);
      this.$emit('get-controles', this.result)
    },
    onlyUnique(value, index, self) {
      return self.indexOf(value) === index;
    },
    removeType(index, type) {
      this.controlesByType.splice(index, 1);
      this.controles.forEach((controle, index) => {
        if(controle.category.id === type.id) {
          this.controles.splice(index, 1)
        }
      })

    },
    formatPavillons() {
      this.controles.forEach((controle, index) => {
        switch(controle.category.id) {
          case 1:
            this.controlesNavirePechePro.label = controle.category.label;
            this.controlesNavirePechePro.pavillons.push(controle);
            break;

          case 2:
            this.controlesNavirePlaisancePro.label = controle.category.label;
            this.controlesNavirePlaisancePro.pavillons.push(controle);
            break;

          case 3:
            this.controlesNavirePlaisanceLoisir.label = controle.category.label;
            this.controlesNavirePlaisanceLoisir.pavillons.push(controle);
            break;

          case 4:
            this.controlesTerrePechePro.label = controle.category.label;
            this.controlesTerrePechePro.pavillons.push(controle);
            break;

          case 5:
            this.autresMission.label = controle.category.label;
            this.autresMission.pavillons.push(controle);
            break;
        }
      })
    },
    displayControleMounted(obj) {
      if(obj.pavillons.length > 0) {
        this.controlesByType.push(obj);
      }
    }
  }
}
</script>

<style scoped>

</style>

<template>
  <div class="operationalControl fr-mt-10w section" id="controle">
      <div class="heading-custom heading-custom-space-between">
        <h5 class="text-blue-france text-800">Contrôles opérationnels</h5>
        <button class="fr-btn fr-btn--secondary btn-add-controle" data-fr-opened="false" aria-controls="fr-modal-controle">
          <i class="ri-add-circle-fill fr-mt-1v fr-mr-1w"></i> <span class="text-bold">Ajouter un contrôle</span>
        </button>
      </div>
      <div class="box-dropdown fr-mt-2w">
        <ul class="fr-accordions-group" >
          <li v-for="(controle, index) in controlesByType" :key="controle.id">
            <div class="box-shadow-card" :id="'controle_op_' + controle.id">
              <section class="fr-accordion box-shadow-card-body">
                <div class="fr-accordion__title ">
                  <div class="fr-container--fluid">
                    <div class="fr-grid-row">
                      <div class="fr-col-11">
                        <button class="fr-accordion__btn fr-fi-arrow-down-s-line fr-btn--icon-left" aria-expanded="true" :aria-controls="'accordion-' + controle.id">
                         {{ controle.nom }}
                        </button>
                      </div>
                      <div class="fr-col-1 fr-mt-2v">
                        <button data-fr-opened="false" :aria-controls="'fr-modal-' + index" class="fr-fi-delete-fill btn-remove" aria-hidden="true"></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="fr-collapse" :id="'accordion-' + controle.id ">
                  <div class="divider-horizontal--accordion"></div>
                  <TableControleComponent
                      :id="'controle_op_table_' + controle.id"
                      :controle-id="controle.id"
                      :pavillons="controle.pavillons"
                      @get-controles="getPav">
                  </TableControleComponent>
                </div>
              </section>
            </div>
            <ModalRemoveControle :index="index" @remove="removeType(index, controle)" />
          </li>
        </ul>
        <ModalAddControle @clicked="onClickModal"></ModalAddControle>
      </div>
  </div>
</template>

<script>
import TableControleComponent from "../table/TableControleComponent";
import TableIndicateurComponent from "../table/TableIndicateurComponent";
import ModalAddControle from "../modal/ModalAddControle";
import ModalRemoveControle from "../modal/ModalRemoveControle";
export default {
  name: "RapportAccordionComponent",
  components: {ModalRemoveControle, TableControleComponent, TableIndicateurComponent, ModalAddControle },
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
    this.displayControleMounted(this.controlesTerrePlaisanceLoisir);
    this.displayControleMounted(this.controlesTerrePlaisancePro);
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
      controlesTerrePlaisanceLoisir: {
        id: 6,
        pavillons: []
      },
      controlesTerrePlaisancePro: {
        id: 7,
        pavillons: []
      },
      controlesByType: [],
      result: []
    }
  },
  methods: {
    onClickModal(nom, id) {
      let controle = {
        category: {
          id: id,
          nom: nom
        },
        pavillon: 'FR',
        nb_navire_controle: 0,
        nb_pv_peche_sanitaire: 0,
        nb_pv_equipement_securite: 0,
        nb_pv_titre_nav: 0,
        nb_pv_police: 0,
        nb_pv_env_pollution: 0,
        nb_autre_pv: 0,
        nb_nav_deroute: 0,
        nb_nav_interroge: 0
      }
      let newType = {
        id: id,
        nom: nom,
        pavillons: []
      }
      newType.pavillons.push(controle);
      let alreadyExist = false;
      this.controlesByType.filter((type) => {
        alreadyExist = type.id === id;
      })
      !alreadyExist ? this.controlesByType.push(newType) : null;
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
    removeType(index, category) {
      this.controlesByType.splice(index, 1);
      this.controles.forEach((controle, index) => {
        if(controle.category.id === category.id) {
          this.controles.splice(index, 1)
        }
      })
    },
    formatPavillons() {
      this.controles.forEach((controle, index) => {
        switch(controle.category.id) {
          case 1:
            this.controlesNavirePechePro.nom = controle.category.nom;
            this.controlesNavirePechePro.pavillons.push(controle);
            break;

          case 2:
            this.controlesNavirePlaisancePro.nom = controle.category.nom;
            this.controlesNavirePlaisancePro.pavillons.push(controle);
            break;

          case 3:
            this.controlesNavirePlaisanceLoisir.nom = controle.category.nom;
            this.controlesNavirePlaisanceLoisir.pavillons.push(controle);
            break;

          case 4:
            this.controlesTerrePechePro.nom = controle.category.nom;
            this.controlesTerrePechePro.pavillons.push(controle);
            break;

          case 5:
            this.autresMission.nom = controle.category.nom;
            this.autresMission.pavillons.push(controle);
            break;
          case 6:
            this.controlesTerrePlaisanceLoisir.nom = controle.category.nom;
            this.controlesTerrePlaisanceLoisir.pavillons.push(controle);
            break;
          case 7:
            this.controlesTerrePlaisancePro.nom = controle.category.nom;
            this.controlesTerrePlaisancePro.pavillons.push(controle);
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

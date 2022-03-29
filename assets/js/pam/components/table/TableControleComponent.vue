<template>
  <div class="table-custom" @keyup="getData">
    <table class="table-controle" :id="id">
      <thead class="thead-controle">
      <th :class="'th-table-controle-' + controleId">Pavillon</th>
      <th
          :class="'th-table-controle-' + controleId"
          v-for="(col, counter) in cols"
          v-if="col.enabled === true"
      >
        {{col.title}}
      </th>
      <th class="add-column dropbtn" :id="'add-btn_' + controleId" ref="tooltip" v-if="controleId !== 5">
        <div class="add-column-label" @click="dropdownHidden = !dropdownHidden">
          <i class="ri-add-circle-fill add-icon" aria-hidden="true" />
          <span class="icon-text">Ajouter un PV, nav déroutés...</span>
        </div>
      </th>
      </thead>

      <tbody :class="'tbody-controle tbody-controle-' + id" >
      <tr class="tr-table" v-for="(pavillon, index) in pavillons">
        <td class="td-pavillon td-table-controle">
          <select name="pavillon" :id="'pavillon-select_' + id" class="fr-select fr-select-custom" v-model="pavillon.pavillon">
            <option value="FR">FR</option>
            <option value="FR-SP">FR-SP</option>
            <option value="BL">BL</option>
            <option value="NL">NL</option>
            <option value="GB">GB</option>
            <option value="Autres UE">Autres UE</option>
            <option value="Non UE">Non UE</option>
          </select>
        </td>
        <TdEditable
            id="nb_navire_controle"
            v-if="cols[0].enabled"
            v-model="pavillon.nb_navire_controle"
            :value="pavillon.nb_navire_controle"
        >
        </TdEditable>
        <TdEditable
            id="nb_controles_peche_sanitaire"
            v-if="cols[1].enabled"
            v-model="pavillon.nb_controles_peche_sanitaire"
            :value="pavillon.nb_controles_peche_sanitaire"
        >
        </TdEditable>
        <TdEditable
            id="nb_pv_peche_sanitaire"
            v-if="cols[2].enabled"
            v-model="pavillon.nb_pv_peche_sanitaire"
            :value="pavillon.nb_pv_peche_sanitaire"
        >
        </TdEditable>
        <TdEditable
            id="nb_pv_equipement_securite"
            v-if="cols[3].enabled"
            v-model="pavillon.nb_pv_equipement_securite"
            :value="pavillon.nb_pv_equipement_securite"
        >
        </TdEditable>
        <TdEditable
            id="nb_pv_titre_nav"
            v-if="cols[4].enabled"
            v-model="pavillon.nb_pv_titre_nav"
            :value="pavillon.nb_pv_titre_nav"
        >
        </TdEditable>
        <TdEditable
            id="nb_pv_titre_conduite"
            v-if="cols[5].enabled"
            v-model="pavillon.nb_pv_titre_conduite"
            :value="pavillon.nb_pv_titre_conduite"
        >
        </TdEditable>
        <TdEditable
            id="nb_pv_police"
            v-if="cols[6].enabled"
            v-model="pavillon.nb_pv_police"
            :value="pavillon.nb_pv_police"
        >
        </TdEditable>
        <TdEditable
            id="nb_pv_env_pollution"
            v-if="cols[7].enabled"
            v-model="pavillon.nb_pv_env_pollution"
            :value="pavillon.nb_pv_env_pollution"
        >
        </TdEditable>
        <TdEditable
            id="nb_autre_pv"
            v-if="cols[8].enabled"
            v-model="pavillon.nb_autre_pv"
            :value="pavillon.nb_autre_pv"
        >
        </TdEditable>
        <TdEditable
            id="nb_nav_deroute"
            v-if="cols[9].enabled"
            v-model="pavillon.nb_nav_deroute"
            :value="pavillon.nb_nav_deroute"
        >
        </TdEditable>
        <TdEditable
            id="nb_nav_deroute_env__pollution"
            v-if="cols[10].enabled"
            v-model="pavillon.nb_nav_deroute_env_pollution"
            :value="pavillon.nb_nav_deroute_env_pollution"
        >
        </TdEditable>
        <TdEditable
            id="nb_nav_interroge"
            v-if="cols[11].enabled"
            v-model="pavillon.nb_nav_interroge"
            :value="pavillon.nb_nav_interroge"
        >
        </TdEditable>
        <td class="td-add-column td-table-controle" :id="'add_column_' + id" v-if="controleId !== 5"></td>
      </tr>
      <tr class="total-control">
        <th scope="row" class="th-foot-controle">Total</th>
        <td class="td-foot-controle" v-for="(col, index) in cols" :key="index" v-if="col.enabled">
          {{ total(index) }}
        </td>
      </tr>
      </tbody>
      <tfoot>
      <tr>

      </tr>
      </tfoot>
    </table>
    <div class="add-pavillon" v-on:click="addPav($event)" :id="'ajout_pavillon_' + id" v-if="controleId !== 5" >
      <i class="ri-add-circle-fill add-icon" aria-hidden="true" />
      <span class="icon-text">Ajouter un pavillon</span>
    </div>
    <div class="dropdown" :id="'add-column_dropdown_' + controleId" v-if="!dropdownHidden" v-click-outside="hideTooltip">
      <ul id="add-column_list">
        <li id="add-column_list_ajouter_pv">
          <a href="#" class="dropdown-item" @click.prevent>Ajouter des pv</a>
          <ul id="add-column_list_ajouter_pv__list">
            <li v-for="(col, index) in cols" v-if="!col.enabled && index <= 8 && isInclude(col.controleCategoriesId)">
              <a href="#" class="dropdown-link" v-bind:data-dropdown-label="col.title"
                 @click.prevent="col.enabled = true"
                 :id="'add-column_list_ajouter_pv__item_' + index">{{ col.title }}</a>
            </li>
          </ul>
        </li>
        <li v-for="(col, index) in cols" v-if="!col.enabled && index > 8 && isInclude(col.controleCategoriesId)">
          <a href="#" class="dropdown-link" v-bind:data-dropdown-label="col.title"
             @click.prevent="col.enabled = true" :id="'add-column_list_ajouter_pv__item_' + index">{{
              col.title
            }}</a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import TdEditable from "./TdEditable";
export default {
  name: "TableControleComponent",
  components: {
    TdEditable
  },
  props: {
    id: {
      type: String,
      default: null
    },
    pavillons: {
      type: Array,
      default: null
    },
    controleId: Number
  },
  mounted() {
    this.pavillons.forEach((pavillon, index) => {
      if(this.controleId !== 5) {
        if(pavillon.nb_navire_controle) {
          this.cols[0].enabled = true
        }
        if(pavillon.nb_controles_peche_sanitaire) {
          this.cols[1].enabled = true;
        }
        if(pavillon.nb_pv_peche_sanitaire) {
          this.cols[2].enabled = true;
        }
        if(pavillon.nb_pv_equipement_securite) {
          this.cols[3].enabled = true
        }
        if(pavillon.nb_pv_titre_nav) {
          this.cols[4].enabled = true
        }
        if(pavillon.nb_pv_titre_conduite) {
          this.cols[5].enabled = true
        }
        if(pavillon.nb_pv_police) {
          this.cols[6].enabled = true
        }
        if(pavillon.nb_pv_env_pollution) {
          this.cols[7].enabled = true
        }
        if(pavillon.nb_autre_pv) {
          this.cols[8].enabled = true
        }
        if(pavillon.nb_nav_deroute) {
          this.cols[9].enabled = true
        }
        if(pavillon.nb_nav_deroute_env_pollution) {
          this.cols[10].enabled = true
        }
        if(pavillon.nb_nav_interroge) {
          this.cols[11].enabled = true
        }
      }
    })
  },
  methods: {
    isInclude(categoriesId) {
      return categoriesId.includes(this.controleId);
    },
    addPav(event) {
      const newPav = {
        category: {
          id: this.pavillons[0].category.id,
          nom: this.pavillons[0].category.nom
        },
        pavillon: 'FR',
        nb_navire_controle: 0,
        nb_pv_peche_sanitaire: 0,
        nb_controles_peche_sanitaire: 0,
        nb_pv_equipement_securite: 0,
        nb_pv_titre_conduite: 0,
        nb_pv_titre_nav: 0,
        nb_pv_police: 0,
        nb_pv_env_pollution: 0,
        nb_autre_pv: 0,
        nb_nav_deroute: 0,
        nb_nav_deroute_env_pollution: 0,
        nb_nav_interroge: 0
      };
      this.pavillons.push(newPav);
    },
    getData() {
      this.$emit('get-controles', this.pavillons)
    },
    total(index) {
      let result = 0;
      this.pavillons.forEach((el) => {
        switch(index) {
          case 0:
            result += el.nb_navire_controle;
            break;
          case 1:
            result += el.nb_controles_peche_sanitaire;
            break;
          case 2:
            result += el.nb_pv_peche_sanitaire;
            break;

          case 3:
            result += el.nb_pv_equipement_securite;
            break;

          case 4:
            result += el.nb_pv_titre_nav;
            break;
          case 5:
            result += el.nb_pv_titre_conduite;
            break;
          case 6:
            result += el.nb_pv_police;
            break;

          case 7:
            result += el.nb_pv_env_pollution;
            break;

          case 8:
            result += el.nb_autre_pv;
            break;

          case 9:
            result += el.nb_nav_deroute;
            break;

          case 10:
            result += el.nb_nav_deroute_env_pollution;
            break;

          case 11:
            result += el.nb_nav_interroge;
            break;
        }
      })
      return parseInt(result);
    },
    hideTooltip(event) {
      if(this.$refs.tooltip) {
        if(!this.$refs.tooltip.contains(event.target)) {
          this.dropdownHidden = true;
        }
      }
    }
  },
  data: function() {
    return {
      cols: [
        {
          title: 'Nb de navires controlé',
          enabled: true,
          controleCategoriesId: [
            1, 2, 3, 4, 6, 7
          ]
        },
        {
          title: 'Nb de contrôles pêche sanitaire',
          enabled: true,
          controleCategoriesId: [
              1, 2, 3, 4, 6, 7
          ]
        },
        {
          title: 'Nb de pv pêches sanitaire',
          enabled: false,
          controleCategoriesId: [
            1, 2, 3, 4, 6, 7
          ]
        },
        {
          title: 'PV équipement sécu. permis de nav.',
          enabled: false,
          controleCategoriesId: [
            1, 2, 3, 4, 6, 7
          ]
        },
        {
          title: 'PV titre de navig. role/déc. eff',
          enabled: false,
          controleCategoriesId: [
            1, 2, 4
          ]
        },
        {
          title: 'PV titre de conduite',
          enabled: false,
          controleCategoriesId: [6]
        },
        {
          title: 'PV police navigation',
          enabled: false,
          controleCategoriesId: [
            1, 2, 3
          ]
        },
        {
          title: 'PV environnement pollution',
          enabled: false,
          controleCategoriesId: [
            1, 2, 3, 4, 6, 7
          ]
        },
        {
          title: 'Autres types de PV',
          enabled: false,
          controleCategoriesId: [
            1, 2, 3, 4, 6, 7
          ]
        },
        {
          title: 'Navires dérouté (pêche)',
          enabled: false,
          controleCategoriesId: [
            1, 2, 3
          ]
        },
        {
          title: 'Navires dérouté (pollution/environnement)',
          enabled: false,
          controleCategoriesId: [
            1, 2, 3
          ]
        },
        {
          title: 'Navire interrogé',
          enabled: false,
          controleCategoriesId: [
            1, 2, 3
          ]
        }
      ],
      dropdownHidden: true
    }
  }
}
</script>

<style scoped>

</style>

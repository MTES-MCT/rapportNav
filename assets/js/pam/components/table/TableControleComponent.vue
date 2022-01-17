<template>
  <div class="table-custom" @keyup="getData">
    <table class="table-controle">
      <thead class="thead-controle">
      <th :class="'th-table-controle-' + id">Pavillon</th>
      <th
          :class="'th-table-controle-' + id"
          v-for="(col, counter) in cols"
          v-if="col.enabled === true"
      >
        {{col.title}}
      </th>
      <th class="add-column dropbtn" id="add-btn">
        <div class="add-column-label">
          <i class="ri-add-circle-fill add-icon" aria-hidden="true" />
          <span class="icon-text">Ajouter un PV, nav déroutés...</span>
        </div>

        <div class="dropdown" id="dropdown">
          <ul>
            <li>
              <a href="#" class="dropdown-item" @click.prevent>Ajouter des pv</a>
              <ul>
                <li v-for="(col, index) in cols" v-if="!col.enabled && index <= 6"><a href="#" class="dropdown-link" v-bind:data-dropdown-label="col.title" @click.prevent="col.enabled = true">{{col.title}}</a></li>
              </ul>
            </li>
            <li v-for="(col, index) in cols" v-if="!col.enabled && index > 6">
              <a href="#" class="dropdown-link" v-bind:data-dropdown-label="col.title" @click.prevent="col.enabled = true">{{ col.title }}</a>
            </li>
          </ul>
        </div>
      </th>
      </thead>

      <tbody :class="'tbody-controle-' + id">
      <tr class="tr-table" v-for="(pavillon, index) in pavillons">
        <td class="td-pavillon td-table-controle">
          <select name="pavillon" id="pavillon-select" class="fr-select fr-select-custom" v-model="pavillon.pavillon">
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
            v-if="cols[0].enabled"
            v-model="pavillon.nb_navire_controle"
            :value="pavillon.nb_navire_controle"
        >
        </TdEditable>
        <TdEditable
            v-if="cols[1].enabled || pavillon.nb_pv_peche_sanitaire > 0"
            v-model="pavillon.nb_pv_peche_sanitaire"
            :value="pavillon.nb_pv_peche_sanitaire"
        >
        </TdEditable>
        <TdEditable
            v-if="cols[2].enabled"
            v-model="pavillon.nb_pv_equipement_securite"
            :value="pavillon.nb_pv_equipement_securite"
        >
        </TdEditable>
        <TdEditable
            v-if="cols[3].enabled"
            v-model="pavillon.nb_pv_titre_nav"
            :value="pavillon.nb_pv_titre_nav"
        >
        </TdEditable>
        <TdEditable
            v-if="cols[4].enabled"
            v-model="pavillon.nb_pv_police_nav"
            :value="pavillon.nb_pv_police_nav"
        >
        </TdEditable>
        <TdEditable
            v-if="cols[5].enabled"
            v-model="pavillon.nb_pv_env_pollution"
            :value="pavillon.nb_pv_env_pollution"
        >
        </TdEditable>
        <TdEditable
            v-if="cols[6].enabled"
            v-model="pavillon.nb_autre_pv"
            :value="pavillon.nb_autre_pv"
        >
        </TdEditable>
        <TdEditable
            v-if="cols[7].enabled"
            v-model="pavillon.nb_nav_deroute"
            :value="pavillon.nb_nav_deroute"
        >
        </TdEditable>
        <TdEditable
            v-if="cols[8].enabled"
            v-model="pavillon.nb_nav_interroge"
            :value="pavillon.nb_nav_interroge"
        >
        </TdEditable>
        <td class="td-add-column td-table-controle"></td>
      </tr>
      </tbody>
      <tfoot>
      <tr>
        <th scope="row" class="th-foot-controle">Total</th>
        <td class="td-foot-controle">0</td>
      </tr>
      </tfoot>
    </table>
    <div class="add-pavillon" v-on:click="addPav($event)">
      <i class="ri-add-circle-fill add-icon" aria-hidden="true" />
      <span class="icon-text">Ajouter un pavillon</span>
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
      type: Number,
      default: null
    },
    pavillons: {
      type: Array,
      default: null
    }
  },
  mounted() {
    this.pavillons.forEach((pavillon, index) => {
      if(pavillon.nb_navire_controle) {
        this.cols[0].enabled = true
      }
      if(pavillon.nb_pv_peche_sanitaire) {
        this.cols[1].enabled = true;
      }
      if(pavillon.nb_pv_equipement_securite) {
        this.cols[2].enabled = true
      }
      if(pavillon.nb_pv_titre_nav) {
        this.cols[3].enabled = true
      }
      if(pavillon.nb_pv_police_nav) {
        this.cols[4].enabled = true
      }
      if(pavillon.nb_pv_env_pollution) {
        this.cols[5].enabled = true
      }
      if(pavillon.nb_autre_pv) {
        this.cols[6].enabled = true
      }
      if(pavillon.nb_nav_deroute) {
        this.cols[7].enabled = true
      }
      if(pavillon.nb_nav_interroge) {
        this.cols[8].enabled = true
      }
    })
  },
  methods: {
    addPav(event) {
      const newPav = {
        category: {
          id: this.pavillons[0].category.id,
          nom: this.pavillons[0].category.nom
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
      };
      this.pavillons.push(newPav);
    },
    getData() {
      this.$emit('get-controles', this.pavillons)
    }
  },
  data: function() {
    return {
      cols: [
        {
          title: 'Nb de navires controlé',
          enabled: true
        },
        {
          title: 'Pêches sanitaire',
          enabled: true
        },
        {
          title: 'PV équipement sécu. permis de nav.',
          enabled: false
        },
        {
          title: 'PV titre de navig. role/déc. eff',
          enabled: false
        },
        {
          title: 'PV police navigation',
          enabled: false
        },
        {
          title: 'PV environnement pollution',
          enabled: false
        },
        {
          title: 'Autres types de PV',
          enabled: false
        },
        {
          title: 'Navires dérouté',
          enabled: false
        },
        {
          title: 'Navire interrogé',
          enabled: false
        },
      ]
    }
  }
}
</script>

<style scoped>

</style>

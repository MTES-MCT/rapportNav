<template>
  <div class="table-custom">
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
        <i class="ri-add-circle-fill"></i>
        Ajouter un PV, nav déroutés...
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
      <tr class="tr-table" v-for="(controle, index) in controles">
        <td class="td-pavillon td-table-controle">
          <select name="pavillon" id="pavillon-select" v-model="controle.pavillon">
            <option value="FR">FR</option>
            <option value="US">US</option>
          </select>
        </td>
        <TdEditable
            v-if="cols[0].enabled"
            v-model="controle.nb_navire_controle"
        >
        </TdEditable>
        <TdEditable
            v-if="cols[1].enabled"
            v-model="controle.pv_peche_sanitaire"
        >
        </TdEditable>
        <TdEditable
            v-if="cols[2].enabled"
            v-model="controle.pv_equipement_securite"
        >
        </TdEditable>
        <TdEditable
            v-if="cols[3].enabled"
            v-model="controle.pv_titre_nav"
        >
        </TdEditable>
        <TdEditable
            v-if="cols[4].enabled"
            v-model="controle.pv_police_nav"
        >
        </TdEditable>
        <TdEditable
            v-if="cols[5].enabled"
            v-model="controle.pv_env_pollution"
        >
        </TdEditable>
        <TdEditable
            v-if="cols[6].enabled"
            v-model="controle.autre_pv"
        >
        </TdEditable>
        <TdEditable
            v-if="cols[7].enabled"
            v-model="controle.nb_nav_deroute"
        >
        </TdEditable>
        <TdEditable
            v-if="cols[8].enabled"
            v-model="controle.nb_nav_interroge"
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
      <i class="ri-add-circle-fill"></i>
      Ajouter un pavillon
    </div>
  </div>
</template>

<script>
import Dropdown from 'bp-vuejs-dropdown';
import TdEditable from "./TdEditable";
export default {
  name: "TableControleComponent",
  components: {
    TdEditable,
    Dropdown
  },
  props: {
    id: {
      type: Number,
      default: null
    }
  },
  mounted() {

  },
  methods: {
    addPav(event) {
      const newPav = {
        type: this.id,
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
      };
      this.controles.push(newPav);
      console.log(this.controles)
    }
  },
  data: function() {
    return {
      controles: [
        {
          type: this.id,
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
      ],
      cols: [
        {
          title: 'Nb de navires controlé',
          enabled: true
        },
        {
          title: 'Pêches sanitaire',
          enabled: false
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
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
        <td
            class="td-table-controle"
            contenteditable="true"
            v-for="(col, counter) in cols"
            v-if="col.enabled"
            v-model="controle.nbNavireControle"
        >
        </td>
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
export default {
  name: "TableControleComponent",
  components: {
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
    hiddenToggle(className, scope) {
      let tooltip = $('.' + className + '[data-scope="' + scope + '"]');
      tooltip.toggleClass('d-none');
    },
    addPav(event) {
      const newPav = {
        pavillon: 'FR',
        nbNavireControle: 0
      };
      this.controles.push(newPav);
    }
  },
  data: function() {
    return {
      controles: [
        {
          pavillon: 'FR',
          nbNavireControle: null,
          pv_peche_sanitaire: null
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
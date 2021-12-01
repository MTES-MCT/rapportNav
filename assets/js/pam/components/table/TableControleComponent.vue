<template>
  <div class="table-custom">
    <table class="table-controle">
      <thead class="thead-controle">
      <th :class="'th-table-controle-' + id">Pavillon</th>
      <th
          :class="'th-table-controle-' + id"
          v-for="(col, counter) in cols"
      >
        {{col.title}}
      </th>
      <th class="add-column dropbtn" id="add-btn">
        <i class="ri-add-circle-fill"></i>
        Ajouter un PV, nav déroutés...
        <div class="dropdown d-none" id="dropdown">
          <ul>
            <li>
              <a href="#" class="dropdown-item">Ajouter des pv</a>
              <ul>
                <li><a href="#" class="dropdown-link" data-dropdown-label="PV pêche sanitaire" @click="addCols($event)">PV pêche sanitaire</a></li>
                <li><a href="#" class="dropdown-link" data-dropdown-label="PV équipement sécu. permis de nav." @click="addCols($event)">PV équipement sécu. permis de nav.</a></li>
                <li><a href="#" class="dropdown-link" data-dropdown-label="PV titre de navig. role/déc. eff" @click="addCols($event)">PV titre de navig. role/déc. eff</a></li>
                <li><a href="#" class="dropdown-link" data-dropdown-label="PV police navigation" @click="addCols($event)">PV police navigation</a></li>
                <li><a href="#" class="dropdown-link" data-dropdown-label="PV environnement pollution" @click="addCols($event)">PV environnement pollution</a></li>
                <li><a href="#" class="dropdown-link" data-dropdown-label="Autres types de PV" @click="addCols($event)">Autres types de PV</a></li>
              </ul>
            </li>
            <li>
              <span class="dropdown-link" data-dropdown-label="Navires déroutés" @click="addCols($event)">Ajouter des navires déroutés</span>
            </li>
            <li>
              <a href="#" class="dropdown-link" data-dropdown-label="Navires interrogés" @click="addCols($event)">Ajouter des navires Interrogés</a>
            </li>
          </ul>
        </div>
      </th>
      </thead>

      <tbody :class="'tbody-controle-' + id">
      <tr class="tr-table" v-for="(pavillon, index) in pavillons">
        <td class="td-pavillon td-table-controle">
          <select name="pavillon" id="pavillon-select">
            <option value="FR">FR</option>
            <option value="US">US</option>
          </select>
        </td>
        <td
            class="td-table-controle"
            contenteditable="true"
            v-for="(col, counter) in cols"
        >
          {{pavillon.value}}
        </td>
        <td class="td-add-column td-table-controle"></td>
      </tr>
      </tbody>

      <tfoot>
      <tr>
        <th scope="row" class="th-foot-controle">Total</th>
        <td class="td-foot-controle">25</td>
        <td class="td-foot-controle">6</td>
        <td class="td-foot-controle">4</td>
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
    // Prevent href event
    $('.dropdown-item').click((e) => e.preventDefault());
    $('.dropdown-link').click((e) =>  e.preventDefault())
    // Display dropdown menu
   // $('.dropbtn').click((e) => $('#dropdown').removeClass('d-none'));

    $('.dropbtn').hover(
        () => {
          $('#dropdown').removeClass('d-none')
        },
        () => {
          $('#dropdown').addClass('d-none')
        }
    );
  },
  methods: {
    hiddenToggle(className, scope) {
      let tooltip = $('.' + className + '[data-scope="' + scope + '"]');
      tooltip.toggleClass('d-none');
    },
    addPav(event) {
      const newPav = {
        value: 0
      };
      this.pavillons.push(newPav);
    },
    addCols(e) {
      const col = {
        title: e.target.innerText
      };
      this.cols.push(col)
    }
  },
  data: function() {
    return {
      pavillons: [
        {
          value: 0
        }
      ],
      cols: [
        {
          title: 'Nb de navires controlé'
        },
      ]
    }
  }
}
</script>

<style scoped>

</style>
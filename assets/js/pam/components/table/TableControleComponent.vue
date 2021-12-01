<template>
  <div class="table-custom">
    <table class="table-controle">
      <thead class="thead-controle">
      <th :class="'th-table-controle-' + id">Pavillon</th>
      <th :class="'th-table-controle-' + id">Nb de navire contrôlés</th>
      <th :class="'th-table-controle-' + id">Nb de contrôles pêche sanitaire</th>
      <th :class="'th-table-controle-' + id">Nb pv dec eff</th>
      <th class="add-column dropbtn" id="add-btn">
        <i class="ri-add-circle-fill"></i>
        Ajouter un PV, nav déroutés...
        <div class="dropdown d-none" id="dropdown">
          <ul>
            <li>
              <a href="#" class="dropdown-item">Ajouter des pv</a>
              <ul>
                <li><a href="#" class="dropdown-link" data-dropdown-label="PV pêche sanitaire">PV pêche sanitaire</a></li>
                <li><a href="#" class="dropdown-link" data-dropdown-label="PV équipement sécu. permis de nav.">PV équipement sécu. permis de nav.</a></li>
                <li><a href="#" class="dropdown-link" data-dropdown-label="PV titre de navig. role/déc. eff">PV titre de navig. role/déc. eff</a></li>
                <li><a href="#" class="dropdown-link" data-dropdown-label="PV police navigation">PV police navigation</a></li>
                <li><a href="#" class="dropdown-link" data-dropdown-label="PV environnement pollution">PV environnement pollution</a></li>
                <li><a href="#" class="dropdown-link" data-dropdown-label="Autres types de PV">Autres types de PV</a></li>
              </ul>
            </li>
            <li>
              <a href="#" class="dropdown-link" data-dropdown-label="Navires déroutés">Ajouter des navires déroutés</a>
            </li>
            <li>
              <a href="#" class="dropdown-link" data-dropdown-label="Navires interrogés">Ajouter des navires Interrogés</a>
            </li>
          </ul>
        </div>
      </th>
      </thead>

      <tbody :class="'tbody-controle-' + id">
      <tr class="tr-table">
        <td class="td-pavillon td-table-controle">
          <select name="pavillon" id="pavillon-select">
            <option value="FR">FR</option>
            <option value="US">US</option>
          </select>
        </td>
        <td class="td-table-controle" contenteditable="true">25</td>
        <td class="td-table-controle" contenteditable="true">6</td>
        <td class="td-table-controle" contenteditable="true">4</td>
        <td class="td-add-column td-table-controle"></td>
      </tr>

      <tr class="tr-example d-none tr-table">
        <td class="td-pavillon td-table-controle">
          <select name="pavillon" id="pavillon-select">
            <option value="FR">FR</option>
            <option value="US">US</option>
          </select>
        </td>
        <td class="td-table-controle" contenteditable="true"></td>
        <td class="td-table-controle" contenteditable="true"></td>
        <td class="td-table-controle" contenteditable="true"></td>
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


    $('.dropdown-link').click(function(e) {
      e.preventDefault()
      let content = $(e.target).data('dropdown-label')
      $('.add-column').before('<th class="th-table-controle-"' + this.id + '>' + content + '</th>')
      $('.td-add-column').before('<td class="td-table-controle" contenteditable="true"></td>')
    })
  },
  methods: {
    hiddenToggle(className, scope) {
      let tooltip = $('.' + className + '[data-scope="' + scope + '"]');
      tooltip.toggleClass('d-none');
    },
    addPav(event) {
      let $sample = $('.tr-example');
      $sample = $($sample[0]);
      let trE = $sample.clone();
      trE.removeClass('d-none')
      trE.removeClass('tr-example')
      $('.tbody-controle-' + this.id ).append(trE)
    }
  }
}
</script>

<style scoped>

</style>
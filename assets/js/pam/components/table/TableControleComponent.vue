<template>
  <div class="table-custom">
    <table class="table-controle">
      <thead class="thead-controle">
      <th class="th-table-controle">Pavillon</th>
      <th class="th-table-controle">Nb de navire contrôlés</th>
      <th class="th-table-controle">Nb de contrôles pêche sanitaire</th>
      <th class="th-table-controle">Nb pv dec eff</th>
      <th class="add-column dropbtn th-table-controle" id="add-btn" v-on:click="hiddenToggle('dropdown', 'ajout-pv')">
        <i class="ri-add-circle-fill"></i>
        Ajouter un PV, nav déroutés...
        <div class="dropdown d-none" id="dropdown" data-scope="ajout-pv">
          <ul v-on:click="addColumnControle($event)">
            <li>
              <span class="dropdown-item">Ajouter des pv</span>
              <ul>
                <li><span class="dropdown-link">PV pêche sanitaire</span></li>
                <li><span class="dropdown-link">PV équipement sécu. permis de nav.</span ></li>
                <li><span class="dropdown-link">PV titre de navig. role/déc. eff</span ></li>
                <li><span class="dropdown-link">PV police navigation</span ></li>
                <li><span class="dropdown-link">PV environnement pollution</span></li>
                <li><span class="dropdown-link">Autres types de PV</span ></li>
              </ul>
            </li>
            <li>
              <span class="dropdown-item">Ajouter des navires déroutés</span>
            </li>
            <li>
              <span class="dropdown-item">Ajouter des navires Interrogés</span>
            </li>
          </ul>
        </div>
      </th>
      </thead>

      <tbody class="tbody-controle">
      <tr class="tr-table">
        <td class="td-pavillon td-table-controle">
          <select name="pavillon" id="pavillon-select">
            <option value="FR">FR</option>
            <option value="US">US</option>
          </select>
        </td>
        <td class="td-table-controle">25</td>
        <td class="td-table-controle">6</td>
        <td class="td-table-controle">4</td>
        <td class="td-add-column td-table-controle"></td>
      </tr>

      <tr class="tr-example d-none tr-table">
        <td class="td-pavillon td-table-controle"></td>
        <td class="td-table-controle"></td>
        <td class="td-table-controle"></td>
        <td class="td-table-controle"></td>
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
    <div class="add-pavillon" v-on:click="addPav()">
      <i class="ri-add-circle-fill"></i>
      Ajouter un pavillon
    </div>
  </div>
</template>

<script>
export default {
  name: "TableControleComponent",
  methods: {
    addPav() {
      let trE = $('.tr-example').clone();
      trE.removeClass('d-none')
      trE.removeClass('tr-example')
      $('.tbody-controle').append(trE)
    },
    addColumnControle(e) {
      const text = e.target.outerText;
      $('.add-column').before('<th class="th-table-controle">' + text + '</th>')
      $('.td-add-column').before('<td class="td-table-controle"></td>')
    }
  }
}
</script>

<style scoped>

</style>
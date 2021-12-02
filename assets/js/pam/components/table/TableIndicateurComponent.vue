<template>
  <div class="table-custom ">
    <table class="table-indicateur">
      <thead class="thead-indicateur">
      <th class="th-indicateur">Missions</th>
      <th class="th-indicateur">Principale</th>
      <th class="th-indicateur">Secondaire</th>
      <th class="total-column th-indicateur">Total</th>
      <th class="th-indicateur">Observations</th>
      </thead>

      <tbody>
      <tr class="tr-indicateur">
        <td class="td-nb-hour-sea td-indicateur">
          Nombre d'heure de mer
        </td>
        <td class="td-indicateur"></td>
        <td class="td-indicateur"></td>
        <td class="td-total td-indicateur" contenteditable="true">99</td>
        <td class="td-observation td-indicateur" >
          <i class="ri-message-2-fill" v-on:click="hiddenToggle('tooltip-observation','hour-sea')"></i>
          <div class="tooltip-observation d-none" data-scope="hour-sea">
            <textarea name="observation" id="observation" cols="4" rows="6" class="fr-input" placeholder="Observations"></textarea>
          </div>
        </td>
      </tr>
      <tr>
        <td class="td-nb-hour-sea td-indicateur">
          Nombre de navires / embarcations interceptés
        </td>
        <td class="td-principale-content td-indicateur">
          0
          <span class="ri-calculator-fill icon" v-on:click="hiddenToggle('tooltip-automatic-calculate', 'interception')"></span>
          <div class="tooltip-automatic-calculate d-none" data-scope="interception">
            <div class="fr-toggle fr-toggle--label-left">
              <input type="checkbox" checked class="fr-toggle__input switch-table-auto-calculate" :aria-describedby="'toggle-' + id +'-hint-text'" :id="'toggle-' + id" v-on:change="displayMessage($event, 'interception')">
              <label class="fr-toggle__label" :for="'toggle-' + id" data-fr-checked-label="Activé">Calculé automatiquement à partir des déclarations opérationnelles</label>
              <p class="fr-hint-text hint-text-automatic-calculate" :id="'toggle-' + id + '-hint-text'" data-scope="interception">
                <span class="fr-fi-information-fill info-icon-sm" aria-hidden="true"></span> Désactivez pour pouvoir éditer le champ sélectionné
              </p>
              <p class="fr-hint-text hint-text-automatic-calculate d-none" :id="'toggle-' + id + '-hint-text'" data-scope="interception">
                <span class="fr-fi-information-fill info-icon-sm" aria-hidden="true"></span> Activez pour calculer automatiquement le champ sélectionné
              </p>
            </div>
          </div>
        </td>
        <td class="td-indicateur"></td>
        <td class="td-total td-indicateur" contenteditable="true">99</td>
        <td class="td-observation td-indicateur" >
          <i class="ri-message-2-fill" v-on:click="hiddenToggle('tooltip-observation','interception')"></i>
          <div class="tooltip-observation d-none" data-scope="interception">
            <textarea name="observation" id="observation" cols="4" rows="6" class="fr-input" placeholder="Observations"></textarea>
          </div>
        </td>
      </tr>
      <tr>
        <td class="td-nb-hour-sea td-indicateur">
          Nombre de mise en demeure
        </td>
        <td class="td-indicateur"></td>
        <td class="td-indicateur"></td>
        <td class="td-total td-indicateur" contenteditable="true">99</td>
        <td class="td-observation td-indicateur" >
          <i class="ri-message-2-fill" v-on:click="hiddenToggle('tooltip-observation','mise-en-demeure')"></i>
          <div class="tooltip-observation d-none" data-scope="mise-en-demeure">
            <textarea name="observation" id="observation" cols="4" rows="6" class="fr-input" placeholder="Observations"></textarea>
          </div>
        </td>
      </tr>
      <tr>
        <td class="td-nb-hour-sea td-indicateur">
          Nombre de remorquages dans le cadre d’une opération suivie
        </td>
        <td class="td-principale-content td-indicateur">
          0
          <span class="ri-calculator-fill icon" v-on:click="hiddenToggle('tooltip-automatic-calculate', 'remorquage')">
                        </span>
          <div class="tooltip-automatic-calculate d-none" data-scope="remorquage">
            <div class="fr-toggle fr-toggle--label-left">
              <input type="checkbox" checked class="fr-toggle__input switch-table-auto-calculate" :aria-describedby="'toggle-' + id +'-hint-text'" :id="'toggle-' + id+1" v-on:change="displayMessage($event, 'remorquage')">
              <label class="fr-toggle__label" :for="'toggle-' + id+1" data-fr-checked-label="Activé">Calculé automatiquement à partir des déclarations opérationnelles</label>
              <p class="fr-hint-text hint-text-automatic-calculate" :id="'toggle-' + id+1 + '-hint-text'" data-scope="remorquage">
                <span class="fr-fi-information-fill info-icon-sm" aria-hidden="true"></span> Désactivez pour pouvoir éditer le champ sélectionné
              </p>
              <p class="fr-hint-text hint-text-automatic-calculate d-none" :id="'toggle-' + id+1 + '-hint-text'" data-scope="remorquage">
                <span class="fr-fi-information-fill info-icon-sm" aria-hidden="true"></span> Activez pour calculer automatiquement le champ sélectionné
              </p>

            </div>
            <div class="checkbox-automatic-calculate-error d-none" data-scope="remorquage">
              <span class="fr-fi-alert-fill" aria-hidden="true"></span>
              Vous avez saisi un chiffre qui ne correspond pas aux informations renseignées dans la partie Contrôles opérationnels :
              <div class="automatic-calculate-el-errors">
                5 éléments calculés automatiquement
              </div>
            </div>
          </div>
        </td>
        <td class="td-indicateur"></td>
        <td class="td-total td-indicateur" contenteditable="true">99</td>
        <td class="td-observation td-indicateur" >
          <i class="ri-message-2-fill" v-on:click="hiddenToggle('tooltip-observation','remorquage')"></i>
          <div class="tooltip-observation d-none" data-scope="remorquage">
            <textarea name="observation" id="observation" cols="4" rows="6" class="fr-input" placeholder="Observations"></textarea>
          </div>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "TableIndicateurComponent",
  props: {
    id : {
      type: Number,
      default: null
    }
  },
  methods: {
    hiddenToggle(className, scope) {
      let tooltip = $('.' + className + '[data-scope="' + scope + '"]');
      tooltip.toggleClass('d-none');
    },
    displayMessage(e, scope) {
      let messageBox = $('.hint-text-automatic-calculate[data-scope="' + scope + '"]');
      messageBox.toggleClass('d-none')
    },
  }
}
</script>

<style scoped>

</style>
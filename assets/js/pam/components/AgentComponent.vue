<template>
  <div class="agent" ref="agentItem">
    <div class="agent-item" @click="hidden = !hidden">
      <div class="equipName">
        {{ fullName }}
        <span class="equipRole">{{ membre.role }}</span>
      </div>
      <div class="tooltip">
        <span class="ri-more-fill more-option-icon"></span>
      </div>
    </div>
    <div class="tooltipMember fr-px-2w fr-py-2w" v-if="!hidden" v-click-outside="hideTooltip">
      <input class="fr-input" type="text" id="memberName" :value="fullName" disabled>

      <select class="fr-select fr-mt-3v" id="select"  v-model="membre.role">
        <option value="Agent de pont">Agent de pont</option>
        <option value="Commandant">Commandant</option>
        <option value="Second capitaine">Second capitaine</option>
        <option value="Chef de quart / Second capitaine PI">Chef de quart / Second capitaine PI</option>
        <option value="Chef de quart">Chef de quart</option>
        <option value="Chef mécanicien">Chef mécanicien</option>
        <option value="Second mécanicien">Second mécanicien</option>
        <option value="Électricien">Électricien</option>
        <option value="Maître d’équipage">Maître d’équipage</option>
        <option value="Cuisinier">Cuisinier</option>
        <option value="Agent machine">Agent machine</option>
      </select>

      <select class="fr-select fr-mt-3v" id="fonctionParticuliere"  v-model="membre.fonctionParticuliere">
        <option value="" selected disabled hidden>Fonction particulière : - sélectionner - </option>
        <option value="Plongeur">Plongeur</option>
        <option value="Référent pêche">Référent pêche</option>
        <option value="Référent environnement">Référent environnement</option>
      </select>

      <textarea class="fr-input fr-mt-3v" id="textarea" placeholder="Observations" v-model="membre.observations"></textarea>

      <div class="fr-checkbox-group">
        <input type="checkbox" v-model="membre.is_absent" :id="'membre-' + id">
        <label class="fr-label" :for="'membre-' + id">Absent</label>
      </div>

      <button class="custom-btn fr-fi-checkbox-circle-line fr-btn--icon-left fr-mt-3v remove-equip-btn" @click="removeAgent(index)">
        Supprimer le membre
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "AgentComponent",
  props: {
    membre: Object,
    agentList: Array,
    index: Number
  },
  created () {

  },
  methods: {
    removeAgent(index) {
      this.agentList.splice(index, 1);
    },
    hideTooltip(event) {
        if(!this.$refs.agentItem.contains(event.target)) {
          this.hidden = true;
        }
    }
  },
  data() {
    return {
      fullName: this.membre.agent.prenom + ' ' + this.membre.agent.nom,
      id: this._uid,
      hidden: true
    }
  }
}
</script>

<style scoped>

</style>

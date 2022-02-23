<template>
  <div class="agent" ref="agentItem">
    <div class="agent-item" @click="hidden = !hidden">
      <div class="equipName">
        {{ fullName }}
        <span class="equipRole">{{ membre.fonction.nom }}</span>
      </div>
      <div class="tooltip">
        <span class="ri-more-fill more-option-icon"></span>
      </div>
    </div>
    <div class="tooltipMember fr-px-2w fr-py-2w" v-if="!hidden" v-click-outside="hideTooltip">
      <input class="fr-input" type="text" id="memberName" :value="fullName" disabled>

      <select class="fr-select fr-mt-3v" id="select"  v-model="membre.fonction">
        <option v-for="fonction in fonctions" :value="{id: fonction.id, nom: fonction.nom}">{{ fonction.nom }}</option>
      </select>

      <select class="fr-select fr-mt-3v" id="fonctionParticuliere"  v-model="membre.fonctionParticuliere">
        <option :value="{nom: ''}" selected disabled hidden>Fonction particulière : - sélectionner - </option>
        <option v-for="fonction in fonctionsParticulieres" :value="{id: fonction.id, nom: fonction.nom}">{{ fonction.nom }}</option>
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
    index: Number,
    fonctions: Array,
    fonctionsParticulieres: Array
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

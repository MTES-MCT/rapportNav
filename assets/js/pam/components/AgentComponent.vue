<template>
  <div class="member-group">
    <div class="equipName">
      {{ fullName }}
      <span class="equipRole">{{ membre.role }}</span>
    </div>
    <div class="tooltip">
      <span class="ri-more-fill more-option-icon "></span>
      <div class="tooltipMember fr-px-2w fr-py-2w">
        <input class="fr-input" type="text" id="memberName" :value="fullName" disabled>

        <select class="fr-select fr-mt-3v" id="select"  v-model="membre.role">
          <option value="Agent de pont">Agent de pont</option>
          <option value="Commandant">Commandant</option>
          <option value="4">Option 4</option>
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
  </div>
</template>

<script>
export default {
  name: "AgentComponent",
  props: {
    membre: Object,
    agentList: Array
  },
  methods: {
    removeAgent(index) {
      this.agentList.splice(index, 1);
    }
  },
  data() {
    return {
      fullName: this.membre.agent.prenom + ' ' + this.membre.agent.nom,
      id: this._uid
    }
  }
}
</script>

<style scoped>

</style>

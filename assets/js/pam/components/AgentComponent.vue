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

      <div class="display-flex fr-mt-3v" v-if="!membre.isPresent && !membre.is_absent">
        <div class="display-flex" @change="onChangeArrivee($event)">
          <select name="" id="" class="fr-select select-day" v-model="arrivee.day">
            <option :value="day" v-for="(day, index) in 31" :key="day">{{day}}</option>
          </select>
          <select name="" id="" class="fr-select select-month" v-model="arrivee.month">
            <option :value="index" v-for="(month, index) in months">{{month}}</option>
          </select>
          <input type="time" class="fr-input select-time" v-model="arrivee.time">
        </div>
        <div class="display-flex" @change="onChangeDepart($event)">
          <select class="fr-select select-day" v-model="depart.day">
            <option :value="day" v-for="(day, index) in 31" :key="day">{{day}}</option>
          </select>
          <select class="fr-select select-month" v-model="depart.month">
            <option :value="index" v-for="(month, index) in months">{{month}}</option>
          </select>
          <input type="time" class="fr-input select-time" v-model="depart.time">
        </div>
      </div>



      <textarea class="fr-input fr-mt-3v" id="textarea" placeholder="Observations" v-model="membre.observations"></textarea>

      <div class="fr-checkbox-group">
        <input type="checkbox" v-model="membre.isPresent" :id="'membre-' + id" :disabled="membre.is_absent">
        <label class="fr-label" :for="'membre-' + id">Agent présent sur toute la mission</label>
      </div>

      <div class="fr-checkbox-group">
        <input type="checkbox" v-model="membre.is_absent" :id="'membre_absent-' + id" :disabled="membre.isPresent">
        <label class="fr-label" :for="'membre_absent-' + id">Agent absent</label>
      </div>

      <button class="custom-btn fr-fi-delete-fill fr-btn--icon-left fr-mt-3v remove-equip-btn" @click="removeAgent(index)">
        Supprimer le membre
      </button>
    </div>
  </div>
</template>

<script>
import moment from "moment";

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
    },
    onChangeArrivee(event) {
      let currentYear = new Date().getFullYear();
      let date = new Date(currentYear, parseInt(this.arrivee.month), parseInt(this.arrivee.day), parseInt(this.arrivee.time))
      this.membre.dateArrivee = date.toISOString();
    },
    onChangeDepart(event) {
      let currentYear = new Date().getFullYear();
      let date = new Date(currentYear, parseInt(this.depart.month), parseInt(this.depart.day), parseFloat(this.depart.time));
      this.membre.dateDepart = date.toISOString();
    }
  },
  data() {
    return {
      fullName: this.membre.agent.prenom + ' ' + this.membre.agent.nom,
      id: this._uid,
      hidden: true,
      months: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
      depart: {
        day: moment(this.membre.dateDepart).format('DD') || new Date().getDate(),
        month: moment(this.membre.dateDepart).format('MM') || new Date().getMonth(),
        time: moment(this.membre.dateDepart).format('HH:mm') || null
      },
      arrivee: {
        day: moment(this.membre.dateArrivee).format('DD') || new Date().getDate(),
        month: moment(this.membre.dateArrivee).format('MM') || new Date().getMonth(),
        time: moment(this.membre.dateArrivee).format('HH:mm') || null
      },
    }
  },
  watch: {

  }
}
</script>

<style scoped>

</style>

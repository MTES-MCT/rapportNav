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
        <option v-for="fonction in fonctions" :key="fonction.id" :value="{id: fonction.id, nom: fonction.nom}">{{ fonction.nom }}</option>
      </select>

      <select class="fr-select fr-mt-3v" id="fonctionParticuliere"  v-model="membre.fonctionParticuliere">
        <option :value="{nom: ''}" selected disabled hidden>Fonction particulière : - sélectionner - </option>
        <option v-for="fonction in fonctionsParticulieres" :key="fonction.id" :value="{id: fonction.id, nom: fonction.nom}">{{ fonction.nom }}</option>
      </select>

      <div class="fr-checkbox-group">
        <input type="checkbox" :checked="isPresent" @change="toggleIsPresentPartiel()" :id="'membre-' + id" :disabled="isAbsent">
        <label class="fr-label" :for="'membre-' + id">Agent présent partiellement sur toute la mission</label>
      </div>

      <div class="fr-mt-4v" v-if="isPresent">
        <label for="dates_abscence" class="label__presence">Dates d'absences</label>
        <input type="text" class="fr-input dates-absences" id="dates_abscence" readonly />
      </div>

      <div class="fr-checkbox-group">
        <input type="checkbox" :checked="isAbsent" @change="toggleIsAbsent()" :id="'membre_absent-' + id" :disabled="isPresent">
        <label class="fr-label" :for="'membre_absent-' + id">Agent absent toute la mission</label>
      </div>

      <textarea class="fr-input fr-mt-3v" id="textarea" placeholder="Observations" v-model="membre.observations"></textarea>

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
  methods: {
    removeAgent(index) {
      this.agentList.splice(index, 1);
    },
    hideTooltip(event) {
        if(!this.$refs.agentItem.contains(event.target)) {
          this.hidden = true;
        }
    },
    toggleIsAbsent() {
      this.membre.presence = (0 === this.membre.presence) ? 2 : 0;
    },
    toggleIsPresentPartiel() {
      this.membre.presence = (1 === this.membre.presence) ? 2 : 1;
    },
  },
  data() {
    return {
      fullName: this.membre.agent.prenom + ' ' + this.membre.agent.nom,
      id: this._uid,
      hidden: true
    }
  },
  computed: {
    isPresent: function() {
      return 1 === this.membre.presence
    },
    isAbsent: function() {
      return 0 === this.membre.presence
    }
  },
  updated() {
    this.$nextTick(function() {
      $('.dates-absences').daterangepicker({
        timePicker: true,
        timePicker24Hour: true,
        startDate: moment(this.membre.dateArrivee).startOf('hour'),
        endDate: moment(this.membre.dateDepart).startOf('hour'),
        locale: {
          format: "DD/MM/YYYY HH:mm",
          separator: " - ",
          applyLabel: "OK",
          cancelLabel: "Annuler",
          fromLabel: "De",
          toLabel: "à",
          customRangeLabel: "Custom",
          weekLabel: "W",
          daysOfWeek: ["Lun", "Mar", "Mer", "Je", "Ve", "Sa", "Di"
          ],
          monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
            "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
          ],
          firstDay: 1
        },
      }, (start, end, label) => {
        this.membre.dateArrivee = start.format('YYYY-MM-DDTHH:mm:ss');
        this.membre.dateDepart = end.format('YYYY-MM-DDTHH:mm:ss');
      });
    })
  }
}
</script>

<style scoped>

</style>

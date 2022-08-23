<template>
  <div class="fr-grid-row">
    <div class="fr-col-lg-7 fr-col-md-8">
      <div class="members-list">
        <AgentComponent v-for="(agent, index) in membres"
                        :key="agent.hash"
                        :membre="agent"
                        :agent-list="membres"
                        :fonctions="fonctions"
                        :fonctions-particulieres="fonctionsParticulieres"
                        :index="index">
        </AgentComponent>
      </div>
    </div>
    <div class="fr-col-lg-5 fr-col-md-4 fr-pl-4v"  ref="suggestionList">
      <input class="fr-input" type="text" placeholder="Ajouter des membres" v-model="tmpAgent.fullName"
             id="input_ajouter_membres"
             @keydown="createNewMember($event.target.value); fetchAutocomplete()"
             @click="hidden = !hidden"
      >
      <div class="tooltip-add-member" data-scope="member" v-if="!hidden" v-click-outside="hideTooltip">
        <div class="add-member-content">
          <div class="fr-container--fluid">
            <div class="fr-grid-row">
              <div class="fr-col-7">
                <div class="text-14 text-italic text-left text-muted">Suggestions</div>
              </div>
              <div class="fr-col-5">
                <span class="text-12" @click="addAll">  <i class="ri-add-circle-fill" aria-hidden="true"></i> Tout ajouter</span>
              </div>
            </div>
          </div>
        </div>
        <div class="add-member-content">
          <div class="fr-container--fluid">
            <div class="fr-grid-row suggestionsList" v-for="(suggestion, index) in suggestionsList">
              <div class="fr-col-7">
                <div class="text-14 text-left" >
                  {{ suggestion.agent.prenom }} {{ suggestion.agent.nom }}
                </div>
              </div>
              <div class="fr-col-5">
                <button
                    :id="'ajout_suggestion_' + index"
                    class="fr-btn--menu fr-btn fr-btn--sm fr-fi-add-circle-fill fr-btn--secondary fr-btn--icon-left"
                    title="Enregistrer"
                    @click="addAgent(suggestion, index)"
                >Ajouter
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tooltip-new-member" ref="newAgent" data-scope="member" v-if="!hiddenNewAgent" v-click-outside="hideTooltipNewAgent">
        <div class="add-member-content">
          <div class="fr-container--fluid">
            <span class="text-left text-muted text-14 text-italic fr-mt-2v ">Ajouter "{{tmpAgent.fullName}}"</span>
            <div class="fr-input-group fr-mt-5v">
              <select class="fr-select" v-model="tmpAgent.fonction" id="fonction_select">
                <option :value="{nom: ''}" selected disabled hidden>Poste : - sélectionner - </option>
                <option v-for="(fonction, index) in fonctions" :value="{id: fonction.id, nom: fonction.nom}" :id="'fonction_' + index">{{ fonction.nom }}</option>
              </select>

              <select class="fr-select" v-model="tmpAgent.fonctionParticuliere">
                <option :value="{nom: ''}" selected disabled hidden>Fonction particulière : - sélectionner - </option>
                <option v-for="fonction in fonctionsParticulieres" :value="{id: fonction.id, nom: fonction.nom}">{{ fonction.nom }}</option>
              </select>
            </div>
            <div class="fr-input-group">
              <textarea cols="30" rows="5" class="fr-input" v-model="tmpAgent.observations" placeholder="Observations" id="input_ajout_agent_observation"></textarea>
            </div>

            <button
                id="btn_ajout_nouveau_agent"
                class="fr-btn--menu fr-btn fr-btn--sm fr-fi-add-circle-fill fr-btn--secondary fr-btn--icon-left"
                title="Enregistrer"
                @click="addAgent()"
            >Ajouter
            </button>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import AgentComponent from "./AgentComponent";
import axios from "axios";
export default {
  name: "EquipageComponent",
  components: {AgentComponent},
  mounted() {
    this.fetchAutocomplete();
    this.fetchFonctionsParticulieres();
    this.fetchFonctions();
  },
  props: {
    membres: {
      type: Array,
      default: null
    }
  },
  methods: {
    addAgent(suggestion = null, index = null) {
      const membre = suggestion ? suggestion : {};
      if(!suggestion) {
        membre.agent = {};
        membre.agent.nom = this.tmpAgent.fullName.split(' ')[1]
        membre.agent.prenom = this.tmpAgent.fullName.split(' ')[0];
        membre.observations = this.tmpAgent.observations;
        membre.fonction = this.tmpAgent.fonction;
        membre.agent.dateArrivee = new Date();
        membre.fonctionParticuliere = this.tmpAgent.fonctionParticuliere;
        this.tmpAgent = {
          fonction:  {
            nom: ''
          },
          fonctionParticuliere: {
            nom: ''
          }
        };
      } else {
        this.suggestionsList.splice(index, 1);
      }
      membre.hash = new Date().getTime();
      this.membres.push(membre);

    },
    addAll() {
      this.suggestionsList.forEach(element => this.membres.push(element));
    },
    createNewMember(value) {
      this.hiddenNewAgent = this.suggestionsList.length !== 0;

      if(value.length === 0) {
        this.hiddenNewAgent = true;
      }
    },
    fetchAutocomplete() {
      let url = '/api/pam/equipage/autocomplete';
      url = this.tmpAgent.fullName ? url + '?fullName=' + this.tmpAgent.fullName : url;
      axios.get(url)
      .then((success) => {
        this.suggestionsList = [];

        success.data.forEach((agent) => {
          const suggestion = {
            fonction: {
              nom: 'Agent de pont'
            },
            fonctionParticuliere: null,
            agent: {
              id: agent.id,
              nom: agent.nom,
              prenom: agent.prenom,
              dateArrivee: new Date()
            }
          }
          this.suggestionsList.push(suggestion)
        })
      })
    },
    hideTooltip(event) {
      if(!this.$refs.suggestionList.contains(event.target)) {
        this.hidden = true;
      }
    },
    hideTooltipNewAgent(event) {
      if(this.$refs.newAgent && !this.$refs.newAgent.contains(event.target)) {
        this.hiddenNewAgent = true;
        this.hidden = true;
      }
    },
    fetchFonctions() {
      axios.get('/api/pam/equipage/fonctions')
      .then((success) => {
        this.fonctions = success.data;
      });
    },
    fetchFonctionsParticulieres() {
      axios.get('/api/pam/equipage/fonctions/particulieres')
          .then((success) => {
            this.fonctionsParticulieres = success.data;
      });
    }
  },
  data() {
    return {
      suggestionsList: [],
      tmpAgent: {
        fonction: {
          nom: ''
        },
        fonctionParticuliere: {
          nom: ''
        },
        isPresent: true
      },
      hidden: true,
      hiddenNewAgent: true,
      fonctions: [],
      fonctionsParticulieres: []
    }
  }
}
</script>

<style scoped>

</style>

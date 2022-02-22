<template>
  <div class="fr-grid-row">
    <div class="fr-col-lg-7 fr-col-md-8">
      <div class="members-list">
        <AgentComponent v-for="(agent, index) in membres"
                        :key="index"
                        :membre="agent"
                        :agent-list="membres"
                        :index="index">
        </AgentComponent>
      </div>
    </div>
    <div class="fr-col-lg-5 fr-col-md-4 fr-pl-4v"  ref="suggestionList">
      <input class="fr-input" type="text" placeholder="Ajouter des membres" v-model="tmpAgent.fullName"
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
                <div class="text-14 text-left">
                  {{ suggestion.agent.prenom }} {{ suggestion.agent.nom }}
                  <span class="equipRole">{{suggestion.role}}</span>
                </div>
              </div>
              <div class="fr-col-5">
                <button
                    class="fr-btn--menu fr-btn fr-btn--sm fr-fi-add-circle-fill fr-btn--secondary fr-btn--icon-left"
                    title="Enregistrer"
                    @click="addAgent(suggestion)"
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
              <select class="fr-select" v-model="tmpAgent.role">
                <option value="" selected disabled hidden>Poste : - sélectionner - </option>
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

              <select class="fr-select" v-model="tmpAgent.fonctionParticuliere">
                <option value="" selected disabled hidden>Fonction particulière : - sélectionner - </option>
                <option value="Plongeur">Plongeur</option>
                <option value="Référent pêche">Référent pêche</option>
                <option value="Référent environnement">Référent environnement</option>
              </select>
            </div>
            <div class="fr-input-group">
              <textarea cols="30" rows="5" class="fr-input" v-model="tmpAgent.observations" placeholder="Observations"></textarea>
            </div>

            <button
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
  },
  props: {
    membres: {
      type: Array,
      default: null
    }
  },
  methods: {
    addAgent(suggestion = null) {
      const membre = suggestion ? suggestion : {};
      if(!suggestion) {
        membre.agent = {};
        membre.agent.nom = this.tmpAgent.fullName.split(' ')[1]
        membre.agent.prenom = this.tmpAgent.fullName.split(' ')[0];
        membre.observations = this.tmpAgent.observations;
        membre.role = this.tmpAgent.role;
        membre.agent.dateArrivee = new Date();
        membre.fonctionParticuliere = this.tmpAgent.fonctionParticuliere;
        this.tmpAgent = {
          role: '',
          fonctionParticuliere: ''
        };
      }
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
            role: 'Agent de pont',
            fonctionParticuliere: '',
            agent: {
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
      if(!this.$refs.newAgent.contains(event.target)) {
        this.hiddenNewAgent = true;
        this.hidden = true;
      }
    }
  },
  data() {
    return {
      suggestionsList: [],
      tmpAgent: {
        role: '',
        fonctionParticuliere: ''
      },
      hidden: true,
      hiddenNewAgent: true
    }
  }
}
</script>

<style scoped>

</style>

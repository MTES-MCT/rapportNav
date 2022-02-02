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
    <div class="fr-col-lg-5 fr-col-md-4 fr-pl-4v">
      <input class="fr-input" type="text" placeholder="Ajouter des membres" v-model="tmpAgent.fullName"
             @keyup="createNewMember($event.target.value)"
      >
      <div class="tooltip-add-member d-none" data-scope="member">
        <div class="add-member-content">
          <div class="fr-container--fluid">
            <!--<div class="fr-grid-row">
              <div class="fr-col-7">
                <div class="text-14 text-italic text-left text-muted">Suggestions</div>
              </div>
              <div class="fr-col-5">
                <span class="text-12" @click="addAll">  <i class="ri-add-circle-fill"></i> Tout ajouter</span>
              </div>
            </div>-->
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
      <div class="tooltip-new-member d-none" data-scope="member">
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
export default {
  name: "EquipageComponent",
  components: {AgentComponent},
  mounted() {
    $(document).on('click',function(e){
      $(".tooltip-add-member").addClass('d-none');
    });
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
        this.tmpAgent = {
          role: ''
        };
      }
      this.membres.push(membre);

    },
    addAll() {
      this.suggestionsList.forEach(element => this.membres.push(element));
    },
    createNewMember(value) {
      let noExist = true;
      if(value.length > 2) {
        this.suggestionsList.filter(element => {
          if(element.agent.nom.indexOf(value) === 0) {
            noExist = false;
          }
        });
        if(noExist) {
          $('.tooltip-new-member').removeClass('d-none')
          $('.tooltip-add-member').addClass('d-none')
        } else {
         this.showSugestionList();
        }
      } else if (value.length === 0) {
        this.showSugestionList();
      }
    },
    showSugestionList() {
      $('.tooltip-new-member').addClass('d-none')
      $('.tooltip-add-member').removeClass('d-none')
    }
  },
  data() {
    return {
      suggestionsList: [],
      tmpAgent: {
        role: ''
      }
    }
  }
}
</script>

<style scoped>

</style>

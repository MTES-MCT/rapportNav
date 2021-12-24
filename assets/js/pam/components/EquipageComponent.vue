<template>
  <div class="fr-grid-row">
    <div class="fr-col-lg-7 fr-col-md-8">
      <div class="members-list">
        <AgentComponent v-for="agent in membres"
                        :agent="agent"
                        :agent-list="membres">
        </AgentComponent>
      </div>
    </div>
    <div class="fr-col-lg-5 fr-col-md-4 fr-pl-4v">
      <input class="fr-input" type="text" placeholder="Ajouter des membres" v-model="tmpAgent.fullName"
             @keyup="createNewMember($event.target.value)"
             @click.stop="showSugestionList"
      >
      <div class="tooltip-add-member d-none" data-scope="member">
        <div class="add-member-content">
          <div class="fr-container--fluid">
            <div class="fr-grid-row">
              <div class="fr-col-7">
                <div class="text-14 text-italic text-left text-muted">Suggestions</div>
              </div>
              <div class="fr-col-5">
                <span class="text-12" @click="addAll">  <i class="ri-add-circle-fill"></i> Tout ajouter</span>
              </div>
            </div>
          </div>
        </div>
        <div class="add-member-content">
          <div class="fr-container--fluid">
            <div class="fr-grid-row suggestionsList" v-for="(suggestion, index) in suggestionsList">
              <div class="fr-col-7">
                <div class="text-14 text-left">
                  {{ suggestion.prenom }} {{ suggestion.nom }}
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
            <span class="text-left text-muted text-14 text-italic fr-mt-2v">Ajouter {{tmpAgent.prenom}} {{tmpAgent.nom}}</span>
            <div class="fr-input-group">
              <select class="fr-select" v-model="tmpAgent.role">
                <option value="Agent de pont">Agent de pont</option>
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
    removeMember(index) {
        this.membres.splice(index, 1)
    },
    addAgent(suggestion = null) {
      const agent = suggestion ? suggestion : {};
      if(!suggestion) {
        agent.nom = this.tmpAgent.fullName.split(' ')[1]
        agent.prenom = this.tmpAgent.fullName.split(' ')[0];
        agent.observations = this.tmpAgent.observations;
        agent.role = this.tmpAgent.role;
        this.tmpAgent = {};
      }
      this.membres.push(agent);

    },
    addAll() {
      this.suggestionsList.forEach(element => this.membres.push(element));
    },
    createNewMember(value) {
      let noExist = true;
      if(value.length > 2) {
        this.suggestionsList.filter(element => {
          if(element.nom.indexOf(value) === 0) {
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
      suggestionsList: [
        {
          id: 45,
          prenom: 'Alain',
          nom: 'Colas',
          role: 'Agent de pont',
          observations: '',
          is_absent: false
        },
        {
          id: 46,
          prenom: 'Francis',
          nom: 'Joyon',
          role: 'Agent de pont',
          observations: '',
          is_absent: false
        },
        {
          id: 47,
          prenom: 'Christophe',
          nom: 'Augin',
          role: 'Agent de pont',
          observations: '',
          is_absent: false
        }
      ],
      tmpAgent: {}
    }
  }
}
</script>

<style scoped>

</style>

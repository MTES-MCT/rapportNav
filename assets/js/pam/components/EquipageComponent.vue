<template>
  <div class="fr-grid-row">
    <div class="fr-col-lg-7 fr-col-md-8">
      <div class="members-list">
        <div class="member-group" v-for="(member, index) in membres" >
          <div class="equipName">
            {{ member.nom }}
            <span class="equipRole">{{ member.role }}</span>
          </div>
          <div class=" tooltip">
            <span class="ri-more-fill more-option-icon "></span>
            <div class="tooltipMember fr-px-2w fr-py-2w">
              <input class="fr-input" type="text" id="memberName"  v-bind:value="member.nom" disabled>

              <select class="fr-select fr-mt-3v" id="select"  v-model="member.role">
                <option value="Agent de pont">Agent de pont</option>
                <option value="Commandant">Commandant</option>
                <option value="4">Option 4</option>
              </select>

              <textarea class="fr-input fr-mt-3v" id="textarea" placeholder="Observations" v-model="member.observations"></textarea>

              <button class="custom-btn fr-fi-checkbox-circle-line fr-btn--icon-left fr-mt-3v remove-equip-btn" @click="removeMember(index)">
                Supprimer le membre
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="fr-col-lg-5 fr-col-md-4 fr-pl-4v">
      <input class="fr-input" type="text" placeholder="Ajouter des membres" v-model="newMember.nom"
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
                  {{ suggestion.nom }}
                  <span class="equipRole">{{suggestion.role}}</span>
                </div>
              </div>
              <div class="fr-col-5">
                <button
                    class="fr-btn--menu fr-btn fr-btn--sm fr-fi-add-circle-fill fr-btn--secondary fr-btn--icon-left"
                    title="Enregistrer"
                    @click="addMember(suggestion)"
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
            <span class="text-left text-muted text-14 text-italic fr-mt-2v">Ajouter {{newMember.name}}</span>
            <div class="fr-input-group">
              <select class="fr-select" v-model="newMember.role">
                <option value="Agent de pont">Agent de pont</option>
              </select>
            </div>
            <div class="fr-input-group">
              <textarea cols="30" rows="5" class="fr-input" v-model="newMember.observations" placeholder="Observations"></textarea>
            </div>

            <button
                class="fr-btn--menu fr-btn fr-btn--sm fr-fi-add-circle-fill fr-btn--secondary fr-btn--icon-left"
                title="Enregistrer"
                @click="addMember(newMember)"
            >Ajouter
            </button>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "EquipageComponent",
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
    addMember(member) {
      this.membres.push(member);
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
          nom: 'Alain Colas',
          role: 'Agent de pont',
          observations: ''
        },
        {
          id: 46,
          nom: 'Francis Joyon',
          role: 'Agent de pont',
          observations: ''
        },
        {
          id: 47,
          nom: 'Christophe Augin',
          role: 'Agent de pont',
          observations: ''
        }
      ],
      newMember: {
        nom: '',
        role: '',
        observations: ''
      }
    }
  }
}
</script>

<style scoped>

</style>
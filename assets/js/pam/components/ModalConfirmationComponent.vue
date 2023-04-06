<template>
  <dialog aria-labelledby="fr-modal-title-modal-200" role="dialog" id="fr-modal-200" class="fr-modal">
    <div class="fr-container fr-container--fluid fr-container-md">
      <div class="fr-grid-row fr-grid-row--center">
        <div class="fr-col-12 fr-col-md-8 fr-col-lg-8">
          <div class="fr-modal__body">
            <div class="fr-modal__header">
              <button class="fr-link--close fr-link" title="Fermer la fenêtre modale" aria-controls="fr-modal-200">Fermer</button>
            </div>
            <div class="fr-modal__content text-center">
              <h5 class="text-normal" v-if="numRapport">Vous êtes sur le point de quitter l'édition du rapport n°{{numRapport}}</h5>
              <h5 class="text-normal" v-else>Vous êtes sur le point de quitter l'édition du rapport</h5>
              <h5 class="">Voulez-vous enregistrer vos modifications ?</h5>
              <div class="">
                <ul class="fr-btns-group fr-btns-group--inline fr-btns-group--center fr-btns-group--icon-left">
                  <li>
                    <a class="fr-link--icon-left fr-fi-close-line fr-text text-bold text-red-error leave-without-save-btn"
                        href="/pam" >Quitter sans enregistrer</a>
                  </li>
                  <li>
                    <button class="fr-btn fr-btn--secondary fr-fi-save-fill space-between" @click="onSaveExit">
                      Enregistrer et quitter
                    </button>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </dialog>
</template>

<script>
export default {
  name: "ModalConfirmationComponent",
  props: {
    saved: Boolean,
    numRapport: String
  },
  methods: {
    onSaveExit() {
      if(!this.saved) {
        this.$emit('draft-exit');
      } else {
        this.$emit('save-exit');
      }

    }
  }
}
</script>

<style scoped>

</style>

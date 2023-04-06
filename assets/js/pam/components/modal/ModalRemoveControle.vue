<template>
  <dialog :aria-labelledby="'fr-modal-title-modal-' + index" role="dialog" :id="'fr-modal-' + index" class="fr-modal">
    <div class="fr-container fr-container--fluid fr-container-md">
      <div class="fr-grid-row fr-grid-row--center">
        <div class="fr-col-12 fr-col-md-8 fr-col-lg-6">
          <div class="fr-modal__body">
            <div class="fr-modal__header">
              <button class="fr-link--close fr-link" title="Fermer la fenêtre modale" :aria-controls="'fr-modal-' + index">Fermer</button>
            </div>
            <div class="fr-modal__content modal-remove-controle">
              <p :id="'fr-modal-title-modal-' + index" class="text-sm text-center text-bold">Voulez-vous vraiment supprimer ce contrôle ?</p>
              <button class="text-center btn-danger" @click="remove()">
                <span class="fr-fi-delete-fill" aria-hidden="true" ></span>
                Supprimer le contrôle
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </dialog>
</template>

<script>
export default {
  name: "ModalRemoveControle",
  props: {
    index: Number

  },
  methods: {
    remove() {
      this.$emit('remove', this.index)
    }
  }
}
</script>

<style scoped>

</style>

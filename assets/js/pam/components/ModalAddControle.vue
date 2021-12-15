<template>
  <dialog aria-labelledby="fr-modal-title-modal-10" role="dialog" id="fr-modal-10" class="fr-modal">
    <div class="fr-container fr-container--fluid fr-container-md">
      <div class="fr-grid-row fr-grid-row--center">
        <div class="fr-col-12 fr-col-md-8">
          <div class="fr-modal__body">
            <div class="fr-modal__header">
            </div>
            <div class="fr-modal__content">
              <h1 id="fr-modal-title-modal-10" class="fr-modal__title">Ajouter un contrôle</h1>
              <div class="fr-container fr-grid-row--gutters fr-mt-5w">
                <div class="row-flex">
                  <div class="add-control-box fr-mr-1v" @click="addComponent('Contrôle en mer de navires de pêche professionnelle', 1)">
                      <span class="add-control-link">
                        <i class="ri-ship-2-fill add-control-icon"></i>
                        Contrôle en mer de navires de pêche professionnelle
                      </span>
                  </div>
                  <div class="add-control-box fr-mr-1v" @click="addComponent('Contrôle en mer de navires de plaisance professionnelle', 2)">
                      <span class="add-control-link  ">
                        <i class="ri-ship-fill add-control-icon"></i>
                        Contrôle en mer de navires de plaisance professionnelle
                      </span>
                  </div>
                  <div class="add-control-box " @click="addComponent('Contrôle en mer des navires de plaisance de loisir', 3)">
                    <span class="add-control-link ">
                      <i class="ri-sailboat-line add-control-icon"></i>
                      Contrôle en mer des navires de plaisance de loisir
                    </span>
                  </div>
                </div>
                <div class="fr-grid-row fr-mt-2w">
                  <div class="fr-col-4 add-control-box"  @click="addComponent(' Contrôle à terre de navires de pêche professionnelle', 4)">
                    <span class="add-control-link">
                      <i class="ri-ship-2-line add-control-icon"></i>
                      Contrôle à terre de navires de pêche professionnelle
                    </span>
                  </div>
                  <div class="fr-col-4 add-control-box fr-ml-1v" @click="addComponent(' Contrôle à terre de navires de pêche professionnelle', 5)">
                    <span class="add-control-link  ">
                      <i class="ri-more-fill add-control-icon"></i>
                      Autre mission
                    </span>
                  </div>
                </div>
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
  name: "ModalAddControle",
  props: {
    id: {
      type: String,
      default: null
    }
  },
  methods: {
    addComponent(label, id) {
      this.$emit('clicked', label, id)
    }
  }
}
</script>

<style scoped>

</style>

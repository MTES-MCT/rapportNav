<template>
  <dialog aria-labelledby="fr-modal-title-modal-controle" role="dialog" id="fr-modal-controle" class="fr-modal" ref="modalAddControle">
    <div class="fr-container fr-container--fluid" >
      <div class="fr-grid-row">
        <div class="fr-col-12 fr-col-md-8 fr-col-lg-8">
          <div class="fr-modal__body">
            <div class="fr-modal__header">
              <button class="fr-link--close fr-link" title="Fermer la fenêtre" aria-controls="fr-modal-controle" ref="linkClose">Fermer</button>
            </div>
            <div class="fr-modal__content">
              <div class="fr-container">
                <h6 id="fr-modal-title-modal-controle">Ajouter un contrôle</h6>
                <div class="row-flex fr-mt-2w">
                  <div class="add-control-box" id="controle_mer_peche_pro" @click="addComponent('Contrôle en mer de navires de pêche professionnelle', 1)">
                    <img
                        class="svg-icon icon-peche-pro"
                        src="../../../../css/svg/ship.svg"
                        alt="navire_peche_professionnel"
                        height="33px"
                        width="51px" />
                    <span class="add-control-link">
                      Contrôle en mer de navires de pêche professionnelle
                    </span>
                  </div>
                  <div class="add-control-box" id="controle_mer_plaisance_pro" @click="addComponent('Contrôle en mer de navires de plaisance professionnelle', 2)">
                    <img
                        class="svg-icon icon-plaisance-pro"
                        src="../../../../css/svg/surface1.svg"
                        alt="navire_plaisance_professionnel"
                        height="25px"
                        width="70px" />
                    <span class="add-control-link  ">
                      Contrôle en mer de navires de plaisance professionnelle
                    </span>
                  </div>

                  <div class="add-control-box" @click="addComponent('Contrôle en mer des navires de plaisance de loisir', 3)">
                    <img
                        class="svg-icon icon-plaisance-loisir"
                        src="../../../../css/svg/Path_121.svg"
                        alt="navire_peche_professionnel"
                        height="37px"
                        width="35px" />
                    <span class="add-control-link  ">
                      Contrôle en mer des navires de plaisance de loisir
                    </span>
                  </div>
                </div>
                <div class="row-flex fr-mt-2w">
                  <div class="add-control-box"  @click="addComponent('Contrôle à terre de navires de pêche professionnelle', 4)">
                    <img
                        class="svg-icon"
                        src="../../../../css/svg/Path_237.svg"
                        alt="navire_peche_professionnel"
                        height="33px"
                        width="91px" />
                    <span class="add-control-link">
                      Contrôle à terre de navires de pêche professionnelle
                    </span>
                  </div>
                  <div class="add-control-box" @click="addComponent('Contrôle à terre de navires de plaisance professionnelle', 7)">
                    <img
                        class="svg-icon icon-plaisance-pro"
                        src="../../../../css/svg/terre_plaisance_professionel.svg"
                        alt="navire_peche_professionnel"
                        height="30px"
                        width="91px" />
                    <span class="add-control-link">
                      Contrôle à terre de navires de plaisance professionnelle
                    </span>
                  </div>
                  <div class="add-control-box" @click="addComponent('Contrôle à terre de navires de plaisance de loisir', 6)">
                    <img
                        class="svg-icon icon-plaisance-pro"
                        src="../../../../css/svg/terre_plaisance_loisir.svg"
                        alt="navire_peche_professionnel"
                        height="30px"
                        width="91px" />
                    <span class="add-control-link">
                      Contrôle à terre de navires de plaisance de loisir
                    </span>
                  </div>
                </div>
                <div class="row-flex fr-mt-2w">
                  <div class="add-control-box" @click="addComponent('Autres missions', 5)">
                    <img
                        class="svg-icon icon-other-mission"
                        src="../../../../css/svg/Path_240.svg"
                        alt="navire_peche_professionnel"
                        height="14px"
                        width="50px" />
                    <span class="add-control-link">
                      Autres missions
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
  mounted() {
  },
  methods: {
    addComponent(nom, id) {
      this.$emit('clicked', nom, id)
      this.$refs.linkClose.click(); // permet de supprimer l'attribut data-fr-scrolling tout en gardant la position actuelle.
    }
  }
}
</script>

<style scoped>

</style>

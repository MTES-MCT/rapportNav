<template>
  <dialog :aria-labelledby="'fr-modal-title-modal-download-' + rapport.id" role="dialog" :id="'fr-modal-download' + rapport.id" class="fr-modal">
    <div class="fr-container fr-container--fluid fr-container-md">
      <div class="fr-grid-row fr-grid-row--center">
        <div class="fr-col-12 fr-col-md-8 fr-col-lg-6">
          <div class="fr-modal__body">
            <div class="fr-modal__header">
              <button class="fr-link--close fr-link" title="Fermer la fenêtre modale" :aria-controls="'fr-modal-download' + rapport.id">Fermer</button>
            </div>
            <div class="fr-modal__content">
              <h1 :id="'fr-modal-title-modal-download-' + rapport.id" class="modal-download-title text-center">
                Télécharger le rapport de patrouille n°{{rapport.id}}
              </h1>
              <div class="date-rapport text-center">
                Dates du rapport : <br>
                <span class="text-bold">Du {{rapport.start_datetime|date('DD/MM/YYYY')}} à {{rapport.start_datetime|date('HH:mm')}}  au {{rapport.end_datetime|date('DD/MM/YYYY')}} à {{rapport.end_datetime|date('HH:mm')}} </span>
              </div>
              <div class="alert-download-danger fr-mt-2w">
                Les <span class="text-bold">contrôles opérationnels</span> et <span class="text-bold">indicateurs de missions</span> renseignés sur la plateforme sont les seules informations valides.
                Merci de ne pas modifier ces chiffres depuis les fichiers word et excel téléchargés
              </div>
              <div class="btn-download">
                <button class="fr-btn fr-mt-4v" v-if="type === 'indicateurs'" @click="exportIndicateurs">
                  <i class="ri-download-2-line fr-mr-2v" aria-hidden="true" />
                  Télécharger les indicateurs de missions (.xlsx)
                </button>
                <div v-else>
                  <button class="fr-btn fr-mt-4v" @click="exportRapport('docx')">
                    <i class="ri-download-2-line fr-mr-2v" aria-hidden="true" />
                    Télécharger le rapport de patrouille (.docx)
                  </button>
                  <button class="fr-btn fr-mt-4v" @click="exportRapport('odt')">
                    <i class="ri-download-2-line fr-mr-2v" aria-hidden="true" />
                    Télécharger le rapport de patrouille (.odt)
                  </button>
                  <button class="fr-btn fr-mt-4v" @click="exportRapport('pdf')">
                    <i class="ri-download-2-line fr-mr-2v" aria-hidden="true" />
                    Télécharger le rapport de patrouille (.pdf)
                  </button>
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
import {sanitizeUrl} from "@braintree/sanitize-url";

export default {
  name: "ModalMsgDownload",
  props: {
    rapport: Object,
    type: String,
    draft: Boolean
  },
  methods: {
    exportIndicateurs() {
      window.location.href = sanitizeUrl('/api/pam/export/indicateurs/' + this.rapport.id + (this.draft ? '?draft' : ''));
    },
    exportRapport(type = 'docx') {
      window.location.href = sanitizeUrl('/api/pam/export/rapport/' + this.rapport.id + '?type=' + type + (this.draft ? '&draft' : '')   );
    }
  }
}
</script>

<style scoped>

</style>

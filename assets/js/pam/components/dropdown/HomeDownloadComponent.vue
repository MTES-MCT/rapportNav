<template>
  <div >
    <button class="fr-btn fr-btn--secondary" @click="hidden = !hidden" ref="downloadDropdown" v-if="rapport.type !== 'brouillon'">
      <i class="ri-download-2-line fr-mr-2v" aria-hidden="true" />
     Télécharger
    </button>
    <div class="navigation-download"   :id="'navigation-' + rapport.id" v-if="!hidden" v-click-outside="hide" >
      <ul>
        <li @click="exportRapport">
          Télécharger le rapport de patrouille (.docx)
        </li>
        <li @click="exportRapport('odt')">
          Télécharger le rapport de patrouille (.odt)
        </li>
        <li @click="exportRapport('pdf')">
          Télécharger le rapport de patrouille (.pdf)
        </li>
        <li @click="exportIndicateurs">
          Télécharger les indicateurs de mission (.xlsx)
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import {sanitizeUrl} from "@braintree/sanitize-url";

export default {
  name: "HomeDownloadComponent",
  props: {
    rapport: Object
  },
  mounted() {
  },
  methods: {
    hide(event) {
      if(!this.$refs.downloadDropdown.contains(event.target)) {
        this.hidden = true;
      }
    },
    exportIndicateurs() {
      window.location.href = sanitizeUrl('/api/pam/export/indicateurs/' + this.rapport.id + (this.rapport.type === 'brouillon' ? '?draft' : ''));
    },
    exportRapport(type = 'docx') {
      window.location.href = sanitizeUrl('/api/pam/export/rapport/' + this.rapport.id + '?type=' + type + (this.rapport.type === 'brouillon' ? '&draft' : ''));
    }
  },
  data() {
    return {
      hidden: true
    }
  }
}
</script>

<style scoped>

</style>

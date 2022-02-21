<template>
  <div>
    <div class="download-link-section">
      <a href="#" aria-controls="fr-modal-download" data-fr-opened="false"><i class="fr-fi-download-line" aria-hidden="true"></i> Télécharger le rapport AEM</a>
    </div>

  <ModalDownloadAEM></ModalDownloadAEM>
  </div>
</template>

<script>
import ModalDownloadAEM from "./modal/ModalDownloadAEM";

export default {
  name: "DownloadAEMComponent",
  components: {ModalDownloadAEM},
  props: {},
  mounted() {
  }
}
</script>

<style scoped>

</style>

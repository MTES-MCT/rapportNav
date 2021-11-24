<template>

  <div class="">
    <div class="history-header">
      <h6>Historique <span class="fr-fi-close-line icon-float-right history-close-icon" aria-hidden="true" v-on:click="removeHistory"></span> </h6>
    </div>
    <div class="history-group">


      <span class="history-date">Aujourd'hui</span>
      <div class="history-body">
        <div class="fr-grid-row">
          <div class="fr-col">
            <span class="history-time">19:12</span>
          </div>
        </div>
        <div class="fr-grid-row">
          <div class="fr-col-2">
            <img src="http://placebeard.it/155/150?26" class="fr-responsive-img" alt="">
          </div>
          <div class="fr-col-8 fr-ml-2v">
            <p class="history-main-content">
              <span class="text-bold">Romain Crampon</span> à réalisé 2 modifications.
              <span class="history-see-more-details">Masquer les détails</span>
            </p>
            <div class="history-details">
              <hr>
              Ajout de "David Vincent" aux membres de l'équipe
            </div>
          </div>
        </div>
      </div>

      <div class="history-body">
        <div class="fr-grid-row">
          <div class="fr-col">
            <span class="history-time">13:12</span>
          </div>
        </div>
        <div class="fr-grid-row">
          <div class="fr-col-2">
            <img src="http://placebeard.it/155/150?26" class="fr-responsive-img" alt="">
          </div>
          <div class="fr-col-8 fr-ml-2v">
            <p class="history-main-content">
              <span class="text-bold">Romain Crampon</span> à réalisé 2 modifications.
              <span class="history-see-more-details">Voir les details</span>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="history-group">
      <span class="history-date">jeudi 16 septembre</span>
      <div class="history-body">
        <div class="fr-grid-row">
          <div class="fr-col">
            <span class="history-time">14:12</span>
          </div>
        </div>
        <div class="fr-grid-row">
          <div class="fr-col-2">
            <img src="http://placebeard.it/155/150?26" class="fr-responsive-img" alt="">
          </div>
          <div class="fr-col-8 fr-ml-2v">
            <p class="history-main-content">
              <span class="text-bold">Romain Crampon</span> à réalisé 2 modifications.
              <span class="history-see-more-details">Masquer les détails</span>
            </p>
            <div class="history-details">
              <hr>
              Ajout de "David Vincent" aux membres de l'équipe
            </div>
          </div>
        </div>
      </div>

      <div class="history-body">
        <div class="fr-grid-row">
          <div class="fr-col">
            <span class="history-time">11:12</span>
          </div>
        </div>
        <div class="fr-grid-row">
          <div class="fr-col-2">
            <img src="http://placebeard.it/155/150?26" class="fr-responsive-img" alt="">
          </div>
          <div class="fr-col-8 fr-ml-2v">
            <p class="history-main-content">
              <span class="text-bold">Romain Crampon</span> à réalisé 2 modifications.
              <span class="history-see-more-details">Voir les details</span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SidebarHistoryRapportComponent",
  methods: {
    removeHistory() {
      $('.sidebar-right-history').addClass('d-none')
    }
  }
}
</script>

<style scoped>

</style>
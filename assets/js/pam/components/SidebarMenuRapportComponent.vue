<template>
  <nav class="fr-ml-14w fr-text--sm fr-mt-n1w">
    <ul class="list-unstyled">
      <div class="fr-grid-row">
        <div class="fr-col-2"><span class="fr-fi-arrow-right-line fr-fi" aria-hidden="true"></span></div>
        <div class="fr-col-10"><li class="nav-list text-icon--left"> Informations générales</li></div>
      </div>
      <div class="fr-grid-row">
        <div class="fr-col-2"></div>
        <div class="fr-col-10"><li class="nav-list"><a href="#shipActivity" v-on:click="setActive($event)">Activités du navire</a></li></div>
      </div>
      <div class="fr-grid-row">
        <div class="fr-col-2"></div>
        <div class="fr-col-10"><li class="nav-list">Contrôles opérationnels</li></div>
      </div>
      <div class="fr-grid-row">
        <div class="fr-col-2"></div>
        <div class="fr-col-10"><li class="nav-list">Indicateurs de missions</li></div>
      </div>

    </ul>
  </nav>
</template>

<script>
export default {
  name: "SidebarMenuRapportComponent",
  methods: {
    setActive(e) {
      console.log(e)
      $(e.target).addClass('active')
    }
  }
}
</script>

<style scoped>

</style>
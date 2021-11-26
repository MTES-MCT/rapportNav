<template>
  <nav class="fr-text--sm content-fixed">
    <ul class="list-unstyled">
      <li class="nav-list nav-item"><a href="#generalInformation" v-on:click="setActive($event)">Informations générales</a></li>
      <li class="nav-list nav-item"><a href="#shipActivity" v-on:click="setActive($event)">Activités du navire</a></li>
      <li class="nav-list nav-item"><a href="#controle" v-on:click="setActive($event)">Contrôles opérationnel</a></li>
     <li class="nav-list nav-item"><a href="#indicateur" v-on:click="setActive($event)">Indicateurs de missions</a></li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "SidebarMenuRapportComponent",
  methods: {
    setActive(e) {
      $('.nav-item a').removeClass('active')
      $(e.target).addClass('active')
    }
  }
}
</script>

<style scoped>

</style>
<template>
  <nav class="fr-text--sm content-fixed sidebar-left-menu">
    <ul class="list-unstyled">
      <li class="nav-list nav-item"><a class="generalInformation active" href="#generalInformation" v-on:click="setActive($event.target)">Informations générales</a></li>
      <li class="nav-list nav-item"><a class="shipActivity" href="#shipActivity" v-on:click="setActive($event.target)">Activités du navire</a></li>
      <li class="nav-list nav-item"><a class="controle" href="#controle" v-on:click="setActive($event.target)">Contrôles opérationnels</a></li>
     <li class="nav-list nav-item"><a class="indicateur" href="#indicateur" v-on:click="setActive($event.target)">Indicateurs de missions</a></li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "SidebarMenuRapportComponent",
  mounted() {
    const hash = window.location.hash.substr(1);
    if(hash) {
      const className = this.$el.querySelector('.' + hash);
      this.setActive(className);
    }

  },
  methods: {
    setActive(target) {
      const currentActiveClass = this.$el.querySelector('.active');
      currentActiveClass.classList.remove('active');
      target.classList.add('active');
    }
  }
}
</script>

<style scoped>

</style>

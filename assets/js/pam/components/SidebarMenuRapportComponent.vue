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
    this.automaticActiveScroll();
  },
  methods: {
    setActive(target) {
      const currentActiveClass = this.$el.querySelector('.active');
      currentActiveClass.classList.remove('active');
      target.classList.add('active');
    },
    automaticActiveScroll() {
      let informationGeneralY = this.getOffset( document.getElementById('generalInformation'));
      let shipActivityY = this.getOffset( document.getElementById('shipActivity'));
      let controleOpY = this.getOffset( document.getElementById('controle'));
      let indicateurY = this.getOffset( document.getElementById('indicateur'));

      window.onscroll = () => {
        if(window.scrollY >= informationGeneralY) {
          this.setActive(this.$el.querySelector('.generalInformation'))
        }
        if(window.scrollY >= shipActivityY) {
          this.setActive(this.$el.querySelector('.shipActivity'))
        }
        if(window.scrollY >= controleOpY) {
          this.setActive(this.$el.querySelector('.controle'))
        }
        if(window.scrollY >= indicateurY) {
          this.setActive(this.$el.querySelector('.indicateur'))
        }
      }
    },
    getOffset( el ) {
      let _y = 0;
      while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
        _y += el.offsetTop - el.scrollTop;
        el = el.offsetParent;
      }
      return (_y - 160); // 160 = margin
    }
  }
}
</script>

<style scoped>

</style>

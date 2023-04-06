<template>
  <div class="my-profile" v-if="me">
    <HeaderHomeComponent name-site="RapportNav" />
    <div class="fr-container my-profile__container">
      <router-link class="back_dashboard__link" to="/pam"><i class="ri ri-arrow-left-s-line fr-mr-2v" aria-hidden="true"></i>Retour au tableau de bord</router-link>
      <div class="fr-grid-row fr-mt-6v">
        <div class="fr-col-lg-4">
          <h2 class="my-profile__heading">Mes informations personnelles</h2>
          <div class="informations-personnelles">
            <div class="informations-personnelles__content" v-if="me.agent">
              <h4>Nom complet</h4>
              <span>{{ me.agent.prenom }} {{ me.agent.nom }}</span>
            </div>
            <div class="informations-personnelles__content">
              <h4>Unité</h4>
              <span>{{ me.service.nom }}</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import HeaderHomeComponent from "../components/HeaderHomeComponent";
import axios from "axios";
export default {
  name: "MyProfileComponent",
  components: {HeaderHomeComponent},
  mounted() {
    this.fetchMe()
  },
  methods: {
    fetchMe() {
      axios.get('/api/profile/me')
          .then((success) => {
            this.me = success.data
          })
          .then((error) => {
            console.log(error)
          })
    }
  },
  data() {
    return {
      me: null
    }
  }
}
</script>

<style scoped>

</style>

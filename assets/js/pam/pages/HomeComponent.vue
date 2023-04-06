<template>
  <div v-if="userMe">
    <HeaderHomeComponent name-site="RapportNav" enable-my-profile></HeaderHomeComponent>
    <div class="fr-container fr-mt-23v">
      <h3 class="home-heading-1">Bonjour <span v-if="userMe.agent">{{ userMe.agent.prenom }}</span></h3>
      <CurrentReportComponent></CurrentReportComponent>
      <MyReportsComponent :me="userMe"></MyReportsComponent>
    </div>
  </div>
</template>

<script>
import MyReportsComponent from "../components/table/MyReportsComponent";
import CurrentReportComponent from "../components/CurrentReportComponent";
import HeaderHomeComponent from "../components/HeaderHomeComponent";
import DownloadAEMComponent from "../components/DownloadAEMComponent";
import axios from "axios";
export default {
  name: "HomeComponent",
  components: {DownloadAEMComponent, HeaderHomeComponent, CurrentReportComponent, MyReportsComponent},
  mounted() {
    this.fetchMe();
  },
  methods: {
    fetchMe() {
      axios.get('/api/profile/me')
          .then((success) => {
            this.userMe = success.data
          })
          .catch((error) => {
            console.log(error)
          })
    }
  },
  data() {
    return {
      userMe: null
    }
  }
}
</script>

<style scoped>

</style>

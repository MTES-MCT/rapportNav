<template>
<div class="currentReport">
  <h5>Mon rapport en cours</h5>

  <div class="body">
    <div class="fr-container">
      <div class="fr-grid-row" v-if="numRapport">
        <div class="fr-col-lg-1">
          <span class="fr-fi-file-fill fr-fi--lg icon-current-report" aria-hidden="true"></span>
        </div>
        <div class="fr-col-lg-3">
          <h6> Rapport n° {{ numRapport }}</h6>
        </div>
        <div class="fr-col-lg-2">
          <span class="text-14">Date de début</span> <br>
          <span>{{ startDateTime }}</span>
        </div>
        <div class="fr-col-lg-2">
          <span class="text-14">Date de fin</span> <br>
          <span>{{ endDateTime }}</span>
        </div>
        <div class="fr-col-lg-2">
          <span class="text-14">Commandant</span> <br>
          <span>Aleck Vincent </span>
        </div>
        <div class="fr-col-lg-2 edit-btn">
          <button class="fr-btn" @click="editRapport">Editer</button>
        </div>
      </div>
      <AlertComponent message="Vous n'avez pas encore rempli de rapport." title="Aucun rapport" type="info" v-else></AlertComponent>
    </div>
  </div>
</div>
</template>

<script>
import axios from "axios";
import AlertComponent from "./alert/AlertComponent";
export default {
  name: "CurrentReportComponent",
  components: {AlertComponent},
  mounted() {
    axios.get('/api/pam/rapport/last/draft')
    .then((success) => {
      const body = JSON.parse(success.data.body)
      this.startDateTime = body.start_datetime;
      this.endDateTime = body.end_datetime;
      this.numRapport = success.data.number;
      this.id = success.data.id;
      console.log(success.data)
    })
    .then(error => console.log(error))
  },
  methods: {
    editRapport() {
      this.$router.push({
        name: 'rapport',
        query: { id: this.id, draft: true }
      })
    }
  },
  data() {
    return {
      startDateTime: null,
      endDateTime: "--/--/----",
      numRapport: null,
      id: null
    }
  }
}
</script>

<style scoped>
</style>

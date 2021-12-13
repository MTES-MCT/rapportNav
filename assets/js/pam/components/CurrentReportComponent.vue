<template>
<div class="currentReport">
  <h5>Mon rapport en cours</h5>

  <div class="body">
    <div class="fr-container">
      <div class="fr-grid-row">
        <div class="fr-col-lg-1">
          <span class="fr-fi-file-fill fr-fi--lg icon-current-report" aria-hidden="true"></span>
        </div>
        <div class="fr-col-lg-4">
          <h6> Rapport n° {{ numRapport }}</h6>
        </div>
        <div class="fr-col-lg-2">
          <span class="text-14">Date de début</span> <br>
          <span>{{ startDate }}</span>
        </div>
        <div class="fr-col-lg-2">
          <span class="text-14">Date de fin</span> <br>
          <span>{{ endDate }}</span>
        </div>
        <div class="fr-col-lg-2">
          <span class="text-14">Commandant</span> <br>
          <span>Aleck Vincent </span>
        </div>
        <div class="fr-col-lg-2 edit-btn">
          <a href=""></a>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import axios from "axios";
export default {
  name: "CurrentReportComponent",
  mounted() {
    axios.get('/api/pam/rapport/last/draft')
    .then((success) => {
      const body = JSON.parse(success.data.body)
      this.startDate = body.start_date;
      this.endDate = body.end_date;
      this.numRapport = success.data.number
      console.log(success.data)
    })
    .then(error => console.log(error))
  },
  methods: {},
  data() {
    return {
      startDate: null,
      endDate: "--/--/----",
      numRapport: null
    }
  }
}
</script>

<style scoped>
</style>

<template>
<div class="currentReport" v-if="numRapport">
  <h5>Mon rapport en cours</h5>

  <div class="body">
    <div class="fr-container">
      <div class="fr-grid-row" >
        <div class="fr-col-lg-1">
          <span class="fr-fi-file-fill fr-fi--lg icon-current-report" aria-hidden="true"></span>
        </div>
        <div class="fr-col-lg-3">
          <h6> Rapport n° {{ numRapport }}</h6>
        </div>
        <div class="fr-col-lg-2">
          <span class="text-14">Date de début</span> <br>
          <span>{{ startDateTime|date }}</span>
        </div>
        <div class="fr-col-lg-2">
          <span class="text-14">Date de fin</span> <br>
          <span>{{ endDateTime|date }}</span>
        </div>
        <div class="fr-col-lg-2">
          <span class="text-14">Commandant</span> <br>
          <span>{{ created_by.nom }} </span>
        </div>
        <div class="fr-col-lg-2 edit-btn">
          <button class="fr-btn" @click="editRapport">Editer</button>
        </div>
      </div>
    </div>
  </div>
</div>
  <AlertComponent message="Vous n'avez aucun rapport en cours d'édition" title="Aucun rapport" type="info" v-else></AlertComponent>
</template>

<script>
import axios from "axios";
import AlertComponent from "./alert/AlertComponent";
import moment from "moment";
export default {
  name: "CurrentReportComponent",
  components: {AlertComponent},
  mounted() {
    axios.get('/api/pam/rapport/last/draft')
    .then((success) => {
      if(success.data) {
        const body = JSON.parse(success.data.body)
        this.startDateTime = body.start_datetime;
        this.endDateTime = body.end_datetime;
        this.numRapport = success.data.number;
        this.created_by = success.data.created_by
        this.id = success.data.id;

      }
    })
    .catch(error => console.log(error))
  },
  methods: {
    editRapport() {
      this.$router.push({
        name: 'rapport',
        query: { id: this.numRapport, draft: true }
      })
    }
  },
  data() {
    return {
      startDateTime: null,
      endDateTime: null,
      numRapport: null,
      id: null,
      created_by: null
    }
  },
  filters: {
    date(date) {
      if(date) {
        return moment(date).format('D/MM/Y');
      }
      return "--/--/----";

    }
  }
}
</script>

<style scoped>
</style>

<template>
  <div class="myReports">
    <AlertComponent title="Aucun rapport" message="Vous n'avez pas encore rempli de rapport." v-if="!rapports" />

    <div class="rapport-list">
      <div class="rapport-list-header fr-grid-row">
        <div class="fr-col-lg-2">
          <h5>Mes Rapports</h5>
        </div>
        <div class="fr-col-lg-3 rapport-list-btn-create">
          <button
              class="fr-btn--menu fr-btn fr-fi-add-circle-fill fr-btn--icon-left mr-2"
              title="Créer un rapport"
              @click="create">
            Créer un rapport
          </button>
        </div>

      </div>
      <div class="fr-grid-row rapport-list-title">
        <div class="fr-col-lg-1"></div>
        <div class="fr-col-lg-4"></div>
        <div class="fr-col-lg-2 rapport-list-date">
          Date de début
        </div>
        <div class="fr-col-lg-2 rapport-list-statut">
          Statut
        </div>
      </div>
      <div class="rapport-item fr-grid-row" v-for="rapport in rapports" :key="rapport.id">
        <div class="fr-col-lg-1">
          <span class="fr-fi-file-fill fr-fi--lg icon-rapport" aria-hidden="true"></span>
        </div>
        <div class="fr-col-lg-4">
          <h6 class="rapport-item-title"> Rapport n° {{ rapport.id }}</h6>
        </div>
        <div class="fr-col-lg-2">
          <span class="rapport-item-date">{{ rapport.start_datetime|date }}</span>
        </div>
        <div class="fr-col-lg-2">
          <span v-if="rapport.type === 'brouillon'" class="icon-type-brouillon">
            <i class="ri-pencil-fill" aria-hidden="true" />
            {{ rapport.type }}
          </span>
          <span v-if="rapport.type === 'validé'" class="icon-type-valide">
            <i class="ri-check-fill" aria-hidden="true" />
            {{ rapport.type }}
          </span>
        </div>
        <div class="fr-col-lg-3 action-btn">
          <button class="fr-btn edit-btn" @click="edit(rapport)">
            <i class="ri-pencil-line fr-mr-2v" aria-hidden="true" />
            Editer
          </button>
          <HomeDownloadComponent :rapport="rapport"></HomeDownloadComponent>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AlertComponent from "../alert/AlertComponent";
import axios from "axios";
import {sanitizeUrl} from "@braintree/sanitize-url";
import HomeDownloadComponent from "../dropdown/HomeDownloadComponent";
export default {
  name: "MyReportsComponent",
  components: {HomeDownloadComponent, AlertComponent},
  mounted() {
    this.fetchRapports();
  },
  methods: {
    fetchRapports() {
      axios.get('/api/pam/rapport')
      .then((success) => {
        this.rapports = success.data
      })
    },
    edit(rapport) {
      if(rapport.type === 'brouillon') {
        this.$router.push({
          name: 'rapport',
          query: { id: rapport.id, draft: true }
        })
      } else {
        this.$router.push({
          name: 'rapport',
          query: { id: rapport.id }
        })
      }
    },
    create() {
      this.$router.push({
        name: 'rapport'
      })
    }
  },
  data() {
    return {
      rapports: []
    }
  }
}
</script>

<style scoped lang="css">

</style>

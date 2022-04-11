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

      <div id="search" class="fr-grid-row fr-grid-row--gutters fr-mb-2v fr-mt-4v">
        <div class="fr-col-md-5">
          <div class="fr-search-bar--md" id="header-search" role="search">
            <input class="fr-input" placeholder="Rechercher" type="search" id="search-784-input" name="search-784-input">
          </div>
        </div>
        <div class="fr-col-md-7">
          <div class="fr-grid-row fr-grid-row--gutters">
            <div class="fr-col-md-4">
              <div class="fr-select-group">
                <select class="fr-select" @change="onChangeStatut($event)">
                  <option value="" selected disabled hidden>Statut : Tous</option>
                  <option value="brouillon">Brouillon</option>
                  <option value="valide">Validé</option>
                  <option value="all">Tous</option>
                </select>
              </div>
            </div>

            <div class="fr-col-md-4">
              <div class="fr-select-group">
                <select class="fr-select" @change="onChangePeriode($event)">
                  <option value="" selected disabled hidden>Période : Mois en cours</option>
                  <option value="current">Mois en cours</option>
                  <option value="6months">6 derniers mois</option>
                  <option value="annee_2021">Année 2021</option>
                  <option value="annee_2022">Année 2022</option>
                </select>
              </div>
            </div>

            <div class="fr-col-md-4">
              <div class="fr-select-group">
                <select class="fr-select" @change="onChangeBordee($event)">
                  <option value="" selected disabled hidden>Equipe : Mon équipe</option>
                  <option value="mine">Mon équipe</option>
                  <option value="all">Toute les bordée de mon patrouilleur</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>

      <DownloadAEMComponent />

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
import DownloadAEMComponent from "../DownloadAEMComponent";
import HomeDownloadComponent from "../dropdown/HomeDownloadComponent";
export default {
  name: "MyReportsComponent",
  components: {HomeDownloadComponent, AlertComponent, DownloadAEMComponent},
  mounted() {
    console.log(window.location)
    this.fetchRapports();
  },
  methods: {
    fetchRapports() {
      axios.get('/api/pam/rapport')
      .then((success) => {
        let results = []
        success.data.forEach((element) => {
          if(element.type === 'validé') {
            results.push(element);
          } else {
            let brouillon = JSON.parse(element.body);
            brouillon.id = element.number;
            brouillon.type = element.type;
            results.push(brouillon);
          }

        })
        this.rapports = results;
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
    },
    onChangeStatut(event) {
      this.uriSearch.searchParams.delete('statut');
      if(event.target.value !== 'all') {
        this.uriSearch.searchParams.append('statut', event.target.value);
      }
      this.fetchFiltre();
    },
    onChangePeriode(event) {
      this.uriSearch.searchParams.delete('periode');
      this.uriSearch.searchParams.append('periode', event.target.value);
      this.fetchFiltre();
    },
    onChangeBordee(event) {
      this.uriSearch.searchParams.delete('bordee');
      this.uriSearch.searchParams.append('bordee', event.target.value);

      this.fetchFiltre();

    },
    fetchFiltre() {
      axios.get(this.uriSearch.toString())
          .then((success) => {
            let results = success.data;
            let rapports = [];
            results.map((result) => {
              if(result.type === 'brouillon') {
                let brouillon = JSON.parse(result.body);
                brouillon.id = result.number;
                brouillon.type = result.type;
                rapports.push(brouillon);
              } else {
                rapports.push(result);
              }
            });
            this.rapports = rapports;
          })
          .catch((error) => {
            console.log(error)
          })
    }
  },
  data() {
    return {
      rapports: [],
      uriSearch: new URL('/api/pam/rapport/filtre', window.location.origin)
    }
  }
}
</script>

<style scoped lang="css">

</style>

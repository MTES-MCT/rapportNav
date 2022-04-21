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
                <select class="fr-select" @change="onChangePeriode($event)" v-model="periodeSelect">
                  <option value="" selected disabled hidden>Période : Mois en cours</option>
                  <option value="mois" disabled v-if="periodeSelect === 'mois'">{{selectedMonth|date('MMMM YYYY') }}</option>
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
                  <option value="all">Toutes les bordées de ce patrouilleur</option>
                  <div>toto</div>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="download-link-section">
        <div class="filter-month" v-if="periodeSelect === 'current'">
          <div class="previous-month" @click="goToPreviousMonth">
            <i class="ri-arrow-left-s-line" aria-hidden="true"></i>
          </div>
          <div class="selected-month">{{ currentMonth|date('MMMM YYYY') }}</div>
          <div class="next-month" @click="goToNextMonth">
            <i class="ri-arrow-right-s-line" aria-hidden="true"></i>
          </div>
        </div>

        <div class="filter-month" v-if="periodeSelect === '6months'">
          <div class="previous-month">
            <i class="ri-arrow-left-s-line arrow-disabled" aria-hidden="true"></i>
          </div>
          <div class="selected-month">{{ sixPreviousMonthStart|date('MMMM YYYY') }} - {{ currentMonth|date('MMMM YYYY') }}</div>
          <div class="next-month">
            <i class="ri-arrow-right-s-line arrow-disabled" aria-hidden="true"></i>
          </div>
        </div>

        <div class="filter-month" v-else-if="containsAnnee">
          <div class="previous-month" @click="goToPreviousYear">
            <i class="ri-arrow-left-s-line" aria-hidden="true"></i>
          </div>
          <div class="selected-month">Année {{periodeSelect|formatAnnee}}</div>
          <div class="next-month" @click="goToNextYear">
            <i class="ri-arrow-right-s-line" aria-hidden="true"></i>
          </div>
        </div>

        <div class="filter-month" v-else-if="periodeSelect === 'mois'">
          <div class="previous-month" @click="goToPreviousMonth">
            <i class="ri-arrow-left-s-line" aria-hidden="true"></i>
          </div>
          <div class="selected-month">{{selectedMonth|date('MMMM YYYY')}}</div>
          <div class="next-month" @click="goToNextMonth">
            <i class="ri-arrow-right-s-line" aria-hidden="true"></i>
          </div>
        </div>
        <!--<a href="#" aria-controls="fr-modal-download" data-fr-opened="false"><i class="fr-fi-download-line" aria-hidden="true"></i> Télécharger le rapport AEM</a>-->

      </div>

     <!-- <DownloadAEMComponent />-->

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
import moment from "moment";
export default {
  name: "MyReportsComponent",
  components: {HomeDownloadComponent, AlertComponent, DownloadAEMComponent},
  mounted() {
    this.fetchFiltre();
    let currentDate = new Date();
    currentDate.setMonth(currentDate.getMonth() - 6);
    this.sixPreviousMonthStart = moment(currentDate).format('MMMM YYYY');
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
      this.selectedMonth = this.periodeSelect === 'current' ? this.currentMonth : this.selectedMonth;
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
    },
    goToPreviousMonth() {
      let date = this.selectedMonth ? this.selectedMonth : new Date(this.currentMonth.toLocaleDateString('en'));
      date.setMonth(date.getMonth());
      date = new Date(date.getFullYear(), (date.getMonth()), 0);
      this.selectedMonth = date;

      this.periodeSelect = 'mois';
      this.uriSearch.searchParams.delete('periode');
      this.uriSearch.searchParams.delete('date');
      this.uriSearch.searchParams.append('periode', 'mois');
      this.uriSearch.searchParams.append('date', moment(date).format('YYYY-MM-DD'));
      this.fetchFiltre()
    },
    goToNextMonth() {
      let date =  this.selectedMonth ? this.selectedMonth : new Date(this.currentMonth.toLocaleDateString('en'));

      date.setMonth(date.getMonth());
      date = new Date(date.getFullYear(), (date.getMonth()+2), 0);
      this.selectedMonth = date;
      this.periodeSelect = 'mois';
      this.uriSearch.searchParams.delete('periode');
      this.uriSearch.searchParams.delete('date');
      this.uriSearch.searchParams.append('periode', 'mois');
      this.uriSearch.searchParams.append('date', moment(date).format('YYYY-MM-DD'));
      this.fetchFiltre()
    },
    goToNextYear() {
      let annee = parseInt(this.splitAnnee(this.periodeSelect))
      let nextYear = 'annee_' + (annee + 1);
      this.periodeSelect = nextYear;
      this.uriSearch.searchParams.delete('periode');
      this.uriSearch.searchParams.append('periode', nextYear);
      this.fetchFiltre();
    },
    goToPreviousYear() {
      let annee = parseInt(this.splitAnnee(this.periodeSelect))
      let previousYear = 'annee_' + (annee - 1);
      this.periodeSelect = previousYear;
      this.uriSearch.searchParams.delete('periode');
      this.uriSearch.searchParams.append('periode', previousYear);
      this.fetchFiltre();
    },
    splitAnnee(str) {
      let annee = str.split('annee_');
      return annee[1];
    }
  },
  data() {
    return {
      rapports: [],
      uriSearch: new URL('/api/pam/rapport/filtre', window.location.origin),
      currentDate: new Date(),
      moisSelect: 'current',
      currentMonth: new Date(),
      sixPreviousMonthStart: null,
      periodeSelect: 'current',
      selectedMonth: null
    }
  },
  computed: {
    containsAnnee() {
      return this.periodeSelect.includes('annee_');
    }
  },
  filters: {
    formatAnnee: function(string) {
      let annee = string.split('annee_');
      return annee[1];
    }
  }
}
</script>

<style scoped lang="css">

</style>

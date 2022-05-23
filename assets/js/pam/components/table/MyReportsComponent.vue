<template>
  <div class="myReports" v-if="userMe">
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

        <div id="search" class="fr-mb-2v fr-mt-4v">
          <div class="reset-filter fr-mb-2v">
            <a href="#" @click.prevent="resetFilter"><i class="fr-fi-refresh-fill" aria-hidden="true"></i> Réinitialiser tous les filtres</a>
          </div>
          <div class="dropdowns-search">
            <div class="dropdown-select fr-mr-2v" ref="dropdownStatut">
              <button class="fr-btn fr-btn--secondary dropdown-selected fr-fi-arrow-down-s-line fr-btn--icon-right" @click="statutHidden = !statutHidden" data-toggle="select-statut">
                Statut: {{ selectedStatut }}
              </button>
              <div class="selection" data-select-toggle="select-statut" v-if="!statutHidden" v-click-outside="hideDropdown">
                <ul>
                  <li data-value="brouillon" @click="onChangeStatut($event)">Brouillon</li>
                  <li data-value="valide" @click="onChangeStatut($event)">Validé</li>
                  <li data-value="all" @click="onChangeStatut($event)">Tout</li>
                </ul>
              </div>
            </div>
            <div class="dropdown-select fr-mr-2v" ref="dropdownPeriode">
              <button class="fr-btn fr-btn--secondary dropdown-selected fr-fi-arrow-down-s-line fr-btn--icon-right" @click="periodeHidden = !periodeHidden" data-toggle="select-periode" v-if="!dateRangeEnabled">
                Période: {{ selectedPeriode }}
              </button>
              <button class="fr-btn fr-btn--secondary dropdown-selected" @click="periodeHidden = !periodeHidden" data-toggle="select-periode" v-else>
                Période: {{ startDate|date('MMMM YYYY') }} - {{ endDate|date('MMMM YYYY') }}
              </button>
              <div class="selection" data-select-toggle="select-periode" v-if="!periodeHidden" v-click-outside="hideDropdown">
                <ul>
                  <li data-value="current" @click="onChangePeriode($event)">Mois en cours</li>
                  <li data-value="6months" @click="onChangePeriode($event)">6 derniers mois</li>
                  <li data-value="annee_2021" @click="onChangePeriode($event)">Année 2021</li>
                  <li data-value="annee_2022" @click="onChangePeriode($event)">Année 2022</li>
                </ul>
                <div class="selection-date">
                  <label class="fr-label fr-mb-2v">De</label>
                  <div class="fr-grid-row fr-grid-row--gutters">
                    <div class="fr-col-md-6">
                      <select class="fr-select" id="select"  v-model="filtrePeriodeMonthStart" @change="onChangeDateRange">
                        <option value="" disabled selected hidden>- mois -</option>
                        <option value="01-01">Janvier</option>
                        <option value="02-01">Février</option>
                        <option value="03-01">Mars</option>
                        <option value="04-01">Avril</option>
                        <option value="05-01">Mai</option>
                        <option value="06-01">Juin</option>
                        <option value="07-01">Juillet</option>
                        <option value="08-01">Août</option>
                        <option value="09-01">Septembre</option>
                        <option value="10-01">Octobre</option>
                        <option value="11-01">Novembre</option>
                        <option value="12-01">Décembre</option>
                      </select>
                    </div>
                    <div class="fr-col-md-6">
                      <select class="fr-select" id="select" v-model="filtrePeriodeYearStart" @change="onChangeDateRange">
                        <option v-for="year in years" :value="year">{{ year }}</option>
                      </select>
                    </div>
                  </div>

                  <label class="fr-label fr-mt-4v fr-mb-2v">à</label>
                  <div class="fr-grid-row fr-grid-row--gutters">
                    <div class="fr-col-md-6">
                      <select class="fr-select" id="select"  v-model="filtrePeriodeMonthEnd" @change="onChangeDateRange">
                        <option value="" disabled selected hidden>- mois -</option>
                        <option value="01-01">Janvier</option>
                        <option value="02-01">Février</option>
                        <option value="03-01">Mars</option>
                        <option value="04-01">Avril</option>
                        <option value="05-01">Mai</option>
                        <option value="06-01">Juin</option>
                        <option value="07-01">Juillet</option>
                        <option value="08-01">Août</option>
                        <option value="09-01">Septembre</option>
                        <option value="10-01">Octobre</option>
                        <option value="11-01">Novembre</option>
                        <option value="12-01">Décembre</option>
                      </select>
                    </div>
                    <div class="fr-col-md-6">
                      <select class="fr-select" id="select" v-model="filtrePeriodeYearEnd" @change="onChangeDateRange">
                        <option v-for="year in years" :value="year">{{ year }}</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="dropdown-select" ref="dropdownBordee">
              <button class="fr-btn fr-btn--secondary dropdown-selected fr-fi-arrow-down-s-line fr-btn--icon-right" @click="bordeeHidden = !bordeeHidden" data-toggle="select-bordee">
                Bordée: {{ selectedBordee }}
              </button>
              <div class="selection" data-select-toggle="select-bordee" v-if="!bordeeHidden" v-click-outside="hideDropdown">
                <ul>
                  <li data-value="mine" @click="onChangeBordee($event)">Ma bordée</li>
                  <li data-value="all" @click="onChangeBordee($event)">Toutes les bordées de ce patrouilleur</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    </div>

      <div class="download-link-section">
        <a href="#" aria-controls="fr-modal-download" data-fr-opened="false"><i class="fr-fi-download-line" aria-hidden="true" ></i> Télécharger le rapport AEM</a>

        <div class="filter-month" v-if="periodeSelect === 'current' && !dateRangeEnabled">
          <div class="previous-month" @click="goToPreviousMonth">
            <i class="ri-arrow-left-s-line" aria-hidden="true"></i>
          </div>
          <div class="selected-month">
            {{ currentMonth|date('MMMM') }}
            <select  class="select-year" @change="selectYear" v-model="selectedYear">
              <option :value="currentMonth|date('YYYY')">{{ currentMonth|date('YYYY') }}</option>
              <option :value="year" v-for="(year, index) in years" :key="index" v-if="year !== currentYear">{{year}}</option>
            </select>
          </div>
          <div class="next-month" @click="goToNextMonth">
            <i class="ri-arrow-right-s-line" aria-hidden="true"></i>
          </div>
        </div>

        <div class="filter-month" v-if="periodeSelect === '6months' && !dateRangeEnabled">
          <div class="previous-month">
            <i class="ri-arrow-left-s-line arrow-disabled" aria-hidden="true"></i>
          </div>
          <div class="selected-month">{{ sixPreviousMonthStart|date('MMMM YYYY') }} - {{ currentMonth|date('MMMM YYYY') }}</div>
          <div class="next-month">
            <i class="ri-arrow-right-s-line arrow-disabled" aria-hidden="true"></i>
          </div>
        </div>

        <div class="filter-month" v-else-if="dateRangeEnabled">
          <div class="previous-month">
            <i class="ri-arrow-left-s-line arrow-disabled" aria-hidden="true"></i>
          </div>
          <div class="selected-month">{{ startDate|date('MMMM YYYY') }} - {{ endDate|date('MMMM YYYY') }}</div>
          <div class="next-month">
            <i class="ri-arrow-right-s-line arrow-disabled" aria-hidden="true"></i>
          </div>
        </div>

        <div class="filter-month" v-else-if="containsAnnee">
          <div class="previous-month" @click="goToPreviousYear">
            <i class="ri-arrow-left-s-line" aria-hidden="true"></i>
          </div>
          <div class="selected-month">
            Année {{periodeSelect|formatAnnee}}</div>
          <div class="next-month" @click="goToNextYear">
            <i class="ri-arrow-right-s-line" aria-hidden="true"></i>
          </div>
        </div>

        <div class="filter-month" v-else-if="periodeSelect === 'mois'">
          <div class="previous-month" @click="goToPreviousMonth">
            <i class="ri-arrow-left-s-line" aria-hidden="true"></i>
          </div>
          <div class="selected-month">
            {{selectedMonth|date('MMMM')}}
            <select  class="select-year" @change="selectYear" v-model="selectedYear">
              <option :value="currentMonth|date('YYYY')">{{ currentMonth|date('YYYY') }}</option>
              <option :value="year" v-for="(year, index) in years" :key="index" v-if="year !== currentYear">{{year}}</option>
            </select>
          </div>
          <div class="next-month" @click="goToNextMonth">
            <i class="ri-arrow-right-s-line" aria-hidden="true"></i>
          </div>
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
          <button class="fr-btn edit-btn" @click="edit(rapport)" v-if="rapport.created_by && (userMe.service.id === rapport.created_by.id)">
            <i class="ri-pencil-line fr-mr-2v" aria-hidden="true" />
            Editer
          </button>
          <button class="fr-btn edit-btn" @click="edit(rapport)" v-else>
            <i class="ri-eye-fill fr-mr-2v" aria-hidden="true" />
            Voir
          </button>
          <HomeDownloadComponent :rapport="rapport"></HomeDownloadComponent>
        </div>
      </div>
    <ModalDownloadAEM :start-date="startDate" :end-date="endDate"/>
  </div>
</template>

<script>
import AlertComponent from "../alert/AlertComponent";
import axios from "axios";
import DownloadAEMComponent from "../DownloadAEMComponent";
import HomeDownloadComponent from "../dropdown/HomeDownloadComponent";
import moment from "moment";
import ModalDownloadAEM from "../modal/ModalDownloadAEM";
export default {
  name: "MyReportsComponent",
  components: {ModalDownloadAEM, HomeDownloadComponent, AlertComponent, DownloadAEMComponent},
  props: {
    me: Object
  },
  mounted() {
    let date = new Date();
    this.fetchFiltre();
    let currentDate = new Date();
    currentDate.setMonth(currentDate.getMonth() - 6);
    this.sixPreviousMonthStart = currentDate;
    this.currentYear = moment(date).format('YYYY');
    this.selectedYear = moment(date).format('YYYY')
    this.fetchYearsRange();
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
            brouillon.created_by = element.created_by
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
      this.statutHidden = true;
      this.uriSearch.searchParams.delete('statut');
      this.selectedStatut = event.target.textContent;
      if(event.target.dataset.value !== 'all') {
        this.uriSearch.searchParams.append('statut', event.target.dataset.value);
      }
      this.fetchFiltre();
    },
    onChangePeriode(event) {
      this.periodeHidden = true;
      this.selectedPeriode = event.target.textContent;
      this.periodeSelect = event.target.dataset.value;
      this.selectedMonth = this.periodeSelect === 'current' ? this.currentMonth : this.selectedMonth;
      this.uriSearch.searchParams.delete('periode');
      this.uriSearch.searchParams.append('periode', event.target.dataset.value);
      this.fetchFiltre();
      if(this.periodeSelect === '6months') {
        this.startDate = moment(this.sixPreviousMonthStart).format('YYYY-MM-DD');
        this.endDate = moment(this.currentMonth).format('YYYY-MM-DD');
      }
      this.prepapreDownloadAEM()
    },
    onChangeBordee(event) {
      this.bordeeHidden = true;
      this.selectedBordee = event.target.textContent;
      this.uriSearch.searchParams.delete('bordee');
      this.uriSearch.searchParams.append('bordee', event.target.dataset.value);
      this.fetchFiltre();
    },
    onChangeDateRange() {
      if(this.filtrePeriodeMonthStart && this.filtrePeriodeMonthEnd) {
        const startDate = moment(this.filtrePeriodeYearStart + '-' + this.filtrePeriodeMonthStart).format('YYYY-MM-DD');
        const endDate = moment(this.filtrePeriodeYearEnd + '-' + this.filtrePeriodeMonthEnd).format('YYYY-MM-DD');
        this.startDate = startDate;
        this.endDate = endDate;
        this.dateRangeEnabled = true;
        this.periodeSelect = 'range';
        this.uriSearch.searchParams.delete('periode');
        this.uriSearch.searchParams.delete('date');
        this.uriSearch.searchParams.delete('startRange');
        this.uriSearch.searchParams.delete('endRange');
        this.uriSearch.searchParams.append('startRange', moment(startDate).format('YYYY-MM-DD'));
        this.uriSearch.searchParams.append('endRange', moment(endDate).format('YYYY-MM-DD'));
        this.fetchFiltre();
      }
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
      this.startDate = moment(date).format('YYYY-MM-DD');
      this.endDate = moment(date).format('YYYY-MM-DD');
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
      this.startDate = moment(date).format('YYYY-MM-DD');
      this.endDate = moment(date).format('YYYY-MM-DD');
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
      this.startDate = (annee+1) + '-01-01';
      this.endDate = (annee+2) + '-01-01';
      this.periodeSelect = nextYear;
      this.uriSearch.searchParams.delete('periode');
      this.uriSearch.searchParams.append('periode', nextYear);
      this.fetchFiltre();
    },
    goToPreviousYear() {
      let annee = parseInt(this.splitAnnee(this.periodeSelect))
      let previousYear = 'annee_' + (annee - 1);
      this.startDate = (annee-1) + '-01-01';
      this.endDate = annee + '-01-01';
      this.periodeSelect = previousYear;
      this.uriSearch.searchParams.delete('periode');
      this.uriSearch.searchParams.append('periode', previousYear);
      this.fetchFiltre();
    },
    splitAnnee(str) {
      let annee = str.split('annee_');
      return annee[1];
    },
    fetchYearsRange() {
      axios.get('/api/pam/helper/years/rapport')
          .then((response) => {
            this.years = response.data;
          })
          .catch((error) => {
            console.log(error);
          })
    },
    resetFilter() {
      this.uriSearch.searchParams.delete('statut');
      this.uriSearch.searchParams.delete('bordee');
      this.uriSearch.searchParams.delete('periode');
      this.uriSearch.searchParams.delete('date');
      this.periodeSelect = 'current';
      this.selectedPeriode = 'Mois en cours';
      this.selectedBordee = 'Ma bordée';
      this.selectedStatut = 'Tout';
      this.dateRangeEnabled = false;
      this.startDate = moment(new Date()).format('YYYY-MM-DD');
      this.endDate = moment(new Date()).format('YYYY-MM-DD');
      this.filtrePeriodeMonthStart = '';
      this.filtrePeriodeMonthEnd = '';
      this.fetchFiltre();
    },
    prepapreDownloadAEM() {
      if(this.dateRangeEnabled) {
        this.startDate = moment(this.filtrePeriodeMonthStart + '-' + this.filtrePeriodeYearStart).format('YYYY-MM-DD');
        this.endDate = moment(this.filtrePeriodeMonthEnd + '-' + this.filtrePeriodeYearEnd).format('YYYY-MM-DD');
        return true;
      }

      if(this.periodeSelect === '6months') {
        let mois = parseInt(moment(this.currentMonth).format('MM'));
        if(mois <= 9) {
          mois = '0' + (mois+1)
        } else {
          mois = (mois+1);
        }
        this.startDate = moment(this.sixPreviousMonthStart).format('YYYY-MM') + '-01';
        this.endDate = moment(this.currentMonth).format('YYYY') + '-' + mois + '-01';
        return true;
      }

      if(this.containsAnnee) {
        let annee = this.$options.filters.formatAnnee(this.periodeSelect);
        const startDate = annee + '-01-01';
        const endDate = annee + '-12-31';
        this.startDate = startDate;
        this.endDate = endDate;
        return true;
      }

      if(this.periodeSelect === 'mois') {
        let mois = parseInt(moment(this.selectedMonth).format('MM'));
        if(mois <= 9) {
          mois = '0' + (mois+1)
        } else {
          mois = (mois+1);
        }
        this.startDate = moment(this.selectedMonth).format('YYYY') + '-' + mois + '-01';
        this.endDate = moment(this.selectedMonth).format('YYYY-MM') + '-01';
        return true;
      }
    },
    hideDropdown(event) {
      if(!this.$refs.dropdownStatut.contains(event.target) && !this.statutHidden) {
        this.statutHidden = true;
      }
      if(!this.$refs.dropdownPeriode.contains(event.target) && !this.periodeHidden) {
        this.periodeHidden = true;
      }

      if(!this.$refs.dropdownBordee.contains(event.target) && !this.bordeeHidden) {
        this.bordeeHidden = true;
      }
    },
    selectYear() {
      const date = this.selectedYear + '-' + moment(this.selectedMonth).format('MM-DD');
      this.selectedMonth = new Date(date);
      this.periodeSelect = 'mois';
      this.uriSearch.searchParams.delete('periode');
      this.uriSearch.searchParams.delete('date');
      this.uriSearch.searchParams.append('periode', 'mois');
      this.uriSearch.searchParams.append('date', moment(date).format('YYYY-MM-DD'));
      this.fetchFiltre()
    }
  },
  data() {
    return {
      rapports: [],
      uriSearch: new URL('/api/pam/rapport/filtre', window.location.origin),
      currentDate: new Date(),
      currentMonth: new Date(),
      sixPreviousMonthStart: null,
      periodeSelect: 'current',
      selectedMonth: this.currentMonth,
      selectedStatut: 'Tout',
      selectedPeriode: 'Mois en cours',
      selectedBordee: 'Ma bordée',
      statutHidden: true,
      periodeHidden: true,
      bordeeHidden: true,
      filtrePeriodeMonthStart: '',
      filtrePeriodeYearStart: 2022,
      filtrePeriodeMonthEnd: '',
      filtrePeriodeYearEnd: 2022,
      years: [],
      dateRangeEnabled: false,
      startDate: moment(new Date()).format('YYYY-MM-DD'),
      endDate: moment(new Date()).format('YYYY-MM-DD'),
      currentYear: null,
      selectedYear: null,
      userMe: this.me
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

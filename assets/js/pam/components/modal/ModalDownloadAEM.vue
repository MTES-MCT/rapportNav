<template>
  <dialog aria-labelledby="fr-modal-title-modal-download" role="dialog" id="fr-modal-download" class="fr-modal">
    <div class="fr-container fr-container--fluid fr-container-lg">
      <div class="fr-grid-row fr-grid-row--center">
        <div class="fr-col-12 fr-col-md-8 fr-col-lg-7">
          <div class="fr-modal__body">
            <div class="fr-modal__header">
              <button class="fr-link--close fr-link" title="Fermer la fenêtre modale" aria-controls="fr-modal-download">Fermer</button>
            </div>
            <div class="fr-modal__content">
              <h1 id="fr-modal-title-modal-download" class="modal-download-title">
                Télécharger le rapport AEM pour la période du :
              </h1>
              <div class="alert-download-danger fr-mt-2w fr-mb-4w">
                Merci de noter que seuls les rapports <span class="text-bold">validés</span> sont exportés.
              </div>

              <div class="date-range-select">
                <div class="date-select">
                  <div class="fr-select-group">
                    <label for="selectYear-1">De</label>
                    <select class="fr-select" id="selectYear-1" v-model="firstMonth">
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
                  <div class="fr-select-group select-without-label fr-ml-2v">
                    <select class="fr-select" id="select" v-model="firstYear">
                      <option v-for="year in years" :value="year">{{ year }}</option>
                    </select>
                  </div>
                </div>

                <div class="date-select">
                  <div class="fr-select-group">
                    <label for="lastDate">à</label>
                    <select class="fr-select" id="lastDate" name="select" v-model="lastMonth">
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
                  <div class="fr-select-group select-without-label fr-ml-2v">
                    <select class="fr-select" id="lastDate" v-model="lastYear">
                      <option v-for="year in years" :value="year">{{ year }}</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="rapport-equipe-radio">
                <div class="fr-form-group">
                  <fieldset class="fr-fieldset fr-fieldset--inline">
                    <legend class="fr-fieldset__legend" id='download-rapport-radio-2'>
                      Dont l'équipe est :
                    </legend>
                    <div class="fr-fieldset__content">
                      <div class="fr-radio-group">
                        <input type="radio" id="radio-inline-mon-equipe" name="radio-inline" @change="wholeTeams = false" checked>
                        <label class="fr-label" for="radio-inline-mon-equipe">Mon équipe uniquement
                        </label>
                      </div>
                      <div class="fr-radio-group">
                        <input type="radio" id="radio-inline-tout-equipe" name="radio-inline" @change="wholeTeams = true">
                        <label class="fr-label" for="radio-inline-tout-equipe">Toutes les bordées de ce patrouilleur
                        </label>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>

              <button class="fr-btn" @click="download">
                Télécharger le fichier AEM (.xlsx)
              </button>

            </div>
          </div>
        </div>
      </div>
    </div>
  </dialog>
</template>

<script>
import {sanitizeUrl} from "@braintree/sanitize-url";
import axios from "axios";
import moment from "moment";

export default {
  name: "ModalDownloadAEM",
  props: {
    startDate: String,
    endDate: String
  },
  mounted() {
    this.fetchYearsRange();
  },
  methods: {
    download() {
      const firstDate = this.firstMonth + '-' + this.firstYear;
      const lastDate = this.lastMonth + '-' + this.lastYear;
      let url = '/api/pam/export/aem/' + firstDate + '/' + lastDate;
      if(this.wholeTeams) {
        url = url.includes('?') ? url + '&teams=true' : url + '?teams=true';
      }

      window.location.href = sanitizeUrl(url);
    },
    fetchYearsRange() {
      axios.get('/api/pam/helper/years/rapport')
      .then((response) => {
        this.years = response.data;
      })
      .catch((error) => {
        console.log(error);
      })
    }
  },
  data() {
    return {
      firstMonth: '01-01',
      firstYear: new Date().getFullYear(),
      lastMonth: '02-01',
      lastYear: new Date().getFullYear(),
      wholeTeams: false,
      years: []
    }
  },
  watch: {
    startDate: function(newVal, oldVal) {
      this.firstMonth = moment(newVal).format('MM-DD') || '01-01';
      this.firstYear = moment(newVal).format('YYYY') || new Date().getFullYear();

    },
    endDate: function(newVal, oldVal) {

      this.lastMonth = moment(newVal).format('MM-DD') || '02-01';
      console.log(this.lastMonth)
      this.lastYear = moment(newVal).format('YYYY') || new Date().getFullYear();
    }
  }
}
</script>

<style scoped>

</style>

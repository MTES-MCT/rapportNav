<template>
  <div v-if="rapport">
    <HeaderComponent draft name-site="RapportNav" num-report="1498" @submitted="postForm" @drafted="postFormDraft" v-if="drafted">
    </HeaderComponent>
    <HeaderComponent saved name-site="RapportNav" num-report="1498" @submitted="postForm" @drafted="postFormDraft" v-if="saved">
    </HeaderComponent>
    <HeaderComponent name-site="RapportNav" num-report="1498" @submitted="postForm" @drafted="postFormDraft" v-if="!saved && !drafted">
    </HeaderComponent>
    <div class="fr-container--fluid fr-mt-10w page-content">
      <div class="fr-grid-row">
        <div class="fr-col-lg-2 fr-col-md-2 fr-col-sm-12 sidebar-left-menu">
          <SidebarMenuRapportComponent></SidebarMenuRapportComponent>
        </div>
        <div class="fr-col-lg-8 fr-col-md-10 fr-col-sm-12">
          <div class="mainContent">
            <!-- Informations générales -->
            <GeneralInformationCardComponent
               :start_datetime="rapport.start_datetime"
               :end_datetime="rapport.end_datetime"
               :end_time="rapport.end_time"
               :start_time="rapport.start_time"
               :equipage="rapport.equipage"
               :missions="rapport.missions"
               @get-date="setDates"
               ref="informationGeneral"

            >
            </GeneralInformationCardComponent>

            <!-- Activité du navire -->
            <ShipActivityCardComponent
                :rapport="rapport"
                @get-activite="setActivite"
                :nb_jours_mer="rapport.nb_jours_mer"
                :administratif="rapport.administratif"
                :autre="rapport.autre"
                :contr_port="rapport.contr_port"
                :distance="rapport.distance"
                :essence="rapport.essence"
                :go_marine="rapport.go_marine"
                :maintenance="rapport.maintenance"
                :meteo="rapport.meteo"
                :mouillage="rapport.mouillage"
                :nav_eff="rapport.nav_eff"
                :personnel="rapport.personnel"
                :representation="rapport.representation"
                :technique="rapport.technique"
                ref="shipActivity"
            ></ShipActivityCardComponent>

            <!-- Contrôles opérationnel -->
            <RapportAccordionComponent
                v-if="rapport.controles"
                :controles="rapport.controles"
                @get-controles="getControles"
            >
            </RapportAccordionComponent>


            <!-- Indicateurs de mission-->
            <IndicateurMissionComponent
                v-if="rapport.missions"
              :missions="rapport.missions"
            >
            </IndicateurMissionComponent>
          </div>
        </div>

        <div class="sidebar-right-responsive" v-on:click="displayHistory" style="padding-left: 5px !important;">
          <span class="fr-fi-arrow-left-s-line d-block" aria-hidden="true" ></span>
          <span class="ri-history-line d-block"></span>
        </div>
        <div class="sidebar-right-history d-none">
          <SidebarHistoryRapportComponent></SidebarHistoryRapportComponent>
        </div>

      </div>
    </div>
  </div>

</template>

<script>
import HeaderComponent from "../components/HeaderComponent";
import SidebarMenuRapportComponent from "../components/SidebarMenuRapportComponent";
import SidebarHistoryRapportComponent from "../components/SidebarHistoryRapportComponent";
import BoxShadowCardComponent from "../components/card/BoxShadowCardComponent";
import AccordionIndicateurMissionComponent from "../components/accordion/AccordionIndicateurMissionComponent";
import GeneralInformationCardComponent from "../components/card/GeneralInformationCardComponent";
import RapportAccordionComponent from "../components/accordion/RapportAccordionComponent";
import IndicateurMissionComponent from "../components/IndicateurMissionComponent";
import ShipActivityCardComponent from "../components/card/ShipActivityCardComponent";
import axios from 'axios';
import { TYPE } from "vue-toastification";

export default {
  name: "CreateRapportComponent",
  components: {
    ShipActivityCardComponent,
    IndicateurMissionComponent,
    RapportAccordionComponent,
    GeneralInformationCardComponent,
    AccordionIndicateurMissionComponent,
    HeaderComponent,
    SidebarMenuRapportComponent,
    SidebarHistoryRapportComponent,
    BoxShadowCardComponent
  },
  props: {
    date: Object
  },
  mounted() {
    this.activeResponsive();
    $(window).resize(this.activeResponsive);
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const id = urlParams.get('id')
    const draft = urlParams.get('draft')
    if(id && draft) {
      axios.get('/api/pam/rapport/draft/' + id)
          .then((response) => {
            this.rapport = JSON.parse(response.data.body);
            this.drafted = true;
            this.idDraft = id;
            this.rapport.number = 'TEST'; // TODO define a way to generate number
            console.log(JSON.parse(response.data.body))
          })
    }
    else if (id) {
      axios.get('/api/pam/rapport/show/' + id)
          .then((response) => {
            this.rapport = response.data;
            this.saved = true;
            this.idSave = id;
            this.rapport.number = 'TEST'; // TODO define a way to generate number
          })
    } else {
      this.rapport = require('../dist/create-rapport.json');
      this.rapport.number = 'TEST'; // TODO define a way to generate number
      this.fetchLastEquipage();
    }

  },
  methods: {
    displayHistory() {
      $('.sidebar-right-history').removeClass('d-none')
    },
    activeResponsive() {
      if($(document).width() <= 1024) {
        $('.sidebar-right-history').addClass('d-none');
      } else {
        $('.sidebar-right-history').removeClass('d-none')
      }
    },
    postForm() {
      const errorsInformationGeneral = this.$refs.informationGeneral.checkForm();
      const errorsShipActivity = this.$refs.shipActivity.checkForm();
      console.log(errorsInformationGeneral, errorsShipActivity);
      let url = '/api/pam/rapport';
      if(this.saved) {
        url = url + '?id=' + this.idSave;
      }
      if(errorsInformationGeneral.length === 0 && errorsShipActivity.length === 0) {
        axios.post(
            url,
            JSON.stringify(this.rapport),
            {
              headers: {
                'Content-Type': 'application/json'
              }
            }
        ).then(
            (success) => {
              this.showToast("Le rapport a été enregistré avec succès", TYPE.SUCCESS, 'bottom-center')
            }
        ).catch((error) => {
          this.showToast("Erreur lors de l'envoie du formulaire.", TYPE.ERROR, 'bottom-center');
        })
      } else {
        this.showToast("Erreur, merci de remplir les champs obligatoires", TYPE.ERROR, 'bottom-center');
      }
    },
    postFormDraft() {
      let url = '/api/pam/rapport/draft';
      if(this.drafted) {
        url = url + '?id=' + this.idDraft;
      }
      axios.post(
          url,
          JSON.stringify(this.rapport),
          {
            headers: {
              'Content-Type': 'application/json'
            }
          }
      ).then(
          (success) => {
            this.showToast("Le brouillon a été enregistré avec succès", TYPE.SUCCESS, 'bottom-center')
          },
          (error) => console.log(error)
      )

    },
    setDates(date) {
      this.rapport.start_datetime = date.startDateTime;
      this.rapport.end_datetime = date.endDateTime;
    },
    setActivite(info) {
      this.rapport.nb_jours_mer = info.nb_jours_mer;
      this.rapport.essence = info.essence;
      this.rapport.technique = info.technique;
      this.rapport.administratif = info.administratif;
      this.rapport.go_marine = info.go_marine;
      this.rapport.personnel = info.personnel;
      this.rapport.meteo = info.meteo;
      this.rapport.nav_eff = info.nav_eff;
      this.rapport.distance = info.distance;
      this.rapport.autre = info.autre;
      this.rapport.maintenance = info.maintenance;
      this.rapport.contr_port = info.contr_port;
      this.rapport.mouillage = info.mouillage
    },
    getControles(controles) {
      this.rapport.controles = controles;
    },
    formatDate(date) {
      let formatDate = new Date(date);
      formatDate = new Date(formatDate.getTime() - (formatDate.getTimezoneOffset()*60*1000))
      formatDate = formatDate.toISOString().split('T')[0];
      return formatDate;
    },
    showToast(message, type, position) {
      this.$toast(message, {
        type: type,
        position: position
      })
    },
    fetchLastEquipage() {
      axios.get('/api/pam/rapport/last/equipage')
      .then((response) => {
        this.rapport.equipage = response.data;
      })
      .catch((error) => {
        console.log(error)
      })
    }
  },
  data() {
    return {
      rapport: null,
      drafted: null,
      saved: null,
      idDraft: null,
      idSave: null
    }
  }
};
</script>

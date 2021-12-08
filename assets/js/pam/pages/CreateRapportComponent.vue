<template>
  <div v-if="rapport">
    <HeaderComponent name-site="RapportNav" num-report="1498" @submitted="postForm" @drafted="postFormDraft"></HeaderComponent>
    <div class="fr-container--fluid fr-mt-10w page-content">
      <div class="fr-grid-row">
        <div class="fr-col-lg-2 fr-col-md-2 fr-col-sm-12 sidebar-left-menu">
          <SidebarMenuRapportComponent></SidebarMenuRapportComponent>
        </div>
        <div class="fr-col-lg-8 fr-col-md-10 fr-col-sm-12">
          <div class="mainContent">
            <!-- Informations générales -->
            <GeneralInformationCardComponent
               :start_date="rapport.start_date"
               :end_date="rapport.end_date"
               :end_time="rapport.end_time"
               :start_time="rapport.start_time"
               :equipage="rapport.equipage"
               :missions="rapport.missions"
               @get-date="setDates"

            >
            </GeneralInformationCardComponent>

            <!-- Activité du navire -->
            <ShipActivityCardComponent
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
            ></ShipActivityCardComponent>

            <!-- Contrôles opérationnel -->
            <RapportAccordionComponent
                :types="rapport.controles.types"
            >
            </RapportAccordionComponent>


            <!-- Indicateurs de mission-->
            <IndicateurMissionComponent
              :missions="rapport.missions"
            >
            </IndicateurMissionComponent>
          </div>
        </div>

        <div class="sidebar-right-responsive" v-on:click="displayHistory" style="padding-left: 5px !important;">
          <span class="fr-fi-arrow-left-s-line d-block" aria-hidden="true" ></span>
          <span class="ri-history-line d-block"></span>
        </div>
        <div class="sidebar-right-history">
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
   // this.activeResponsive();
    //$(window).resize(this.activeResponsive);
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const id = urlParams.get('id')
    axios.get('/api/pam/rapport/draft/' + id)
    .then((response) => {
      this.$data.rapport = JSON.parse(response.data.body);
      console.log(JSON.parse(response.data.body))
    })
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
      console.log(JSON.parse(JSON.stringify(this.$data)))
    },
    postFormDraft() {
      axios.post(
          '/api/pam/rapport/draft',
          JSON.stringify(this.rapport),
          {
            headers: {
              'Content-Type': 'application/json'
            }
          }
      ).then(
          (response) => console.log(response),
          (error) => console.log(error)
      )
    },
    setDates(date) {
      this.start_date = date.startDate;
      this.end_date = date.endDate;
      this.end_time = date.endTime;
      this.start_time = date.startTime;
      this.checkMissions = date.checkMissions;
    },
    setActivite(info) {
      this.nb_jours_mer = info.nb_jours_mer;
      this.essence = info.essence;
      this.technique = info.technique;
      this.administratif = info.administratif;
      this.go_marine = info.go_marine;
      this.personnel = info.personnel;
      this.meteo = info.meteo;
      this.nav_eff = info.nav_eff;
      this.distance = info.distance;
      this.autre = info.autre;
      this.maintenance = info.maintenance;
      this.rapport.contr_port = info.contr_port;
      this.mouillage = info.mouillage
    }
  },
  data() {
    return {
      rapport: null
    }
  }
};
</script>

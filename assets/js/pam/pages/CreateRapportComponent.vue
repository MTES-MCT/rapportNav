<template>
  <div>
    <HeaderComponent name-site="RapportNav" num-report="1498" @submitted="postForm"></HeaderComponent>
    <div class="fr-container--fluid fr-mt-10w page-content">
      <div class="fr-grid-row">
        <div class="fr-col-lg-2 fr-col-md-2 fr-col-sm-12 sidebar-left-menu">
          <SidebarMenuRapportComponent></SidebarMenuRapportComponent>
        </div>
        <div class="fr-col-lg-8 fr-col-md-10 fr-col-sm-12">
          <div class="mainContent">
            <!-- Informations générales -->
            <GeneralInformationCardComponent
               :start_date="start_date"
               :end_date="end_date"
               :end_time="end_time"
               :start_time="start_time"
               :equipage="equipage"
               @get-date="setDates"

            >
            </GeneralInformationCardComponent>

            <!-- Activité du navire -->
            <ShipActivityCardComponent
                @get-activite="setActivite"
                :nb_jours_mer="nb_jours_mer"
                :administratif="administratif"
                :autre="autre"
                :contr_port="contr_port"
                :distance="distance"
                :essence="essence"
                :go_marine="go_marine"
                :maintenance="maintenance"
                :meteo="meteo"
                :mouillage="mouillage"
                :nav_eff="nav_eff"
                :personnel="personnel"
                :representation="representation"
                :technique="technique"
            ></ShipActivityCardComponent>

            <!-- Contrôles opérationnel -->
            <RapportAccordionComponent
                :types="controles.types"
            >
            </RapportAccordionComponent>


            <!-- Indicateurs de mission-->
            <IndicateurMissionComponent
              :missions="missions"
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
    $(window).resize(this.activeResponsive)
  },
  methods: {
    hiddenToggle(className, scope) {
      let tooltip = $('.' + className + '[data-scope="' + scope + '"]');
      tooltip.toggleClass('d-none');
    },
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
    setDates(date) {
      this.start_date = date.startDate;
      this.end_date = date.endDate;
      this.end_time = date.endTime;
      this.start_time = date.time;
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
      this.contr_port = info.contr_port;
      this.mouillage = info.mouillage
    }
  },
  data() {
    return {
      start_date: null,
      start_time: null,
      end_date: null,
      end_time: null,
      nb_jours_mer: null,
      nav_eff: null,
      mouillage: null,
      maintenance: null,
      meteo: null,
      representation: null,
      administratif: null,
      autre: null,
      contr_port: null,
      technique: null,
      personnel: null,
      distance: null,
      go_marine: null,
      essence: null,
      equipage: {
        membres: [{
          name: 'Pierre Crepon',
          role: 'Commandant',
          observations: ''
        },
        {
          name: 'David Vincent',
          role: 'Agent de pont',
          observations: 'Test'
          }]
      },
      controles: {
        types: [{
          title: 'Contrôle en mer de navires de pêche professionnelle',
          id: 4000,
          pavillons: [{
            pavillon: 'FR',
            nb_navire_controle: null,
            pv_peche_sanitaire: null,
            pv_equipement_securite: null,
            pv_titre_nav: null,
            pv_police_nav: null,
            pv_env_pollution: null,
            autre_pv: null,
            nb_nav_deroute: null,
            nb_nav_interroge: null
            }]
        }]
      },
      missions: {
        types: [
          {
            indicateurs: []
          },
          {
            indicateurs: []
          }
        ]
      }
    }
  }
};
</script>

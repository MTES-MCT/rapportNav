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
            <GeneralInformationCardComponent v-model="rapport">
            </GeneralInformationCardComponent>

            <!-- Activité du navire -->
            <BoxShadowCardComponent
                v-model="activite"
                type="shipActivity"
                class-name="shipActivity"
                title="Activité du navire"
            ></BoxShadowCardComponent>

            <!-- Contrôles opérationnel -->
            <RapportAccordionComponent
                :types="controles.types"
            >
            </RapportAccordionComponent>


            <!-- Indicateurs de mission-->
            <div class="heading-custom heading-custom-space-between">
              <h5 class="text-blue-france text-800">Indicateurs de mission</h5>
            </div>
            <AccordionIndicateurMissionComponent
                title="Contrôle en mer des navires de pêche professionnelle"
                v-bind:cols="['Aleck', 'Nb heure']"
            ></AccordionIndicateurMissionComponent>

            <AccordionIndicateurMissionComponent
                title="Contrôle en mer des navires de pêche plaisance"
                v-bind:cols="['Toto', 'Nb heure']"
            ></AccordionIndicateurMissionComponent>
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
export default {
  name: "CreateRapportComponent",
  components: {
    RapportAccordionComponent,
    GeneralInformationCardComponent,
    AccordionIndicateurMissionComponent,
    HeaderComponent,
    SidebarMenuRapportComponent,
    SidebarHistoryRapportComponent,
    BoxShadowCardComponent
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
    }
  },
  data() {
    return {
      rapport: null,
      activite: null,
      controles: {
          types: [
            {
              title: 'Contrôle en mer de navires de pêche professionnelle',
              id: 4000,
              pavillons: [
                {
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
                }
              ]
            }
          ]
      },
      missions: []
    }
  }
};
</script>

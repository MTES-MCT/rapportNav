<template>
  <div>
    <HeaderComponent name-site="RapportNav" num-report="1498"></HeaderComponent>
    <div class="fr-container--fluid fr-mt-10w page-content">
      <div class="fr-grid-row">
        <div class="fr-col-lg-2 fr-col-md-2 fr-col-sm-12 sidebar-left-menu">
          <SidebarMenuRapportComponent></SidebarMenuRapportComponent>
        </div>

        <div class="fr-col-lg-8 fr-col-md-10 fr-col-sm-12">
          <div class="mainContent">
            <!-- Informations générales -->
            <BoxShadowCardComponent
                type="informationGeneral"
                class-name="informationGeneral"
                title="Information générales"
            ></BoxShadowCardComponent>

            <!-- Activité du navire -->
            <BoxShadowCardComponent
                type="shipActivity"
                class-name="shipActivity"
                title="Activité du navire"
            ></BoxShadowCardComponent>

            <!-- Contrôles opérationnel -->
            <AccordionGroupComponent
                class-name="operationalControl"
                type="controle"
                title="Contrôles opérationnel"
            ></AccordionGroupComponent>


            <!-- Indicateurs de mission-->
            <AccordionIndicateurMissionComponent
                class-name="indicMission"
                title="Contrôle en mer des navires de pêche professionnelle"
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
import AccordionGroupComponent from "../components/accordion/AccordionGroupComponent";
import AccordionIndicateurMissionComponent from "../components/accordion/AccordionIndicateurMissionComponent";
export default {
  name: "CreateRapportComponent",
  components: {
    AccordionIndicateurMissionComponent,
    HeaderComponent,
    SidebarMenuRapportComponent,
    SidebarHistoryRapportComponent,
    BoxShadowCardComponent,
    AccordionGroupComponent
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
    displayMessage(e, scope) {
      let messageBox = $('.hint-text-automatic-calculate[data-scope="' + scope + '"]');
      messageBox.toggleClass('d-none')
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
    }
  }
};
</script>

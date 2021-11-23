<template>
  <div>
    <HeaderComponent name-site="RapportNav" num-report="1498"></HeaderComponent>
    <div class="fr-mt-9w">
      <div class="fr-grid-row">
        <SidebarMenuRapportComponent></SidebarMenuRapportComponent>

        <div class=" mainContent">

          <!-- Informations générales -->
          <BoxShadowCardComponent type="informationGeneral" class-name="informationGeneral"></BoxShadowCardComponent>

          <!-- Activité du navire -->
          <BoxShadowCardComponent type="shipActivity" class-name="shipActivity"></BoxShadowCardComponent>

          <!-- Contrôles opérationnel -->
          <AccordionGroupComponent
              class-name="operationalControl"
              type="controle"
              title="Contrôles opérationnel"
          ></AccordionGroupComponent>


          <!-- Indicateurs de mission -->
          <AccordionGroupComponent
              class-name="indicMission"
              type="indicateur"
              title="Indicateurs de mission"
          ></AccordionGroupComponent>
        </div>


        <SidebarHistoryRapportComponent></SidebarHistoryRapportComponent>
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
export default {
  name: "CreateRapportComponent",
  components: {
    HeaderComponent,
    SidebarMenuRapportComponent,
    SidebarHistoryRapportComponent,
    BoxShadowCardComponent,
    AccordionGroupComponent
  },
  methods: {
    hiddenToggle(className, scope) {
      let tooltip = $('.' + className + '[data-scope="' + scope + '"]');
      tooltip.toggleClass('d-none');
    },
    displayMessage(e, scope) {
      let messageBox = $('.hint-text-automatic-calculate[data-scope="' + scope + '"]');
      messageBox.toggleClass('d-none')
    }
  }
};
</script>

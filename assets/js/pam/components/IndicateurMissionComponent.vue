<template>
<div class="fr-mt-8w section" id="indicateur">
  <div class="heading-custom heading-custom-space-between">
    <h5 class="text-blue-france text-800">Indicateurs de mission</h5>
  </div>
  <AccordionIndicateurMissionComponent
      v-if="controleNavirePro !== null"
      :title="controleNavirePro.type.label"
      :indicateurs="controleNavirePro.indicateurs"
  ></AccordionIndicateurMissionComponent>

  <!--<AccordionIndicateurMissionComponent
      title="Contrôle en mer des navires de pêche plaisance"
      :types="missions.types[1]"
  ></AccordionIndicateurMissionComponent>-->
</div>
</template>

<script>
import AccordionIndicateurMissionComponent from "./accordion/AccordionIndicateurMissionComponent";
export default {
  name: "IndicateurMissionComponent",
  components: {AccordionIndicateurMissionComponent},
  props: {
    missions: {
      type: Array,
      default: null
    }
  },
  mounted() {

    this.missions.forEach((mission, index) => {
      if(mission.type.id === 1 ) {
        this.controleNavirePro = mission;
      }
    })
  },
  data() {
    return {
      controleNavirePro: null
    }
  }
}
</script>

<style scoped>

</style>
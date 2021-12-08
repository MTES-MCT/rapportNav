<template>
<div class="fr-mt-8w section" id="indicateur">
  <div class="heading-custom heading-custom-space-between">
    <h5 class="text-blue-france text-800">Indicateurs de mission</h5>
  </div>
  <div v-for="mission in missions">
    <AccordionIndicateurMissionComponent
        :title="mission.type.label"
        :indicateurs="mission.indicateurs"
    ></AccordionIndicateurMissionComponent>
  </div>
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
  data() {
    return {
      controleNavirePro: null
    }
  }
}
</script>

<style scoped>

</style>
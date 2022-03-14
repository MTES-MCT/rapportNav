<template>
<div class="fr-mt-8w section" id="indicateur">
  <div class="heading-custom heading-custom-space-between">
    <h5 class="text-blue-france text-800">Indicateurs de missions</h5>
  </div>
  <div v-for="mission in missions">
    <AccordionIndicateurMissionComponent
        :title="mission.category.nom"
        :indicateurs="mission.indicateurs"
        :expanded="mission.checked ? 'true' : 'false'"
        :category-id="mission.category.id"
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
    missions: Array
  },
  data() {
    return {
    }
  }
}
</script>

<style scoped>

</style>

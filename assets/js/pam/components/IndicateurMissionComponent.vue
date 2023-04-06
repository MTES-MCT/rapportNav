<template>
<div class="fr-mt-8w section" id="indicateur">
  <div class="heading-custom heading-custom-space-between">
    <h5 class="text-blue-france text-800">Indicateurs de missions</h5>
  </div>
  <div v-for="mission in missions" :key="mission.category.id">
    <AccordionIndicateurMissionComponent
        :title="mission.category.nom"
        :mission="mission"
        :expanded="mission.checked ? 'true' : 'false'"
        :category-id="mission.category.id"
        :controles="controles"
        :autres-missions="autresMissions"
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
    missions: Array,
    controles: Array,
    autresMissions: Object
  },
  data() {
    return {
    }
  }
}
</script>

<style scoped>

</style>

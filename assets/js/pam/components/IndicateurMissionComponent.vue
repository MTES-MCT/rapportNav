<template>
<div class="fr-mt-8w">
  <div class="heading-custom heading-custom-space-between">
    <h5 class="text-blue-france text-800">Indicateurs de mission</h5>
  </div>
  <AccordionIndicateurMissionComponent
      title="Contrôle en mer des navires de pêche professionnelle"
      v-bind:cols="['Test_column', 'Nb heure']"
      :types="missions.types[0]"
  ></AccordionIndicateurMissionComponent>

  <AccordionIndicateurMissionComponent
      title="Contrôle en mer des navires de pêche plaisance"
      v-bind:cols="['Test_column', 'Nb heure']"
      :types="missions.types[1]"
  ></AccordionIndicateurMissionComponent>
</div>
</template>

<script>
import AccordionIndicateurMissionComponent from "./accordion/AccordionIndicateurMissionComponent";
export default {
  name: "IndicateurMissionComponent",
  components: {AccordionIndicateurMissionComponent},
  props: {
    missions: {
      type: Object,
      default: null
    }
  }
}
</script>

<style scoped>

</style>
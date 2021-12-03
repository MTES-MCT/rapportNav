<template>
  <div class="missions fr-mt-3w" @change="getData">
    <h6>Missions à réaliser <span class="fr-fi-xs fr-fi-information-fill icon-grey" aria-hidden="true"></span> </h6>
    <div class="fr-container--fluid">
      <div class="fr-grid-row">
        <div class="fr-col-lg-6">
          <CheckboxMission label="Assistance aux navires en difficultés" v-model="missions[0]"></CheckboxMission>
          <CheckboxMission label="Répression contre les rejets illicites, lutte contre les pollutions et protection de l’environnement" v-model="missions[1]"></CheckboxMission>
          <CheckboxMission label="Surveillance et contrôles pour la protection de l’environnement" v-model="missions[2]"></CheckboxMission>
          <CheckboxMission label="Souveraineté et protection des intérêts nationaux" v-model="missions[3]"></CheckboxMission>
        </div>
        <div class="fr-col-lg-6 fr-pl-2v">
          <CheckboxMission label="Lutte contre l’immigration illégale par voie maritime" v-model="missions[4]"></CheckboxMission>
          <CheckboxMission label="Lutte contre les activités de pêche illégale, gestion du patrimoine marin et des ressources publiques marines" v-model="missions[5]"></CheckboxMission>
          <CheckboxMission label="Sureté maritime"></CheckboxMission>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CheckboxMission from "./checkbox/CheckboxMission";
export default {
  name: "MissionToAchieveComponent",
  components: { CheckboxMission },
  data() {
    return {
      missions: []
    }
  },
  methods: {
    getData() {
      this.$emit('input', this.missions)
    }
  }
}
</script>

<style scoped>

</style>
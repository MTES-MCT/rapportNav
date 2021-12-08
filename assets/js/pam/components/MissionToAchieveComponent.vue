<template>
  <div class="missions fr-mt-3w" >
    <h6>Missions à réaliser <span class="fr-fi-xs fr-fi-information-fill icon-grey" aria-hidden="true"></span> </h6>
    <div class="fr-container--fluid">
      <div class="fr-grid-row">
        <div class="fr-col-lg-6">
          <div v-for="(mission, index) in missions" v-if="index < 4">
            <CheckboxMission
                :label="mission.type.label"
                :mission="mission" >
            </CheckboxMission>
          </div>
        </div>
        <div class="fr-col-lg-6 fr-pl-2v">
          <div v-for="(mission, index) in missions" v-if="index >= 4">
            <CheckboxMission
                :label="mission.type.label"
                :mission="mission" >
            </CheckboxMission>
          </div>
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
  props: {
    missions: Array
  },
  data() {
    return {
    }
  },
  methods: {
  },
  mounted() {
  }
}
</script>

<style scoped>

</style>
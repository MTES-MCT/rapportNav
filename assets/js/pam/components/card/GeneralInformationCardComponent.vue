<template>
  <div @change="getData">
    <h5 class="text-blue-france text-800">Informations générale</h5>
    <div class="box-shadow-card ">
      <div class="box-shadow-card-body" id="generalInformation">
        <h6>Dates de la marée</h6>
        <div class="form-inline">
          <label class="fr-label" for="start-date">
            De
          </label>
          <div class="fr-input-wrap">
            <input class="form-custom form-date" type="date" id="start-date" v-model="start_date">
          </div>
          <div class="fr-input-wrap">
            <input class="form-custom form-time" type="time" id="start-time" name="text-input-calendar">
          </div>

          <label class="fr-label" for="end-date">
            à
          </label>
          <div class="fr-input-wrap">
            <input class="form-custom form-date" type="date" id="end-date"v-model="end_date">
          </div>
          <div class="fr-input-wrap">
            <input class="form-time form-custom" type="time" id="end-time" name="text-input-calendar">
          </div>
        </div>
        <div class="divider-horizontal"></div>

        <div class="equipage fr-mt-3w">
          <h6>Equipage</h6>
          <div class="fr-container--fluid">
            <EquipageComponent
                v-model="equipage"
                :members-list="equipage"
            >

            </EquipageComponent>
          </div>
        </div>
        <div class="divider-horizontal"></div>
        <MissionToAchieveComponent v-model="missions"></MissionToAchieveComponent>
  </div>
    </div>
  </div>
</template>

<script>
import EquipageComponent from "../EquipageComponent";
import MissionToAchieveComponent from "../MissionToAchieveComponent";

export default {
  name: "GeneralInformationCardComponent",
  components: { EquipageComponent, MissionToAchieveComponent },
  methods: {
    getData() {
      this.$emit('input', this.$data);
    }
  },
  data() {
    return {
      equipage: [
        {
          name: 'Pierre Crepon',
          role: 'Commandant',
          observations: ''
        },
        {
          name: 'David Vincent',
          role: 'Agent de pont',
          observations: 'Test'
        }
      ],
      start_date: null,
      end_date: null,
      missions: null
    }
  },
  mounted() {
  }
}
</script>

<style scoped>

</style>
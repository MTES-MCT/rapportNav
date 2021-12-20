<template>
  <div @change="getData" id="generalInformation" class="section">
    <h5 class="text-blue-france text-800">Informations générale</h5>
    <div class="box-shadow-card ">
      <div class="box-shadow-card-body">
        <h6>Dates de la marée</h6>
        <div class="form-inline">
          <label class="fr-label" for="start-date">
            De
          </label>
          <div class="fr-input-wrap fr-mr-4v">
            <input class="form-custom form-date" type="date" id="start-date" v-model="startDate">
            <p id="text-input-error-desc-error" class="fr-error-text" v-if="errors['startDate'] || errors['startTime']">
              Veuillez renseigner un date et heure de début
            </p>
          </div>
          <div class="fr-input-wrap fr-mr-4v">
            <input class="form-custom form-time" type="time" id="start-time" v-model="startTime">
          </div>

          <label class="fr-label fr-mr-6v" for="end-date">
            à
          </label>
          <div class="fr-input-wrap fr-mr-4v">
            <input class="form-custom form-date" type="date" id="end-date" v-model="endDate">
          </div>
          <div class="fr-input-wrap">
            <input class="form-time form-custom" type="time" id="end-time" v-model="endTime">
          </div>
        </div>
        <div class="divider-horizontal"></div>

        <div class="equipage fr-mt-3w">
          <h6>Equipage</h6>
          <div class="fr-container--fluid">
            <EquipageComponent
                :membres="equipage.membres"
            >
            </EquipageComponent>
          </div>
        </div>
        <div class="divider-horizontal"></div>
        <MissionToAchieveComponent
            :missions="missions"
        >
        </MissionToAchieveComponent>
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
  props: {
    start_date: String,
    start_time: String,
    end_date: String,
    end_time: String,
    equipage: Object,
    missions: Array
  },
  methods: {
    getData() {
      this.$emit('get-date', this.$data);
    },
    getErrors() {
      this.$emit('get-errors', this.error)
    },
    checkForm() {
      this.addError(this.startDate, 'startDate');
      this.addError(this.endDate, 'endDate');
      this.addError(this.startTime, 'startTime');
      this.addError(this.endTime, 'endTime');
      return this.errors;

    },
    addError(element, scope) {
      if(!element) {
        this.errors.push(scope)
      }
    }
  },
  mounted() {
  },
  data() {
    return {
      startDate: this.start_date,
      endDate: this.end_date,
      startTime: this.start_time,
      endTime: this.end_time,
      errors: []
    }
  }
}
</script>

<style scoped>

</style>

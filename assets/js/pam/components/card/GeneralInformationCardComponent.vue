<template>
  <div @click="getData" id="generalInformation" class="section">
    <h5 class="text-blue-france text-800">Informations générales</h5>
    <div class="box-shadow-card ">
      <div class="box-shadow-card-body">
        <h6>Dates du rapport</h6>
        <div class="form-inline">
          <label class="fr-label">
            De
          </label>
          <DateTimeComponent
              v-model:value="startDateTime"
              :error="hasError('startDateTime')"
              id="datetimePicker_start"
          ></DateTimeComponent>

          <label class="fr-label fr-mr-6v fr-ml-6v">
            à
          </label>
          <DateTimeComponent
              v-model:value="endDateTime"
              :error="hasError('endDateTime')"
              id="datetimePicker_end"
          ></DateTimeComponent>
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
import DateTimeComponent from "../input/DateTimeComponent";
import moment from "moment";

export default {
  name: "GeneralInformationCardComponent",
  components: {DateTimeComponent, EquipageComponent, MissionToAchieveComponent },
  props: {
    start_datetime: String,
    end_datetime: String,
    equipage: Object,
    missions: Array
  },
  methods: {
    getDate(value) {
      this.startDateTime = value
    },
    getData() {
      this.$emit('get-date', this.$data);
    },
    getErrors() {
      this.$emit('get-errors', this.error)
    },
    checkForm() {
      this.errors = []; // begin with empty array
      this.addError(this.startDateTime, 'startDateTime');
      this.addError(this.endDateTime, 'endDateTime');
      return this.errors;
    },
    addError(date, name) {
      const time = moment(date).format('HH:mm');
      if(!date || (!time || time === '00:00')) {
        this.errors.push(name)
      }
    },
    hasError(value) {
      return this.errors.includes(value)
    }
  },
  mounted() {
  },
  data() {
    return {
      startDateTime: this.start_datetime,
      endDateTime: this.end_datetime,
      errors: []
    }
  }
}
</script>

<style scoped>

</style>

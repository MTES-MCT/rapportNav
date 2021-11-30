<template>
    <div class="box-shadow-card-body" id="generalInformation">
      <h6>Dates de la marée</h6>
      <div class="form-inline">
        <label class="fr-label" for="start-date">
          De
        </label>
        <div class="fr-input-wrap">
          <input class="form-custom form-date" type="date" id="start-date" name="text-input-calendar">
        </div>
        <div class="fr-input-wrap">
          <input class="form-custom form-time" type="time" id="start-time" name="text-input-calendar">
        </div>

        <label class="fr-label" for="end-date">
          à
        </label>
        <div class="fr-input-wrap">
          <input class="form-custom form-date" type="date" id="end-date" name="text-input-text">
        </div>
        <div class="fr-input-wrap">
          <input class="form-time form-custom" type="time" id="end-time" name="text-input-calendar">
        </div>
      </div>
      <div class="divider-horizontal"></div>

      <div class="equipage fr-mt-3w">
        <h6>Equipage</h6>
        <div class="fr-container--fluid">
              <EquipageComponent></EquipageComponent>
        </div>
      </div>
      <div class="divider-horizontal"></div>
      <MissionToAchieveComponent></MissionToAchieveComponent>
    </div>
</template>

<script>
import EquipageComponent from "../EquipageComponent";
import MissionToAchieveComponent from "../MissionToAchieveComponent";

export default {
  name: "GeneralInformationCardComponent",
  components: { EquipageComponent, MissionToAchieveComponent },
  methods: {
    checkInputFilled() {
     let $input = $('.form-custom');
     $.map($input, (el) => {
       if($(el).val() === '') {
         $(el).addClass('form-not-filled')
       }
     })
    }
  },
  mounted() {
    this.checkInputFilled()
  }
}
</script>

<style scoped>

</style>
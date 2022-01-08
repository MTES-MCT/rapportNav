<template>
  <div
      class="checkbox-mission"
      v-bind:class="[ checkboxGroupId, mission.checked ? active : '' ]"
      @change="getData()">
    <div class="fr-checkbox-group fr-checkbox-group--sm ">
      <input
          type="checkbox"
          :id="'checkboxes-' + id"
          :name="'checkboxes-' + id"
          v-model="mission.checked">
      <label class="fr-label text-sm" :for="'checkboxes-' + id">{{ label }}</label>
    </div>
    <div
        class="fr-toggle fr-toggle--label-left" v-if="mission.checked">
      <input type="checkbox" class="fr-toggle__input is-main-mission " :aria-describedby="'toggle-' + id + '-hint-text'" :id="'toggle-' + id" v-model="mission.is_main">
      <label class="fr-toggle__label" :for="'toggle-' + id">Mission principale</label>
    </div>

    <div class="define-date"
         v-if="mission.is_main === true && mission.checked === true"
         >
      <span class="text-small-blue" v-if="mission.start_datetime == null" @click="clicked = !clicked">Définir les dates</span>
      <p class="text-small-blue" v-else @click="clicked = !clicked">
        Du {{mission.start_datetime|date('DD/MM/YYYY')}} à {{mission.start_datetime|date('HH:mm')}} au
        <span v-if="mission.end_datetime == null">--/--/---- à --:--</span>
        <span v-else>{{mission.end_datetime|date('DD/MM/YYYY')}} à {{mission.end_datetime|date('HH:mm')}}</span>
      </p>
      <div
          class="define-date-form"
          v-bind:class="[ !clicked ? 'd-none' : null ]"
          >
        <div class="fr-input-group">
          <label class="fr-label fr-label-left fr-mb-2v">
            Du
          </label>
          <DateTimeComponent v-model:value="mission.start_datetime"></DateTimeComponent>
        </div>

        <div class="fr-input-group">
          <label class="fr-label fr-label-left fr-mb-2v">
            au
          </label>
                <DateTimeComponent v-model:value="mission.end_datetime"></DateTimeComponent>
            <button class="custom-btn fr-fi-checkbox-circle-line fr-btn--icon-left fr-mt-3v remove-equip-btn" @click="clearDate()">
              Supprimer les dates
            </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import DateTimeComponent from "../input/DateTimeComponent";
export default {
  name: "CheckboxMission",
  components: {DateTimeComponent},
  props: {
    label: {
      type: String,
      default: null
    },
    mission: Object
  },
  methods: {
    clearDate() {
      this.mission.start_datetime = null;
      this.mission.end_datetime = null;
    },
    getData() {
      this.$emit('input', this.mission)
    }
  },
  data() {
    return {
      id: this._uid,
      checkboxGroupId: 'checkbox-group-' + this._uid,
      active: 'main-task-active',
      clicked: false
    }
  },
  filters: {
    date: function(date, format) {
      return moment(date).format(format)
    }
  }
}
</script>

<style scoped>

</style>

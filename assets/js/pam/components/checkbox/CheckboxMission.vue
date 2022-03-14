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
      <label class="fr-label text-sm" :for="'checkboxes-' + id">{{ nom }}</label>
    </div>
    <div
        class="fr-toggle fr-toggle--label-left" v-if="mission.checked">
      <input type="checkbox" class="fr-toggle__input is-main-mission " :aria-describedby="'toggle-' + id + '-hint-text'" :id="'toggle-' + id" v-model="mission.is_main">
      <label class="fr-toggle__label" :for="'toggle-' + id">Mission principale</label>
    </div>

    <div class="define-date"
         v-if="mission.is_main === true && mission.checked === true"
         >
      <span class="text-small-blue" v-if="mission.start_datetime == null" @click="hidden = !hidden">Définir les dates</span>
      <p class="text-small-blue" v-else @click="hidden = !hidden">
        Du {{mission.start_datetime|date('DD/MM/YYYY')}} à {{mission.start_datetime|date('HH:mm')}} au
        <span v-if="mission.end_datetime == null">--/--/---- à --:--</span>
        <span v-else>{{mission.end_datetime|date('DD/MM/YYYY')}} à {{mission.end_datetime|date('HH:mm')}}</span>
      </p>
      <div
          v-if="!hidden"
          class="define-date-form"
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
          <div class="btn-group">
            <button class="custom-btn custom-btn-danger fr-fi-delete-fill fr-btn--icon-left fr-mt-3v remove-equip-btn" @click="clearDate()">
              Supprimer les dates
            </button>
            <button class="custom-btn fr-fi-close-line fr-btn--icon-left fr-mt-3v" @click="hidden = !hidden">
              Fermer
            </button>
          </div>
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
    nom: {
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
      id: this.mission.category.id,
      checkboxGroupId: 'checkbox-group-' + this._uid,
      active: 'main-task-active',
      clicked: false,
      hidden: true
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

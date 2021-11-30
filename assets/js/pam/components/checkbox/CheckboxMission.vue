<template>
  <div :class="'checkbox-mission checkbox-group-' + id " >
    <div class="fr-checkbox-group fr-checkbox-group--sm ">
      <input type="checkbox" :id="'checkboxes-' + id" :name="'checkboxes-' + id" @change="isMissionChecked()">
      <label class="fr-label text-sm" :for="'checkboxes-' + id">{{ label }}</label>
    </div>
    <div :class="'fr-toggle fr-toggle--label-left  d-none toggle-custom-' + id">
      <input type="checkbox" class="fr-toggle__input is-main-mission " :aria-describedby="'toggle-' + id + '-hint-text'" :id="'toggle-' + id" @change="isMainMissionChecked($event.target.checked)">
      <label class="fr-toggle__label" :for="'toggle-' + id">Mission principale</label>
    </div>
    <div class="define-date" v-if="isMainMission === true">
      <span class="text-small-blue" v-if="startDate == null">Définir les dates</span>
      <p class="text-small-blue" v-else>
        Du {{startDate|date}} à {{startTime}} au
        <span v-if="endDate == null">--/--/---- à --:--</span>
        <span v-else>{{endDate|date}} à {{endTime}}</span>
      </p>
      <div class="define-date-form">
        <div class="fr-input-group">
          <label class="fr-label fr-label-left fr-mb-2v">
            Du
          </label>
          <div class="fr-container--fluid">
            <div class="fr-grid-row">
              <div class="fr-col-lg-8 fr-col-sm-6">
                <div class="fr-input-wrap fr-fi-calendar-line">
                  <input class="fr-input define-date-input" type="date" v-model="startDate">
                </div>
              </div>
              <div class="fr-col-lg-4 fr-col-sm-6 fr-pl-1v">
                <div class="">
                  <input class="fr-input define-date-time-input define-date-input" type="time" v-model="startTime">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="fr-input-group">
          <label class="fr-label fr-label-left fr-mb-2v">
            au
          </label>
          <div class="fr-container--fluid">
            <div class="fr-grid-row">
              <div class="fr-col-lg-8">
                <div class="fr-input-wrap fr-fi-calendar-line">
                  <input class="fr-input define-date-input" type="date" v-model="endDate">
                </div>
              </div>
              <div class="fr-col-4 fr-pl-1v">
                <div class="">
                  <input class="fr-input define-date-time-input define-date-input" type="time" v-model="endTime">
                </div>
              </div>
            </div>
            <button class="custom-btn fr-fi-checkbox-circle-line fr-btn--icon-left fr-mt-3v remove-equip-btn" @click="clearDate()">
              Supprimer les dates
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  name: "CheckboxMission",
  props: {
    label: {
      type: String,
      default: null
    }
  },
  methods: {
    isMissionChecked() {
      $('.toggle-custom-' + this.id).toggleClass('d-none');
      $('.checkbox-group-' + this.id).toggleClass('main-task-active');
    },
    isMainMissionChecked(checked) {
      return this.isMainMission = checked;
    },
    clearDate() {
      this.startDate = null;
      this.startTime = null;
      this.endDate = null;
      this.endTime = null;
    }
  },
  data() {
    return {
      startDate: null,
      startTime: null,
      endDate: null,
      endTime: null,
      id: this._uid,
      isMainMission: false
    }
  },
  filters: {
    date: function(date) {
      return moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY')
    }
  }
}
</script>

<style scoped>

</style>
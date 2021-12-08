<template>
  <div :class="'checkbox-mission checkbox-group-' + id " @change="getData()">
    <div class="fr-checkbox-group fr-checkbox-group--sm ">
      <input type="checkbox" :id="'checkboxes-' + id" :name="'checkboxes-' + id" @change="isMissionChecked($event.target.checked)" v-model="mission.checked">
      <label class="fr-label text-sm" :for="'checkboxes-' + id">{{ label }}</label>
    </div>
    <div :class="'fr-toggle fr-toggle--label-left  d-none toggle-custom-' + id">
      <input type="checkbox" class="fr-toggle__input is-main-mission " :aria-describedby="'toggle-' + id + '-hint-text'" :id="'toggle-' + id" v-model="mission.is_main">
      <label class="fr-toggle__label" :for="'toggle-' + id">Mission principale</label>
    </div>

    <div class="define-date" v-if="mission.is_main === true && mission.checked === true">
      <span class="text-small-blue" v-if="mission.start_date == null">Définir les dates</span>
      <p class="text-small-blue" v-else>
        Du {{mission.start_date|date}} à {{mission.start_time}} au
        <span v-if="mission.end_date == null">--/--/---- à --:--</span>
        <span v-else>{{mission.end_date|date}} à {{mission.end_time}}</span>
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
                  <input class="fr-input define-date-input" type="date" v-model="mission.start_date">
                </div>
              </div>
              <div class="fr-col-lg-4 fr-col-sm-6 fr-pl-1v">
                <div class="">
                  <input class="fr-input define-date-time-input define-date-input" type="time" v-model="mission.start_time">
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
                  <input class="fr-input define-date-input" type="date" v-model="mission.end_date">
                </div>
              </div>
              <div class="fr-col-4 fr-pl-1v">
                <div class="">
                  <input class="fr-input define-date-time-input define-date-input" type="time" v-model="mission.end_time">
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
    },
    mission: Object
  },
  methods: {
    isMissionChecked(checked) {
      $('.toggle-custom-' + this.id).toggleClass('d-none');
      $('.checkbox-group-' + this.id).toggleClass('main-task-active');
    },
    clearDate() {
      this.mission.start_date = null;
      this.mission.end_date = null;
      this.mission.start_time = null;
      this.mission.end_time = null;
    },
    getData() {
      this.$emit('input', this.mission)
    }
  },
  data() {
    return {
      id: this._uid
    }
  },
  filters: {
    date: function(date) {
      return moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY')
    }
  },
  mounted() {
    this.isMissionChecked(this.mission.checked)
  }
}
</script>

<style scoped>

</style>
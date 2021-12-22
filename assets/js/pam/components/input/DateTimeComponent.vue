<template>
    <div class=" fr-mr-4v" @change="getDateTime">
      <input
          type="date"
          v-model="date"
          v-bind:class="[
              error ? 'fr-input-invalid' : null,
              date && !error ? 'fr-input-valid' : null
          ]"
      >
      <input
          type="time"
          v-model="time"
          v-bind:class="[
              error ? 'fr-input-invalid' : null,
              time && !error ? 'fr-input-valid' : null
          ]"
      >
      <p class="fr-error-text" v-if="error">
        Merci de saisir une date et une heure
      </p>
    </div>
</template>

<script>
import moment from "moment";

export default {
  name: "DateTimeComponent",
  props: {
    value: String,
    error: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    getDateTime() {
      let dateTime = this.date;
      let format = 'YYYY-MM-DD';
      if(this.time) {
        format = null;
        dateTime = this.date + ' ' + this.time;
      }
       this.$emit('input', moment(dateTime).format(format));
    }
  },
  data() {
    return {
      date: this.value ? moment(this.value).format('YYYY-MM-DD') : null,
      time: this.value ? moment(this.value).format('HH:mm') : null
    }
  }
}
</script>

<style scoped>

</style>

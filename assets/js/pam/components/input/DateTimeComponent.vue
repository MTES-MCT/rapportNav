<template>
    <div class=" fr-mr-4v" @change="getDateTime">
      <input
          type="date"
          v-model="date">
      <input
          type="time"
          v-model="time">
    </div>
</template>

<script>
import moment from "moment";

export default {
  name: "DateTimeComponent",
  props: {
    value: String,
    valid: Boolean
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
  mounted() {

  },
  data() {
    return {
      date: this.value && moment(this.value).format('YYYY-MM-DD'),
      time: this.value && moment(this.value).format('HH:mm')
    }
  }
}
</script>

<style scoped>

</style>

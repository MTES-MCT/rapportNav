<template>
  <div class="datetimepicker__group" ref="datetimepicker">
    <input type="date"
           class="picker"
           v-bind:class="[
              error ? 'invalid' : null,
              date && !error ? 'valid' : null
          ]"
           v-model="date" >
    <input type="time"
           class="picker"
           v-bind:class="[
              error ? 'invalid' : null,
              time && !error ? 'valid' : null
          ]"
           v-model="time">
  </div>

</template>

<script>
import moment from 'moment';
export default {
  name: 'DateTimeComponent',
  props: {
    value: String,
    error: Boolean,
    id: String
  },
  mounted() {
  },
  methods: {
    emit() {
      this.$emit('input', this.datetime)
    }
  },
  data() {
    return {
      date: this.value ? moment(this.value).format('YYYY-MM-DD') : null,
      time: this.value ? moment(this.value).format('HH:mm') : null
    }
  },
  watch: {
    date: function(newVal, oldVal) {
      this.emit();
    },
    time: function(newVal, oldVal) {
      this.emit();
    }
  },
  computed: {
    datetime: function () {
      return `${this.date} ${this.time}`
    }
  }
}
</script>

<style scoped>

</style>

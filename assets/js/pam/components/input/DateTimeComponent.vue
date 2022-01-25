<template>
  <div class="date-picker" @click="toggleDatePicker($event)">
    <div class="selected-date" :data-value="selectedDateValue">{{ selectedDate }}</div>
    <div class="dates" ref="dates">
      <div class="month">
        <div class="arrows prev-mth" @click="goToPrevMonth">&lt;</div>
        <div class="mth">{{ currentMonth }}</div>
        <div class="arrows next-mth" @click="goToNextMonth">&gt;</div>
      </div>

      <div class="datepicker__week">
        <div v-for="weekDay in weekDays" :key="weekDay" class="datepicker__weekday">
          {{ weekDay }}
        </div>
      </div>

      <div class="datepicker__days">
        <div class="datepicker__day" :style="{width: getWeekStart() * 41 + 'px'}"></div>
        <div
            v-for="day in amountDays" :key="day"
            class="datepicker__day"
            v-bind:class="selectedDay === (day+1) && selectedYear === year && selectedMonth === month ? 'selected' : ''"
            @click="onSelectDate(day)">
          {{ day }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from 'moment';
export default {
  name: 'DateTimeComponent',
  props: {
    msg: String
  },
  mounted() {
    let date = new Date();
    let day = date.getDate();
    this.month = date.getMonth();
    this.year = date.getFullYear();
    this.selectedDay = day+1;
    this.selectedMonth = this.month;
    this.selectedYear = this.year;
    this.currentMonth = this.months[this.month] + ' ' + this.year;
    this.selectedDate = this.formatDate(date);

    this.populateDates();

  },
  methods: {
    populateDates() {
      this.amountDays = new Date(this.year, (this.month+1), 0).getDate();

    },
    formatDate(d) {
      let day = d.getDate();
      if (day < 10) {
        day = '0' + day;
      }

      let month = d.getMonth() + 1;
      if (month < 10) {
        month = '0' + month;
      }

      let year = d.getFullYear();
      return day + ' / ' + month + ' / ' + year;
    },
    onSelectDate(i) {
      const date = new Date(this.year + '-' + (this.month + 1) + '-' + i);
      this.selectedDay = (i + 1);
      this.selectedMonth = this.month;
      this.selectedYear = this.year;

      this.selectedDate = this.formatDate(date);
      this.selectedDateValue = date;
    },
    goToNextMonth () {
      this.month++;
      if (this.month > 11) {
        this.month = 0;
        this.year++;
      }
      this.currentMonth = this.months[this.month] + ' ' + this.year;
      this.populateDates();
    },
    goToPrevMonth () {
      this.month--;
      if (this.month < 0) {
        this.month = 11;
        this.year--;
      }
      this.currentMonth = this.months[this.month] + ' ' + this.year;
      this.populateDates();
    },
    toggleDatePicker (e) {
      if (!this.checkEventPathForClass(e.path, 'dates')) {
        this.$refs.dates.classList.toggle('active');
      }
    },
    checkEventPathForClass (path, selector) {
      for (let i = 0; i < path.length; i++) {
        if (path[i].classList && path[i].classList.contains(selector)) {
          return true;
        }
      }
      return false;
    },
    getWeekStart() {
      moment.locale('fr');
      return moment([this.year, this.month]).weekday();
    }
  },
  data() {
    return {
      currentMonth: null,
      selectedDate: null,
      selectedDateValue: null,
      selectedYear: null,
      selectedMonth: null,
      selectedDay: null,
      year: null,
      month: null,
      months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
      amountDays: null,
      weekDays: ['Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa', 'Di']
    }
  }
}
</script>

<style scoped>

</style>

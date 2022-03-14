<template>
  <div class="datetimepicker__group" ref="datetimepicker">
    <div class="datetimepicker">
      <div class="date-picker" :id="id">
        <div
            class="selected-date"
            v-bind:class="[
              error ? 'invalid' : null,
              date && !error ? 'valid' : null
          ]"
            @click="hidden = !hidden">
        <span v-if="date">
          {{ date|date('DD/MM/YYYY') }}
        </span>
          <span v-else>
          --/--/----
        </span>

          <i class="ri-calendar-fill datetimepicker__icon" aria-hidden="true"></i>
        </div>
        <div class="dates" ref="dates" v-if="!hidden" v-click-outside="hideTooltip" :id="id + '_dates'">
          <div class="month">
            <div class="arrows prev-mth" @click="goToPrevMonth">
              <i class="ri-arrow-left-s-line" aria-hidden="true"></i>
            </div>
            <div class="mth">{{ currentMonth }}</div>
            <div class="arrows next-mth" @click="goToNextMonth">
              <i class="ri-arrow-right-s-line" aria-hidden="true"></i>
            </div>
          </div>

          <div class="datepicker__week">
            <div v-for="weekDay in weekDays" :key="weekDay" class="datepicker__weekday">
              {{ weekDay }}
            </div>
          </div>

          <div class="datepicker__days" :id="id + '__days'">
            <div class="datepicker__day" :style="{width: getWeekStart() * 41 + 'px'}"></div>
            <div
                :id="id + '__day__' + index"
                v-for="(day, index) in amountDays" :key="day"
                class="datepicker__day"
                v-bind:class="selectedDay === (day+1) && selectedYear === year && selectedMonth === month ? 'selected' : ''"
                @click="onSelectDate(day)">
              {{ day }}
            </div>
          </div>
          <hr>
          <div class="timepicker">
            <span class="timepicker__label">
              <i class="ri-time-fill" aria-hidden="true"></i>
              Heure :
            </span>
            <div class="timepicker__input-group">
              <div class="timepicker__group__hour" :id="id + '_timepicker__group_hour'">
                <input type="number" min="0" max="23" @change="onChangeHour($event)" v-model="hour">
              </div>
              <div class="timepicker__group__minute" :id="id + '_timepicker__group_minute'">
                <input type="number" min="0" max="59" @change="onChangeMinute($event)" v-model="minute">
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="time-preview" @click="hidden = !hidden">
        <div
            v-bind:class="[
              error ? 'invalid' : null,
              time && !error ? 'valid' : null
          ]"
            class="selected-time">
          <span v-if="time">{{ time }}</span>
          <span v-else>--:--</span>
          <i class="ri-time-fill datetimepicker__icon" aria-hidden="true"></i>
        </div>
      </div>
    </div>
    <p class="error-text" v-if="error">
      Merci de saisir une date et une heure
    </p>
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
    let date = new Date();
    if(this.date) {
      date = new Date(this.value);
    }
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
      this.date = moment(date).format('YYYY-MM-DD');
      this.getDateTime(date);
      this.getDateTime();
      this.hidden = true;
    },
    onChangeHour(e) {
      let value = e.target.value;

      if(value > 23) {
        value = 23; // Prevent value to be greater than 23
      }

      let date = this.date;

      if(!date) {
        date = new Date().getDay(); //Prevent error message while user in filling hours but day is not filled yet
      }
      let time = date + ' ' + value + ':' + this.minute;
      this.time = moment(time).format('HH:mm');
      this.hour = value;
      this.getDateTime()
    },
    onChangeMinute(e) {
      let value = e.target.value;
      if(value < 10) {
        value = 0 + value;
      }
      let time = this.date + ' ' + this.hour + ':' + value;
      this.time = moment(time).format('HH:mm');
      this.minute = value;
      this.getDateTime()
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
      return moment([this.year, this.month]).weekday();
    },
    getDateTime(date) {
      let dateTime = date;
      let format = 'YYYY-MM-DD';
      if(this.time) {
        format = null;
        dateTime = this.date + ' ' + this.time;
      }

      this.$emit('input',  moment(dateTime).format(format));
    },
    hideTooltip(event) {
      if(!this.$refs.datetimepicker.contains(event.target)) {
        this.hidden = true;
      }
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
      weekDays: ['Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa', 'Di'],
      date: this.value ? moment(this.value).format('YYYY-MM-DD') : null,
      time: this.value ? moment(this.value).format('HH:mm') : null,
      hidden: true,
      hour: this.value ? moment(this.value).format('HH') : '00',
      minute: this.value ? moment(this.value).format('mm') : '00'
    }
  }
}
</script>

<style scoped>

</style>

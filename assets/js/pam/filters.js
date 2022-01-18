import Vue from "vue";
import moment from "moment";

Vue.filter('date', (date, format = 'DD/MM/YYYY') => date && moment(date).format(format));

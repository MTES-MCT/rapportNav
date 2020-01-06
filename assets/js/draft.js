import Vue from "vue";
import $ from "jquery";
import DraftList from "./DraftList";

$(document).ready(function () {
    Vue.component('draft-list', DraftList);

    new Vue({
        el: "#drafts",
        template: "<draft-list />",
        component: { DraftList },
        mounted: function() {

        }
    });
});
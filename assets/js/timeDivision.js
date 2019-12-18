import Vue from "vue";
import timeDivision from "./timeDivision.vue";
import $ from "jquery";

Vue.component('time-division', timeDivision);

$(document).ready(function () {

    new Vue({
        el: "#time-division",
        component: {timeDivision},
        data: {
            controleMer: null,
            controleTerre: null,
            controleAireProtegeeMer: null,
            controleAireProtegeeTerre: null,
            visiteSecurite: null,
            surveillanceManifestationMer: null,
            surveillanceManifestationTerre: null,
            surveillanceDpmMer: null,
            surveillanceDpmTerre: null,
        },
        mounted: function () {
            const rapport = $('#rapport-data').data('content') || {};
            if (1 > Object.keys(rapport).length) {
                return
            }
            // this.data = rapport.timeDivision;
            for (let [index, time] of Object.entries(rapport.timeDivision)) {
                    this[index] = time;
            }
        },
    });
});
import Vue from "vue";
import timeDivision from "./timeDivision.vue";
import vSelect from "vue-select";

Vue.component('time-division', timeDivision);

new Vue({
    el: "#time-division",
    component: { timeDivision },
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
    methods: {
        test: function (data) {
            console.log(data);
        }
    }
});
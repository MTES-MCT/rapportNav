import Vue from "vue";
import timeDivision from "./timeDivision.vue";
import $ from "jquery";

Vue.component('time-division', timeDivision);

$(document).ready(function() {

    new Vue({
        el: "#time-division",
        component: {timeDivision},
        data: {
            timeDivision: {
                controleMer: null,
                controleTerre: null,
                controleAerien: null,
                controleAireProtegeeMer: null,
                controleAireProtegeeTerre: null,
                controleAireProtegeeAerien: null,
                controlePollutionMer: null,
                controlePollutionTerre: null,
                controlePollutionAerien: null,
                controleEnvironnementMer: null,
                controleEnvironnementTerre: null,
                controleEnvironnementAerien: null,
                controleChlordeconeTotalMer: null,
                controleChlordeconeTotalTerre: null,
                controleChlordeconePartielMer: null,
                controleChlordeconePartielTerre: null,
                controleCroise: null,
                immigration: null,
                visiteSecurite: null,
                nombreVisiteSecurite: null,
                surveillanceManifestationMer: null,
                surveillanceManifestationTerre: null,
                surveillanceDpmMer: null,
                surveillanceDpmTerre: null,
                surete: null,
                maintienOrdre: null,
                assistance: null,
            }
        },
        created: function() {
            localStorage.setItem('timeDivision', JSON.stringify({timeDivision: {}}));
            let dataTD = null;
            const path = window.location.pathname;
            const pos =path.search(/draft\/[0-9]*/);
            if (-1 !== pos) {
                const drafts = JSON.parse(localStorage.getItem("draft"))
                let indexDraft = path.substring(pos+6);
                dataTD = drafts[indexDraft].timeDivision;
            } else {
                const rapport = $('#rapport-data').data('content') || {};
                if (!('timeDivision' in rapport)) {
                    return;
                }
                dataTD = rapport.timeDivision;
            }

            for (let [index, time] of Object.entries(dataTD)) {
                    this.timeDivision[index] = time;
            }
            localStorage.setItem('timeDivision', JSON.stringify(this.$data));
        },
        watch: {
            timeDivision: function() {
                this.localSave();
            },
        },
        methods: {
            localSave: function() {
                localStorage.setItem('timeDivision', JSON.stringify(this.$data));
            }
        }
    });
});
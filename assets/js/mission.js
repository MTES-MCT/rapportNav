import Vue from "vue";
import mission from './missioncomponent';

let vmission = new Vue({
    el: "#missions",
    data: {
        missions: {
            navire: {type:"navire", logo: "fas fa-ship", active: true, terrestre: false, zone:[], controles: {nombre: 0, pv: 0}, aireMarine: false},
            commerce: {type:"commerce",  logo: "fas fa-store", active: false, terrestre: true, zone:[], controles: {nombre: 0, pv: 0}},
            pechePied: {type:"pêcheurs à pied",  logo: "fas fa-shoe-prints", active: true, terrestre:true, zone:[], controles: {nombre: 0, pv: 0}},
            administratif: {type:"administratif",  logo: "far fa-file-alt", active: false,terrestre:true, zone:[]},
            formation: {type:"formation",  logo: "fas fa-graduation-cap", active: false,terrestre:true, zone:[]}
        }
    },
    components: {mission},
    methods: {
        deleteMission: function (index) {
            this.missions[index].active = false;
            this.missions[index].terrestre = false;
            this.missions[index].zone = [];
            if (undefined !== this.missions[index].controles) {
                this.missions[index].controles = {nombre: 0, pv: 0}
            }
        },
        addMission: function (index) {
            this.missions[index].active = true;
        },
        toggleAireMarine: function () {
            this.missions['navire'].aireMarine = !(this.missions['navire'].aireMarine);
        }
    }
});
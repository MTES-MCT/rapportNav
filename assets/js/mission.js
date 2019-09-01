import Vue from "vue";
import mission from './missioncomponent';
import $ from 'jquery';

$(document).ready(function () {
    let vmission = new Vue({
        el: "#main-container",
        data: {
            confirmBeforeLeave: true,
            missions: {
                navire: {
                    type: "navires",
                    logo: "fas fa-ship",
                    active: false,
                    terrestre: false,
                    zones: [],
                    typeMissionControle: 0,
                    controles: {nombre: 0, pv: 0},
                },
                commerce: {
                    type: "commerces",
                    logo: "fas fa-store",
                    active: false,
                    terrestre: true,
                    zones: [],
                    controles: {nombre: 0, pv: 0}
                },
                pechePied: {
                    type: "pêcheurs à pied",
                    logo: "fas fa-shoe-prints",
                    active: false,
                    terrestre: true,
                    zones: [],
                    controles: {nombre: 0, pv: 0}
                },
                administratif: {
                    type: "administratif",
                    logo: "far fa-file-alt",
                    active: false,
                    terrestre: true,
                    zones: []
                },
                formation: {type: "formation", logo: "fas fa-graduation-cap", active: false, terrestre: true, zones: []}
            }
        },
        components: {mission},
        mounted: function () {
            window.addEventListener('beforeunload', this.handleUnload);
        },
        created: function () {
            let missions = $('#missions-data').data('content');
            console.log(missions);
            for (let [index, mission] of Object.entries(missions)) {
                console.log(index, mission);
                for (let [property, val] of Object.entries(mission)) {
                    this.missions[index][property] = val;
                }
                this.missions[index].active = true;
            }
        },
        methods: {
            deleteMission: function (index) {
                this.missions[index].active = false;
                this.missions[index].terrestre = false;
                this.missions[index].zones = [];
                if (undefined !== this.missions[index].controles) {
                    this.missions[index].controles = {nombre: 0, pv: 0}
                }
            },
            addMission: function (index) {
                this.missions[index].active = true;
            },
            handleUnload: function (event) {
                if (!this.confirmBeforeLeave) {
                    return true;
                }
                event.returnValue = "Si vous quittez cette page les données non enregistrées seront perdues. \nVoulez-vous continuer ?";
                return "Si vous quittez cette page les données non enregistrées seront perdues. \nVoulez-vous continuer ?";
            },
            doNotConfirmLeave: function () {
                this.confirmBeforeLeave = false;
            }
        }
    });
});
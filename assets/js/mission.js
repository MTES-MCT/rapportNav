import Vue from "vue";
import mission from './missioncomponent';
import $ from 'jquery';
import RapportTopic from "./rapportTopic";
import params from "./params";

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
                    controles: []
                },
                commerce: {
                    type: "commerces",
                    logo: "fas fa-store",
                    active: false,
                    terrestre: true,
                    zones: [],
                    controles: []
                },
                pechePied: {
                    type: "pêcheurs à pied",
                    logo: "fas fa-shoe-prints",
                    active: false,
                    terrestre: true,
                    zones: [],
                    controles: []
                },
                administratif: {
                    type: "administratif",
                    logo: "far fa-file-alt",
                    active: false,
                    terrestre: true,
                    zones: []
                },
                formation: {type: "formation", logo: "fas fa-graduation-cap", active: false, terrestre: true, zones: []}
            },
            rapportNavire: new RapportTopic("navire")
        },
        components: {mission},
        mounted: function () {
            window.addEventListener('beforeunload', this.handleUnload);
        },
        created: function () {
            let missions = $('#missions-data').data('content');
            for (let [index, mission] of Object.entries(missions)) {
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
            },
            addControle: function() {
                this.missions['navire'].controles.push(
                    {
                        'navire': {"immatriculationFr": null, "nom": null, "longueurHorsTout": null, "typeUsage": null},
                        'controles': [],
                        'methodeCiblage': null,
                        'pv': false,
                        'natinfs': [],
                        'commentaire': null
                    }
                );
                $('select[name=mission_navire[navires][__name__][natinfs][]').select2({
                    minimumInputLength: 3,
                    ajax: {
                        url: function (data) {
                            return params.apiNatinf + 'natinfs/' + data.term;
                        },
                        data: {},
                        delay: 250,
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                                results: [{
                                    "id": data.natinf,
                                    "text": data.natinf
                                }]
                            };
                        }
                    }
                });
            },
            removeControle: function(index) {
                this.missions['navire'].controles.splice(index, 1);
            },
            getNavireData: function (index, event) {
                let currentNavire = this.missions['navire'].controles[index].navire;
                let input = $(event.target), plaisance = false;
                if("" === input.val()) {
                    return;
                }
                $.get(params.apiNavires + "navires/" + input.val())
                    .catch(function (reason) {
                        console.log("Immatriculation non trouvée dans Navires (err. " + reason.status + ")");
                        plaisance = true;
                        return $.get(params.apiNavires + "plaisances/" + input.val())
                    })
                    .catch(function (data) {
                        if (input.parent().find(".immatriculation_invalide")) {
                            input.parent().find(".immatriculation_invalide").remove();
                        }

                        if (data.status === 404) {
                            input.parent().first().append('<p class="immatriculation_invalide">Immatriculation invalide</p>');
                        } else {
                            input.parent().first().append('<p class="immatriculation_invalide">Erreur ' + data.status + ' lors de la récupération des informations</p>');
                        }

                        currentNavire.nom = "";
                        currentNavire.longueurHorsTout = "";
                        currentNavire.typeUsage = "";
                    })
                    .then(function (data) {
                        let parent = input.parents("li");
                        currentNavire.nom = data.nomNavire;
                        currentNavire.longueurHorsTout = data.longueurHorsTout;
                        if(!plaisance) {
                            parent.find("input[id$=_navire_typeUsage]").val(data.genreNavigation || "Inconnu");
                            currentNavire.typeUsage = data.genreNavigation || "Inconnu";
                        } else {
                            currentNavire.typeUsage = "Plaisance";
                        }
                        if (input.parent().find(".immatriculation_invalide")) {
                            input.parent().find(".immatriculation_invalide").remove();
                        }
                    })
            },
            getNatinfData: function() {

            }
        }
    });
});
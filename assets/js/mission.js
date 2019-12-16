import Vue from "vue";
import mission from './missioncomponent';
import $ from 'jquery';
import RapportTopic from "./rapportTopic";
import params from "./params";
import vSelect from 'vue-select'

import 'vue-select/dist/vue-select.css';

Vue.component('v-select', vSelect);

$(document).ready(function () {
    new Vue({
        el: "#missions",
        data: {
            missions: {
                navire: {
                    type: "navires",
                    logo: "fas fa-ship",
                    active: false,
                    terrestre: false,
                    zones: [],
                    typeMissionControle: 0,
                    controles: [],
                    commentaire: null
                },
                commerce: {
                    type: "commerces",
                    logo: "fas fa-store",
                    active: false,
                    terrestre: true,
                    zones: [],
                    controles: [],
                    commentaire: null
                },
                pechePied: {
                    type: "pêcheurs à pied",
                    logo: "fas fa-shoe-prints",
                    active: false,
                    terrestre: true,
                    zones: [],
                    controles: [],
                    commentaire: null
                },
                loisir: {
                    type: "loisirs",
                    logo: "fas fa-swimmer",
                    active: false,
                    terrestre: false,
                    zones: [],
                    controles: [],
                    commentaire: null
                },
                secours: {
                    type: "sauvetage et assistance",
                    logo: "fas fa-life-ring",
                    active: false,
                    terrestre: false,
                    zones: [],
                    dureeSecours: null,
                    commentaire: null
                },
                administratif: {
                    type: "administratif",
                    logo: "far fa-file-alt",
                    active: false,
                    terrestre: true,
                    zones: [],
                    controles: [],
                    commentaire: null
                },
                formation: {
                    type: "formation",
                    logo: "fas fa-graduation-cap",
                    active: false,
                    terrestre: true,
                    zones: [],
                    formation: "",
                    commentaire: null
                }
            },
            natinfsOptions: [],
            rapportNavire: new RapportTopic("navire")
        },
        components: {mission},
        created: function () {
            const missions = $('#missions-data').data('content') || {};
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
                    this.missions[index].controles = [];
                }
            },
            addMission: function (index) {
                this.missions[index].active = true;
            },
            addControle: function (type) {
                let newControle = {
                    'methodeCiblage': null,
                    'pv': false,
                    'natinfs': [],
                    'commentaire': null
                };

                switch (type) {
                    case 'navire':
                        newControle['navire'] = {
                            "immatriculationFr": null,
                            "nom": null,
                            "longueurHorsTout": null,
                            "typeUsage": null
                        };
                        newControle['controles'] = [];
                        newControle['aireProtegee'] = false;
                        break;
                    case 'commerce':
                        newControle['etablissement'] = {"nom": null, "adresse": null, "commune": null, "type": null};
                        newControle['bateauxControles'] = null;
                        break;
                    case 'pechePied':
                        newControle['pecheurPied'] = {"nom": null, "prenom": null, "estPro": false};
                        newControle['aireProtegee'] = false;
                        break;
                    case 'loisir':
                        newControle['nombreControle'] = 0;
                        newControle['nombreControleAireProtegee'] = 0;
                        newControle['nombrePv'] = 0;
                        break;
                }


                this.missions[type].controles.push(newControle);
            },
            removeControle: function (type, index) {
                this.missions[type].controles.splice(index, 1);
            },
            getNavireData: function (index, event) {
                let currentNavire = this.missions['navire'].controles[index].navire, plaisance = false;
                const input = $(event.target);
                if ("" === input.val()) {
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
                        const parent = input.parents("li");
                        currentNavire.nom = data.nomNavire;
                        currentNavire.longueurHorsTout = data.longueurHorsTout;
                        if (!plaisance) {
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
            getNatinfData: function (search, loading) {
                loading(true);
                let vm = this;
                $.ajax({
                    url: params.apiNatinf + 'natinfs/' + search,
                    data: {},
                    dataType: 'json',
                })
                    .then(function (data) {
                        vm.natinfsOptions.push(data.natinf);
                        loading(false);
                    })
                ;
            },
            localSave: function () {
                localStorage.setItem('missions', JSON.stringify(this.missions))
            }
        }
    });
});
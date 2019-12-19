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
            error: false,
            errorList: [],
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
            const rapport = $('#rapport-data').data('content') || {};
            if('error' in rapport) {
                this.error = rapport.error;
                if('error_where' in rapport) {
                    this.errorList.push(rapport.error_where);
                }
                console.log(localStorage.getItem('missions'));
                this.missions = JSON.parse(localStorage.getItem('missions'));
                console.log(this.missions);
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
                            'immatriculationInvalide': false,
                            'erreurApiImmatriculation': false,
                            "etranger": false,
                            "pavillon": "Français",
                            "nom": null,
                            "longueurHorsTout": null,
                            "typeUsage": null,
                            "categorieControleNavire": null,
                        };
                        newControle['controles'] = [];
                        newControle['aireProtegee'] = false;
                        newControle['date'] = new Date();
                        break;
                    case 'commerce':
                        newControle['etablissement'] = {"nom": null, "adresse": null, "commune": null, "type": null};
                        newControle['bateauxControles'] = null;
                        newControle['date'] = new Date();
                        break;
                    case 'pechePied':
                        newControle['pecheurPied'] = {"nom": null, "prenom": null, "estPro": false};
                        newControle['aireProtegee'] = false;
                        newControle['date'] = new Date();
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
            getNavireData: function (index) {
                let currentNavire = this.missions['navire'].controles[index].navire, plaisance = false;
                const input = this.$refs.controle_navire_immatriculation[index];
                currentNavire.immatriculationInvalide = false;
                currentNavire.erreurApiImmatriculation = false;
                if ("" === input.value) {
                    return;
                }
                $.get(params.apiNavires + "navires/" + input.value)
                    .catch(function (reason) {
                        console.log("Immatriculation non trouvée dans Navires (err. " + reason.status + ")");
                        plaisance = true;
                        return $.get(params.apiNavires + "plaisances/" + input.value)
                    })
                    .catch(function (data) {
                        if (data.status === 404) {
                            currentNavire.immatriculationInvalide = true;
                        } else {
                            currentNavire.erreurApiImmatriculation = true;
                        }

                        currentNavire.nom = "";
                        currentNavire.longueurHorsTout = "";
                        currentNavire.typeUsage = "";
                    })
                    .then(function (data) {
                        currentNavire.nom = data.nomNavire;
                        currentNavire.longueurHorsTout = data.longueurHorsTout;
                        currentNavire.immatriculationInvalide = false;
                        currentNavire.erreurApiImmatriculation = false;
                        if (!plaisance) {
                            currentNavire.typeUsage = data.genreNavigation || "Inconnu";
                        } else {
                            currentNavire.typeUsage = "Plaisance";
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
            toggleEtranger: function(index) {
                let currentNavire = this.missions['navire'].controles[index].navire;
                if(currentNavire.etranger) {
                    currentNavire.pavillon = "";
                } else {
                    currentNavire.pavillon = "Français";
                    this.getNavireData(index);
                }

            },
            localSave: function () {
                localStorage.setItem('missions', JSON.stringify(this.missions))
            }
        }
    });
});
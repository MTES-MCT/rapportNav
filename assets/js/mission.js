import Vue from "vue";
import $ from 'jquery';
import moment from 'moment';

import mission from './missioncomponent';
import params from "./params";
import vSelect from 'vue-select'
import inputDateTime from "./inputDateTime";
import { camelToSnake } from "./stringManipulationHelper";

import 'vue-select/dist/vue-select.css';

Vue.component('v-select', vSelect);
Vue.component('input-date-time', inputDateTime);

$(document).ready(function() {
    new Vue({
        el: "#missions",
        data: {
            missions: {
                navire: {
                    type: "Contrôles de navires",
                    logo: "fas fa-ship",
                    active: false,
                    terrestre: true,
                    zones: [],
                    controleSansPv: {
                        nombreControle: 0,
                        nombreControleAireProtegee: 0,
                        controles: []
                    },
                    typeMissionControle: 0,
                    controles: [],
                    commentaire: null
                },
                commerce: {
                    type: "Contrôles d'établissements",
                    logo: "fas fa-store",
                    active: false,
                    terrestre: true,
                    zones: [],
                    controles: [],
                    commentaire: null
                },
                pechePied: {
                    type: "Contrôle de pêcheurs à pied",
                    logo: "fas fa-shoe-prints",
                    active: false,
                    terrestre: true,
                    zones: [],
                    controles: [],
                    commentaire: null
                },
                loisir: {
                    type: "Contrôles de loisirs",
                    logo: "fas fa-swimmer",
                    active: false,
                    terrestre: false,
                    zones: [],
                    controles: [],
                    commentaire: null
                },
                autre: {
                    type: "Autres contrôles",
                    logo: "fas fa-id-card",
                    active: false,
                    terrestre: true,
                    zones: [],
                    controles: [],
                    commentaire: null
                },
                secours: {
                    type: "Sauvetage et assistance",
                    logo: "fas fa-life-ring",
                    active: false,
                    terrestre: false,
                    zones: [],
                    dureeSecours: null,
                    commentaire: null
                },
                administratif: {
                    type: "Activités administratives",
                    logo: "far fa-file-alt",
                    active: false,
                    terrestre: true,
                    zones: [],
                    controles: [],
                    commentaire: null
                },
                formation: {
                    type: "Activités de formation",
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
        },
        components: {mission},
        created: function() {
            const missions = $('#missions-data').data('content') || {};
            for(let [index, mission] of Object.entries(missions)) {
                for(let [property, val] of Object.entries(mission)) {
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
                this.missions = JSON.parse(localStorage.getItem('missions'));
            }
        },
        methods: {
            deleteMission: function(index) {
                this.missions[index].active = false;
                this.missions[index].terrestre = false;
                this.missions[index].zones = [];
                if(undefined !== this.missions[index].controles) {
                    this.missions[index].controles = [];
                }
            },
            addMission: function(index) {
                this.missions[index].active = true;
            },
            addControle: function(type) {
                let newControle = {
                    'methodeCiblage': null,
                    'pv': false,
                    'natinfs': [],
                    'commentaire': null
                };

                let now = new moment();
                switch(type) {
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
                        newControle['date'] = now.format("YYYY-MM-DD HH:mm");
                        break;
                    case 'commerce':
                        newControle['etablissement'] = {"nom": null, "adresse": null, "commune": null, "type": null};
                        newControle['bateauxControles'] = null;
                        newControle['date'] = now.format("YYYY-MM-DD HH:mm");
                        break;
                    case 'pechePied':
                        newControle['pecheurPied'] = {"nom": null, "prenom": null, "estPro": false};
                        newControle['aireProtegee'] = false;
                        newControle['date'] = now.format("YYYY-MM-DD HH:mm");
                        break;
                    case 'autre':
                        newControle['nombreControle'] = 0;
                        newControle['nombrePv'] = 0;
                        break;
                    case 'loisir':
                        newControle['nombreControle'] = 0;
                        newControle['nombreControleAireProtegee'] = 0;
                        newControle['nombrePv'] = 0;
                        break;
                }


                this.missions[type].controles.push(newControle);
            },
            getTagName: function(type, index, name) {
                return "mission_"+type+"_"+type+"s_"+index+"_"+name;
            },
            removeControle: function(type, index) {
                this.missions[type].controles.splice(index, 1);
            },
            getNavireData: function(index) {
                let currentNavire = this.missions['navire'].controles[index].navire, plaisance = false;
                const input = this.$refs.controle_navire_immatriculation[index];
                currentNavire.immatriculationInvalide = false;
                currentNavire.erreurApiImmatriculation = false;
                if("" === input.value) {
                    return;
                }
                $.get(params.apiNavires + "navires/" + input.value)
                    .catch(function(reason) {
                        console.log("Immatriculation non trouvée dans Navires (err. " + reason.status + ")");
                        plaisance = true;
                        return $.get(params.apiNavires + "plaisances/" + input.value)
                    })
                    .catch(function(data) {
                        if(data.status === 404) {
                            currentNavire.immatriculationInvalide = true;
                        } else {
                            currentNavire.erreurApiImmatriculation = true;
                        }

                        currentNavire.nom = "";
                        currentNavire.longueurHorsTout = "";
                        currentNavire.typeUsage = "";
                    })
                    .then(function(data) {
                        currentNavire.nom = data.nomNavire;
                        currentNavire.longueurHorsTout = data.longueurHorsTout;
                        currentNavire.immatriculationInvalide = false;
                        currentNavire.erreurApiImmatriculation = false;
                        if(!plaisance) {
                            currentNavire.typeUsage = data.genreNavigation || "Inconnu";
                        } else {
                            currentNavire.typeUsage = "Plaisance";
                        }
                    })
            },
            getNatinfData: function(search, loading) {
                loading(true);
                let vm = this;
                $.ajax({
                    url: params.apiNatinf + 'natinfs/' + search,
                    data: {},
                    dataType: 'json',
                })
                    .then(function(data) {
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
            updateBateaux: function($event, index) {
                if(undefined !== $event.target.options[$event.target.selectedIndex].dataset.complement) {
                    this.missions['commerce'].controles[index].bateauxControles = 0;
                } else {
                    this.bateauxControles = null;
                }
            },
            localSave: function() {
                localStorage.setItem('missions', JSON.stringify(this.missions))
            },
            validate: function() {
                let isValid = document.getElementById("rapport").checkValidity();
                this.error=isValid;
                this.errorList=[];
                if(!isValid) {
                    let invalidList = $("*:invalid");
                    for(let index=0 ; index < invalidList.length; index++) {
                        if("rapport" !== invalidList[index].id) {
                            for(let type in this.missions) {
                                let patt=new RegExp(camelToSnake(type), "i");
                                if(null !== patt.exec(invalidList[index].id)) {
                                    this.error=true;
                                    this.errorList.push(type);
                                }
                            }
                        }
                    }
                }
            }
        }
    });
});
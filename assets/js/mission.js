import Vue from "vue";
import $ from 'jquery';
import moment from 'moment';

import mission from './missioncomponent';
import params from "./params";
import vSelect from 'vue-select'
import inputDateTime from "./inputDateTime";
import {camelToSnake} from "./stringManipulationHelper";

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
                    zones: [],
                    controleSansPv: {
                        nombreControle: 0,
                        nombreControleAireProtegee: 0,
                        controles: []
                    },
                    controles: [],
                    commentaire: null
                },
                commerce: {
                    type: "Contrôles d'établissements",
                    logo: "fas fa-store",
                    active: false,
                    zones: [],
                    controles: [],
                    commentaire: null
                },
                pechePied: {
                    type: "Contrôle de pêcheurs à pied",
                    logo: "fas fa-shoe-prints",
                    active: false,
                    zones: [],
                    controlePlaisanceSansPv: {
                        nombreControle: 0,
                        nombreControleAireProtegee: 0,
                        nombreControleChlordeconeTotale: 0,
                        nombreControleChlordeconePartiel: 0,
                    },
                    controleProSansPv: {
                        nombreControle: 0,
                        nombreControleAireProtegee: 0,
                        nombreControleChlordeconeTotale: 0,
                        nombreControleChlordeconePartiel: 0,
                    },
                    controles: [],
                    commentaire: null
                },
                loisir: {
                    type: "Contrôles de loisirs",
                    logo: "fas fa-swimmer",
                    active: false,
                    zones: [],
                    controles: [],
                    commentaire: null
                },
                autre: {
                    type: "Autres contrôles",
                    logo: "fas fa-id-card",
                    active: false,
                    zones: [],
                    controles: [],
                    commentaire: null
                },
                secours: {
                    type: "Sauvetage et assistance",
                    logo: "fas fa-life-ring",
                    active: false,
                    zones: [],
                    dureeSecours: null,
                    commentaire: null
                },
                administratif: {
                    type: "Activités administratives",
                    logo: "far fa-file-alt",
                    active: false,
                    zones: [],
                    controles: [],
                    commentaire: null
                },
                formation: {
                    type: "Activités de formation",
                    logo: "fas fa-graduation-cap",
                    active: false,
                    zones: [],
                    formation: "",
                    commentaire: null
                }
            },
            error: false,
            errorList: {},
            natinfsOptions: [],
        },
        components: {mission},
        created: function() {
            localStorage.setItem('missions', JSON.stringify(this.missions));
            const path = window.location.pathname;
            const pos = path.search(/draft\/[0-9]*/);
            let missions = {};

            if(-1 !== pos) {
                //we ar editing a draft
                const drafts = JSON.parse(localStorage.getItem("draft"));
                let index = path.substring(pos + 6);
                if(undefined === drafts[index].missions.navire ||
                    undefined === drafts[index].missions.commerce ||
                    undefined === drafts[index].missions.pechePied ||
                    undefined === drafts[index].missions.loisir ||
                    undefined === drafts[index].missions.autre ||
                    undefined === drafts[index].missions.secours ||
                    undefined === drafts[index].missions.administratif ||
                    undefined === drafts[index].missions.formation) {
                    this.error = true;
                    this.errorList["draft"] =
                        ["Les activités du brouillon semblent contenir des erreurs (ou le brouillon ne contenait pas d'activités), "+
                            "il est possible que des éléments n'aient pas été restaurés. "];
                }
                missions = drafts[index].missions || {};
            } else {
                // Getting pre-loaded data from server (if any)
                missions = $('#missions-data').data('content') || {};
            }

            //Polyfill for Object.entries for old browsers
            if(!Object.entries) {
                Object.entries = function(obj) {
                    var ownProps = Object.keys(obj),
                        i = ownProps.length,
                        resArray = new Array(i); // preallocate the Array
                    while(i--)
                        resArray[i] = [ownProps[i], obj[ownProps[i]]];
                    return resArray;
                };
            }

            for(let [index, mission] of Object.entries(missions)) {
                for(let [property, val] of Object.entries(mission)) {
                    if(("controleProSansPv" === property || "controlePlaisanceSansPv" === property) && null === val) {
                        this.missions[index][property] = {
                            nombreControle: 0,
                            nombreControleAireProtegee: 0,
                            nombreControleChlordeconeTotale: 0,
                            nombreControleChlordeconePartiel: 0,
                        };
                    } if (("controleSansPv" === property) && null === val) {
                        this.missions[index][property] = {
                            nombreControle: 0,
                            nombreControleAireProtegee: 0,
                            controles: []
                        };
                    } else {
                        this.missions[index][property] = val;
                    }
                }
            }
            const rapport = $('#rapport-data').data('content') || {};
            if('error' in rapport && true === rapport['error']) {
                this.error = rapport.error;
                if('error_where' in rapport) {
                    this.errorList = rapport.error_where;
                }
            }
        },
        methods: {
            deleteMission: function(index) {
                this.missions[index].active = false;
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
                            "isDeroutement": false,
                            "deroutement": null,
                        };
                        newControle['controles'] = [];
                        newControle['detailControle'] = null;
                        newControle['showDetail'] = false;
                        newControle['aireProtegee'] = false;
                        newControle['date'] = now.format("YYYY-MM-DD HH:mm");
                        const nbControles = this.missions['navire'].controles.length;
                        newControle['terrestre'] = nbControles > 0 ? this.missions['navire'].controles[nbControles - 1].terrestre : true;
                        newControle['lat'] = null;
                        newControle['long'] = null;
                        break;
                    case 'commerce':
                        newControle['etablissement'] = {"nom": null, "adresse": null, "commune": null, "type": null, 'detailCategorieEtablissement': null, 'showDetail': false};
                        newControle['bateauxControles'] = null;
                        newControle['date'] = now.format("YYYY-MM-DD HH:mm");
                        break;
                    case 'pechePied':
                        newControle['pecheurPied'] = {"nom": null, "prenom": null, "estPro": false};
                        newControle['aireProtegee'] = false;
                        newControle['chloredeconeTotal'] = false;
                        newControle['chloredeconePartiel'] = false;
                        newControle['date'] = now.format("YYYY-MM-DD HH:mm");
                        newControle['terrestre'] = true;
                        break;
                    case 'autre':
                        newControle['nombreControle'] = 0;
                        newControle['nombrePv'] = 0;
                        newControle['nombreDetruit'] = null;
                        newControle['nombreChlordecone'] = null;
                        break;
                    case 'loisir':
                        newControle['detailLoisir'] = null;
                        newControle['showDetail'] = false;
                        newControle['nombreControle'] = 0;
                        newControle['nombreControleAireProtegee'] = 0;
                        newControle['nombrePv'] = 0;
                        break;
                    case 'administratif':
                        newControle = {'tache': null, 'detailTache': null, 'showDetail': false, 'nombreDossiers': null, 'dureeTache': null};
                        break;
                }

                this.missions[type].controles.push(newControle);
            },
            getTagName: function(type, index, name) {
                return "mission_" + type + "_" + type + "s_" + index + "_" + name;
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
                    this.missions['commerce'].controles[index].bateauxControles = null;
                }
            },
            updateAdministratif: function($event, index) {
                if(undefined !== $event.target.options[$event.target.selectedIndex].dataset.complement) {
                    this.missions['administratif'].controles[index].nombreDossiers = 0;
                } else {
                    this.missions['administratif'].controles[index].nombreDossiers = null;
                }
            },
            updateAutre: function($event, index) {
                if(undefined === $event.target.options[$event.target.selectedIndex].dataset.complement) {
                    this.missions['autre'].controles[index].nombreChlordecone = null;
                    this.missions['autre'].controles[index].nombreDetruit = null;
                } else if("chlordecone" === $event.target.options[$event.target.selectedIndex].dataset.complement) {
                    this.missions['autre'].controles[index].nombreDetruit = null;
                    this.missions['autre'].controles[index].nombreChlordecone = 0;
                } else if("detruit" === $event.target.options[$event.target.selectedIndex].dataset.complement) {
                    this.missions['autre'].controles[index].nombreDetruit = 0;
                    this.missions['autre'].controles[index].nombreChlordecone = null;
                }
            },
            updateDeroutement: function($event, index) {
                if(this.missions['navire'].controles[index].isDeroutement) {

                } else {
                    this.missions['navire'].controles[index].deroutement = null;
                }
            },
            toggleCheckAutre: function($event, index) {
                this.missions['navire'].controles[index].showDetail = !!$event.target.checked;
            },
            toggleSelectAutre: function(subject, $event, index) {
                this.missions[subject].controles[index].showDetail = "Autre" === $event.target.options[$event.target.selectedIndex].innerText;
            },
            localSave: function() {
                localStorage.setItem('missions', JSON.stringify(this.missions))
            },
            validate: function() {
                let isValid = document.getElementById("rapport").checkValidity();
                this.error = isValid;
                this.errorList = {};
                if(!isValid) {
                    this.error = true;
                    let invalidList = $("*:invalid");
                    for(let type in this.missions) {
                        let i = 0;
                        let patt = new RegExp(camelToSnake(type), "i");
                        for(let index = 0; index < invalidList.length; index++) {
                            if("rapport" !== invalidList[index].id) {
                                if(null !== patt.exec(invalidList[index].id)) {
                                    i++;
                                    this.errorList[type] = [i + " erreur" + (i > 0 ? "s. " : ". ")];
                                }
                            }
                        }
                    }
                }
            }
        }
    });
});
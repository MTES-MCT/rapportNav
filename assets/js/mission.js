import Vue from "vue";
import $ from 'jquery';
import moment from 'moment';

import activite from './ActiviteComponent';
import params from "./params";
import vSelect from 'vue-select'
import inputDateTime from "./inputDateTime";
import {camelToSnake} from "./stringManipulationHelper";
import * as update from "./helper/update";
import 'vue-select/dist/vue-select.css';

Vue.component('v-select', vSelect);
Vue.component('input-date-time', inputDateTime);

$(document).ready(function() {
    new Vue({
        el: "#activites",
        data: {
            activites: {
                navire: {
                    type: "Contrôles de navires",
                    logo: "fas fa-ship",
                    active: false,
                    zones: [],
                    controleSansPv: {
                        nombreControleMer: 0,
						nombreControleTerre: 0,
                        nombreControleAireProtegee: 0,
                        controleNavireRealises: []
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
                        nombreControleChlordeconePartiel: 0
                    },
                    controleProSansPv: {
                        nombreControle: 0,
                        nombreControleAireProtegee: 0,
                        nombreControleChlordeconeTotale: 0,
                        nombreControleChlordeconePartiel: 0
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
                    formateur: false,
                    commentaire: null
                }
            },
            error: false,
            errorList: {},
            natinfsOptions: []
        },
        components: {activite},
        created: function() {
            const path = window.location.pathname;
            const pos = path.search(/draft\/[0-9]*/);
            let activites = {};

            if(-1 !== pos) {
                //we are editing a draft
                let drafts = JSON.parse(localStorage.getItem("draft"));
                let index = path.substring(pos + 6);
                // Parsing old version of drafts ?
                if(undefined === drafts[index].activites && undefined !== drafts[index].missions) {
                    drafts = update.draftsFrom0_9_0to0_10_0(drafts);
                }
                if(undefined === drafts[index].activites.navire ||
                    undefined === drafts[index].activites.commerce ||
                    undefined === drafts[index].activites.pechePied ||
                    undefined === drafts[index].activites.loisir ||
                    undefined === drafts[index].activites.autre ||
                    undefined === drafts[index].activites.secours ||
                    undefined === drafts[index].activites.administratif ||
                    undefined === drafts[index].activites.formation) {
                    this.error = true;
                    this.errorList["draft"] =
                        ["Les activités du brouillon semblent contenir des erreurs (ou le brouillon ne contenait pas d'activités), "+
                            "il est possible que des éléments n'aient pas été restaurés. "];
                }
                activites = drafts[index].activites || {};
            } else {
                // Getting pre-loaded data from server (if any)
                activites = $('#activites-data').data('content') || {};
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

            for(let [index, activite] of Object.entries(activites)) {
                for(let [property, val] of Object.entries(activite)) {
                    if(("controleProSansPv" === property || "controlePlaisanceSansPv" === property) && null === val) {
                        this.activites[index][property] = {
                            nombreControle: 0,
                            nombreControleAireProtegee: 0,
                            nombreControleChlordeconeTotale: 0,
                            nombreControleChlordeconePartiel: 0
                        };
                    } if (("controleSansPv" === property) && null === val) {
                        this.activites[index][property] = {
                            nombreControleMer: 0,
							nombreControleTerre: 0,
                            nombreControleAireProtegee: 0,
                            controles: []
                        };
                    } else {
                        this.activites[index][property] = val;
                    }
                }
                if(-1 === pos) {
                    this.activites[index].active = true;
                }
            }

            // Loading is finished, writing to storage
            localStorage.setItem('activites', JSON.stringify(this.activites));
            //If old temporary object is still present, remove it (this is due to update to v0.10.0)
            if(localStorage.getItem('missions')) {
                localStorage.removeItem('missions');
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
            deleteActivite: function(index) {
                this.activites[index].active = false;
                this.activites[index].zones = [];
                if(undefined !== this.activites[index].controles) {
                    this.activites[index].controles = [];
                }
            },
            addActivite: function(index) {
                this.activites[index].active = true;
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
                            "immatriculation": null,
                            'immatriculationInvalide': false,
                            'erreurApiImmatriculation': false,
                            "etranger": false,
                            "pavillon": "Français",
                            "nom": null,
                            "longueurHorsTout": null,
                            "genreNav": null,
                            "categorieUsageNavire": null,
                            "isDeroutement": false,
                            "deroutement": null
                        };
                        newControle['controleNavireRealises'] = [];
                        newControle['pingerApplicable'] = false;
                        newControle['pingerPresent'] = null;
                        newControle['detailControle'] = null;
                        newControle['showDetail'] = false;
                        newControle['aireProtegee'] = false;
                        newControle['date'] = now.format("YYYY-MM-DD HH:mm");
                        const nbControles = this.activites['navire'].controles.length;
                        newControle['terrestre'] = nbControles > 0 ? this.activites['navire'].controles[nbControles - 1].terrestre : true;
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

                this.activites[type].controles.push(newControle);
            },
            getTagName: function(type, index, name) {
                return "activite_" + type + "_" + type + "s_" + index + "_" + name;
            },
            removeControle: function(type, index) {
                this.activites[type].controles.splice(index, 1);
            },
            getNavireData: function(index) {
                let currentNavire = this.activites['navire'].controles[index].navire, plaisance = false;
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
						//Note that for plaisance only immatriculation may conatain an upper case letter
                        return $.get(params.apiNavires + "plaisances/" + input.value.toUpperCase());
                    })
                    .catch(function(data) {
                        if(data.status === 404) {
                            currentNavire.immatriculationInvalide = true;
                        } else {
                            currentNavire.erreurApiImmatriculation = true;
                        }

                        currentNavire.nom = "";
                        currentNavire.longueurHorsTout = "";
                        currentNavire.genreNav = "";
                    })
                    .then(function(data) {
                        currentNavire.nom = data.nomNavire;
                        currentNavire.longueurHorsTout = data.longueurHorsTout;
                        currentNavire.immatriculationInvalide = false;
                        currentNavire.erreurApiImmatriculation = false;
                        if(!plaisance) {
                            currentNavire.genreNav = data.genreNavigation || "Inconnu";
                        } else {
                            currentNavire.genreNav = "Plaisance";
                        }
                    });
            },
            getNatinfData: function(search, loading) {
                loading(true);
                let vm = this;
                $.ajax({
                    url: params.apiNatinf + 'natinfs/' + search,
                    data: {},
                    dataType: 'json'
                })
                    .then(function(data) {
                        vm.natinfsOptions.push(data.natinf);
                        loading(false);
                    })
                ;
            },
            toggleEtranger: function(index) {
                let currentNavire = this.activites['navire'].controles[index].navire;
                if(currentNavire.etranger) {
                    currentNavire.pavillon = "";
                } else {
                    currentNavire.pavillon = "Français";
                    this.getNavireData(index);
                }
            },
            togglePinger: function(index) {
                let CurrentControle = this.activites['navire'].controles[index];
                if(CurrentControle.pingerApplicable) {
                    CurrentControle.pingerPresent = false;
                } else {
                    CurrentControle.pingerPresent = null;
                }
            },
            updateBateaux: function($event, index) {
                if(undefined !== $event.target.options[$event.target.selectedIndex].dataset.complement) {
                    this.activites['commerce'].controles[index].bateauxControles = 0;
                } else {
                    this.activites['commerce'].controles[index].bateauxControles = null;
                }
            },
            updateAdministratif: function($event, index) {
                if(undefined !== $event.target.options[$event.target.selectedIndex].dataset.complement) {
                    this.activites['administratif'].controles[index].nombreDossiers = 0;
                } else {
                    this.activites['administratif'].controles[index].nombreDossiers = null;
                }
            },
            updateAutre: function($event, index) {
                if(undefined === $event.target.options[$event.target.selectedIndex].dataset.complement) {
                    this.activites['autre'].controles[index].nombreChlordecone = null;
                    this.activites['autre'].controles[index].nombreDetruit = null;
                } else if("chlordecone" === $event.target.options[$event.target.selectedIndex].dataset.complement) {
                    this.activites['autre'].controles[index].nombreDetruit = null;
                    this.activites['autre'].controles[index].nombreChlordecone = 0;
                } else if("detruit" === $event.target.options[$event.target.selectedIndex].dataset.complement) {
                    this.activites['autre'].controles[index].nombreDetruit = 0;
                    this.activites['autre'].controles[index].nombreChlordecone = null;
                }
            },
            updateDeroutement: function($event, index) {
                if(this.activites['navire'].controles[index].isDeroutement) {

                } else {
                    this.activites['navire'].controles[index].deroutement = null;
                }
            },
            toggleCheckAutre: function($event, index) {
                this.activites['navire'].controles[index].showDetail = !!$event.target.checked;
            },
            toggleSelectAutre: function(subject, $event, index) {
                this.activites[subject].controles[index].showDetail = "Autre" === $event.target.options[$event.target.selectedIndex].innerText;
            },
            localSave: function() {
                localStorage.setItem('activites', JSON.stringify(this.activites));
            },
            validate: function() {
                let isValid = document.getElementById("rapport").checkValidity();
                this.error = isValid;
                this.errorList = {};
                if(!isValid) {
                    this.error = true;
                    let invalidList = $("*:invalid");
                    for(let type in this.activites) {
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
import Rapport from './rapport';
import Vue from 'vue';
import $ from 'jquery';
import params from './params.json';

require('select2/dist/js/select2.min');
require('select2/dist/css/select2.min.css');

function navireDataComplete() {
    var input = $(this);
    $.get(params.apiNavires + "navires/" + input.val())
        .done(function (data) {
            let parent = input.parents("li");
            parent.find("input[id$=_navire_nom]").val(data.nomNavire);
            parent.find("input[id$=_navire_longueurHorsTout]").val(data.longueurHorsTout);
            parent.find("input[id$=_navire_idNavFloteur]").val(data.idNavFlotteur);
            parent.find("input[id$=_navire_typeUsage]").val(data.genreNavigation);
            if (input.parent().find(".immatriculation_invalide")) {
                input.parent().find(".immatriculation_invalide").remove();
            }
        })
        .fail(function (data) {
            console.log("immatriculation non trouvée dans Navires");
            $.get(params.apiNavires + "plaisances/" + input.val())
                .done(function (data) {
                    let parent = input.parents("li");
                    parent.find("input[id$=_navire_nom]").val(data.nomNavire);
                    parent.find("input[id$=_navire_idNavFloteur]").val(data.idNavFlotteur);
                    parent.find("input[id$=_navire_typeUsage]").val("Plaisance");
                    if (input.parent().find(".immatriculation_invalide")) {
                        input.parent().find(".immatriculation_invalide").remove();
                    }
                    parent.find("input[id$=_navire_longueurHorsTout]").val("");
                })
                .fail(function (data) {
                    if (input.parent().find(".immatriculation_invalide")) {
                        input.parent().find(".immatriculation_invalide").remove();
                    }

                    if (data.status === 404) {
                        input.parent().first().append('<p class="immatriculation_invalide">Immatriculation invalide</p>');
                    } else {
                        input.parent().first().append('<p class="immatriculation_invalide">Erreur ' + data.status + ' lors de la récupération des informations</p>');
                    }

                    input.parents("li").find("input[id$=_navire_nom]").val("");
                    input.parents("li").find("input[id$=_navire_longueurHorsTout]").val("");
                    input.parents("li").find("input[id$=_navire_idNavFloteur]").val("");
                    input.parents("li").find("input[id$=_navire_typeUsage]").val("");
                })
        })
}

function toogleErrorText(event) {
    if (event.currentTarget.checked) {
        $(this).parents('div.form__group').find('div:last').show();
    } else {
        $(this).parents('div.form__group').find('div:last').hide();
    }
}

$(document).ready(function () {
    $(".select2").select2({
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

    let vm = new Vue({
        el: "#aireMarine",
        data: {aireMarine: false},
        methods: {
            tooggleAireMarine: function (event) {
                this.aireMarine = event.target.options[event.target.selectedIndex].text === "Surveillance d'aire marine";
            }
        }
    });

    // Get the ul that holds the collection of Navires
    let $collectionHolder = $('ul.navires');

    let rapportNavire = new Rapport("navire");

    //adding autocompletion of Navire data
    $('.immatriculation_fr').on('focusout', navireDataComplete);

    // add a delete link to all of the existing Navire form li elements
    $collectionHolder.find('li.navire').each(function () {
        rapportNavire.addTagFormDeleteLink($(this));
    });

    // keep index count up-to-date
    $collectionHolder.data('index', $collectionHolder.find('li.navire').length);

    // add the "Ajouter un navire contrôlé" anchor and li to the Navires ul
    $collectionHolder.append(rapportNavire.$newLinkLi);

    $('.add_navire_link').on('click', function (e) {
        // add a new Navire form (see next code block)
        rapportNavire.addTagForm($collectionHolder);
        $('.immatriculation_fr').last().on('focusout', navireDataComplete);
        $('.isNavireHasError').last().on('change', toogleErrorText);
        $(".select2").last().select2({
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
    });

    //hide/show the details in case of error the data from Navires API
    $('.isNavireHasError').on('change', toogleErrorText);

});


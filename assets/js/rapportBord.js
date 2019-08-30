import RapportTopic from './rapportTopic';
import Vue from 'vue';
import $ from 'jquery';
import params from './params.json';

require('select2/dist/js/select2.min');
require('select2/dist/css/select2.min.css');

function navireDataComplete() {
    let input = $(this), plaisance = false;
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

            input.parents("li").find("input[id$=_navire_nom]").val("");
            input.parents("li").find("input[id$=_navire_longueurHorsTout]").val("");
            input.parents("li").find("input[id$=_navire_idNavFloteur]").val("");
            input.parents("li").find("input[id$=_navire_typeUsage]").val("");
        })
        .then(function (data) {
            let parent = input.parents("li");
            parent.find("input[id$=_navire_nom]").val(data.nomNavire);
            parent.find("input[id$=_navire_longueurHorsTout]").val(data.longueurHorsTout);
            parent.find("input[id$=_navire_idNavFloteur]").val(data.idNavFlotteur);
            if(!plaisance) {
                parent.find("input[id$=_navire_typeUsage]").val(data.genreNavigation || "Inconnu");
            } else {
                parent.find("input[id$=_navire_typeUsage]").val("Plaisance");
            }
            if (input.parent().find(".immatriculation_invalide")) {
                input.parent().find(".immatriculation_invalide").remove();
            }
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

    // Get the ul that holds the collection of Navires
    let $collectionHolder = $('ul.navires');

    let rapportNavire = new RapportTopic("navire");

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

    $('.add_navire_link').on('click', function () {
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


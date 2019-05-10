import Rapport from './rapport';
import $ from 'jquery';

function navireDataComplete() {
    var input = $(this);
    $.get("http://localhost:8080/api/navires/" + $(this).val())
        .done(function (data) {
            input.parents("li").find("input[id$=_navire_nom]").val(data.nomNavire);
            input.parents("li").find("input[id$=_navire_longueurHorsTout]").val(data.longueurHorsTout);
            input.parents("li").find("input[id$=_navire_idNavFloteur]").val(data.idNavFlotteur);
            if (input.parent().find(".immatriculation_invalide")) {
                input.parent().find(".immatriculation_invalide").remove();
            }
        })
        .fail(function (data) {
            if (input.parent().find(".immatriculation_invalide")) {
                input.parent().find(".immatriculation_invalide").remove();
            }

            if (data.status === 404) {
                input.parent().first().append('<p class="immatriculation_invalide">Immatriculation invalide</p>');
            } else {
                console.log(data.status);
                input.parent().first().append('<p class="immatriculation_invalide">Erreur ' + data.status + ' lors de la récupération des informations</p>');
            }

            input.parents("li").find("input[id$=_navire_nom]").val("");
            input.parents("li").find("input[id$=_navire_longueurHorsTout]").val("");
            input.parents("li").find("input[id$=_navire_idNavFloteur]").val("");
        })
}


$(document).ready(function () {
    // Get the ul that holds the collection of Navires
    let $collectionHolder = $('ul.navires');

    let rapportNavire = new Rapport("navire");

    //adding autocompletion of Navire data
    $('.immatriculation_fr').on('focusout', navireDataComplete);

    // add a delete link to all of the existing Navire form li elements
    $collectionHolder.find('li.navire').each(function () {
        rapportNavire.addTagFormDeleteLink($(this));
    });

    // add the "Ajouter un navire contrôlé" anchor and li to the Navires ul
    $collectionHolder.append(rapportNavire.$newLinkLi);

    // keep index count up-to-date
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $('.add_navire_link').on('click', function (e) {
        // add a new Navire form (see next code block)
        rapportNavire.addTagForm($collectionHolder);
        $('.immatriculation_fr').last().on('focusout', navireDataComplete);
    });

    if ($('#rapport_bord_typeMission').val() !== "2") {
        $('[id^=rapport_bord_aireMarineSpeciale_]').prop('disabled', true);
    }

    $('#rapport_bord_typeMission').on('change', function () {
        if ($(this).val() === "2") {
            $('[id^=rapport_bord_aireMarineSpeciale_]').prop('disabled', false);
        } else {
            $('[id^=rapport_bord_aireMarineSpeciale_]').prop('disabled', true);
        }
    })

});

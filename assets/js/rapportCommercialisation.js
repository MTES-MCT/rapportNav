import RapportTopic from './rapportTopic';
import $ from 'jquery';
import params from './params.json';

require('select2/dist/js/select2.min');
require('select2/dist/css/select2.min.css');

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
    let $collectionHolder = $('ul.etablissements');

    let rapportCommerce = new RapportTopic("etablissement");

    // add a delete link to all of the existing Navire form li elements
    $collectionHolder.find('li.etablissement').each(function () {
        rapportCommerce.addTagFormDeleteLink($(this));
    });

    // keep index count up-to-date
    $collectionHolder.data('index', $collectionHolder.find('li.etablissement').length);

    // add the "Ajouter un établissement contrôlé" anchor and li to the Navires ul
    $collectionHolder.append(rapportCommerce.$newLinkLi);

    $('.add_etablissement_link').on('click', function () {
        // add a new Etablissement form
        rapportCommerce.addTagForm($collectionHolder);
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

});
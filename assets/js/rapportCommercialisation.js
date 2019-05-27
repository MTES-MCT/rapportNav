import Rapport from './rapport';
import $ from 'jquery';

$(document).ready(function () {
        // Get the ul that holds the collection of Navires
        let $collectionHolder = $('ul.etablissements');

        let rapportCommerce = new Rapport("etablissement");

        // add a delete link to all of the existing Navire form li elements
        $collectionHolder.find('li.etablissement').each(function () {
            rapportCommerce.addTagFormDeleteLink($(this));
        });

        // add the "Ajouter un établissement contrôlé" anchor and li to the Navires ul
        $collectionHolder.append(rapportCommerce.$newLinkLi);

        // keep index count up-to-date
        $collectionHolder.data('index', $collectionHolder.find(':input').length);

        $('.add_etablissement_link').on('click', function (e) {
            // add a new Navire form (see next code block)
            rapportCommerce.addTagForm($collectionHolder);
        });

    }
);
import $ from 'jquery';

export default class RapportTopic {

    constructor(typeRapport) {
        this._typeRapport = typeRapport;
        this._$addTagButton = $('' +
            '<button type="button" id="add-controlled-elem" class="add_' + this.typeRapport + '_link button">' +
            'Ajouter un ' + this.typeRapport + ' contrôlé' +
            '</button>');
        this._$newLinkLi = $('<li></li>').append(this.$addTagButton);
    }

    set typeRapport(typeRapport) { this._typeRapport = typeRapport; }

    get typeRapport() { return this._typeRapport; }

    set $addTagButton($addTagButton) { this._$addTagButton = $addTagButton; }

    get $addTagButton() { return this._$addTagButton; }

    set $newLinkLi($newLinkLi) { this._$newLinkLi = $newLinkLi; }

    get $newLinkLi() { return this._$newLinkLi; }

    addTagForm($collectionHolder) {
        let prototype = $collectionHolder.data('prototype');

        //New index, store in the collection holder for now
        let index = $collectionHolder.data('index');

        let newForm = prototype;

        // Replace '__name__' in the prototype's HTML to instead be a number based on how many items we have
        newForm = newForm.replace(/__name__/g, index);

        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Ajouter un <element> contrôlé" link li
        let cssClass = (index % 2 ? '' : 'section-grey');
        let $newFormLi = $('<li class="row ' + this.typeRapport + ' ' + cssClass + '"></li>').append(newForm);
        this.$newLinkLi.before($newFormLi);
        this.addTagFormDeleteLink($newFormLi);
    }

    addTagFormDeleteLink($elementFormLi) {
        let $removeFormButton = $('<button type="button">Supprimer ce contrôle</button>');
        $elementFormLi.append($removeFormButton);

        $removeFormButton.on('click', function (e) {
            // remove the li for the Navires form
            $elementFormLi.remove();
        });
    }


}
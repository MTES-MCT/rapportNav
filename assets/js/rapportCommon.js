import $ from 'jquery';

$(document).ready(function () {

    function confirmExit() {
        if ($('body').data("needConfirm")) {
            return "Si vous quittez cette page les données non enregistrées seront perdues. \nVoulez-vous continuer ?";
        }
    }

    window.onbeforeunload = confirmExit;
    $('.formActionButton').on('click', function () {
        $('body').data("needConfirm", false);
    });

    $('body').data("needConfirm", true);
});
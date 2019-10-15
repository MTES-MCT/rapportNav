import $ from 'jquery';

const redirectToList = function (data) {
    var notif = '<div class="notification success">' + data.text + '<br>Redirection vers la liste des rapports dans 3 secondes. </div>';
    $('.notifications').append($(notif));
    setTimeout(function () {window.location.href = window.location.protocol + "//" + window.location.host + "/list_submissions"},
        3000);
};

$(window).on("load", function () {
    //Save
    $("#form-save").on("click", function (elem) {
        let path = window.location.pathname;
        if (-1 === path.search("draft")) {
            //creating a new draft,sending to draft URL
            path += "/draft";
        }

        $.ajax({
            type: "POST",
            url: path,
            data: JSON.stringify($("form").serializeArray()),
            processData: false,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (data) {
                if ("success" === data.status) {
                    redirectToList(data);
                }
            }
        });
    });

    //delete
    $("#form-delete").on("click", function (elem) {
        const deleteRapport = confirm("Voulez vous supprimer les données de ce rapport ? \n" +
            "Cette action est définitive, il sera impossible de récupérer les données. ");
        if (deleteRapport) {
            let path = window.location.pathname;
            //If this is a brand new Rapport, nothing is saved so nothing to delete, just quits the page
            if (-1 !== path.search("draft")) {
                $.ajax({
                    type: "DELETE",
                    url: path,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                })
                .catch(function (reason) {
                    //Maybe DELETE is not allowed, trying fallback URL
                    if(405 === reason.status ||
                        403 === reason.status ||
                        400 === reason.status) {
                        return $.ajax({
                            type: "POST",
                            url: path+"/delete",
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                        });
                    } else {
                        var notif = '<div class="notification error">Une erreur est survenue (' + reason.status + ') </div>';
                        $('.notifications').append($(notif));
                        setTimeout($('.notification').fadeOut(400), 180000);
                    }
                })
                .then(function (data) {
                    if ("success" === data.status) {
                        redirectToList(data);
                    }
                })
                ;
            } else {
                redirectToList({"text": "Rapport supprimé avec succès"})
            }
        }
    });

    //Q&D fix to wait all the JS to be applied
    setTimeout(function () {
        const data = $('#draft-data').data("content");
        if (undefined !== data) {
            let nbMoyens = 0, nbCtrlElems = 0;
            data.forEach(function (elem) {
                let input = $("form [name='" + elem.name + "']"), storedNbMoyen = null,
                    numPostCtrlElemName = null, numPostCtrlElemName1 = null, numPostCtrlElemName2 = null,
                    numPostCtrlElemName3 = null;

                if (-1 !== (storedNbMoyen = elem.name.search("\\]\\[moyen\\]"))) {
                    nbMoyens++;
                    if ($("[name$='\]\[moyen\]']").length < nbMoyens) {
                        $('#add-new-moyen').trigger("click");
                        input = $("form [name='" + elem.name + "']");
                    }
                }

                if (input.is('input[type=checkbox]')) {
                    input.filter("[value='" + elem.value + "']").prop("checked", 1);
                } else if (-1 !== (numPostCtrlElemName1 = elem.name.search("\\]\\[navire\\]\\[immatriculation_fr\\]"))
                    || -1 !== (numPostCtrlElemName2 = elem.name.search("\\]\\[etablissement\\]\\[nom\\]"))
                    || -1 !== (numPostCtrlElemName3 = elem.name.search("\\]\\[pecheurPied\\]\\[nom\\]"))) {
                    // One is not -1, the 2 others are
                    numPostCtrlElemName = Math.max(numPostCtrlElemName1, numPostCtrlElemName2, numPostCtrlElemName3);
                    $('#add-controlled-elem').trigger("click");
                    nbCtrlElems++;
                    //Getting again input because we juste created one
                    input = $("form [name='" + elem.name + "']");

                    input.val(elem.value);
                    input.trigger("change");
                } else {
                    input.val(elem.value);
                    input.trigger("change");
                }
            });
        }
    }, 500)


});
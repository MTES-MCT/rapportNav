import $ from 'jquery';

let redirectToList = function (data) {
    var notif = '<div class="notification success">' + data.text + '</div>'
    $('.notifications').append($(notif));
    setTimeout(function () {window.location.href = window.location.protocol + "//" + window.location.host + "/list_submissions"},
        3000);
};
$(window).on("load", function () {
    $("#form-save").on("click", function (elem) {
        let path = window.location.pathname;
        if (!path.search("draft")) {
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

    //Q&D fix to wait all the JS to be applied
    setTimeout(function () {
        let data = $('#draft-data').data("content");
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
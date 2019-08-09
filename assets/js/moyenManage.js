$(document).ready(function () {

    function showMetaData(event) {
        let notApplicable, applicable;
        let parent = $(event.target).parents("li.moyen");
        if ("0" === event.target.selectedOptions[0].getAttribute("data-type")) {
            notApplicable = parent.find("input[id$=_distance]").parent();
            applicable = parent.find("input[id$=_tempsMoteur]").parent();
        } else {
            applicable = parent.find("input[id$=_distance]").parent();
            notApplicable = parent.find("input[id$=_tempsMoteur]").parent();
        }
        notApplicable.find("input").val(null);
        notApplicable.find("input").prop("required", false);
        notApplicable.hide();
        applicable.show();
        applicable.find("input").prop("required", true);
    }

    function deleteMoyen(event) {
        let parent = $(event.target).parents("li.moyen");
        parent.remove();
    }

    $("select[id$=_moyen]").on("change", showMetaData);
    $(".moyen-delete").on("click", deleteMoyen);

    function addNewMoyen(root) {
        let prototype = root.data('prototype');
        let newMoyen = prototype;
        let index = root.data('index');
        newMoyen = newMoyen.replace(/__name__/g, index);
        newMoyen = $("<li class='row moyen'></li>").append(newMoyen);
        root.data('index', index + 1);
        root.append(newMoyen);
        root.children().last().find("select").on("change", showMetaData);
        root.children().last().find("button.moyen-delete").on("click", deleteMoyen)
    }

    let moyenRoot = $("#moyen-list");
    moyenRoot.data('index', moyenRoot.find("li").length);

    $("#add-new-moyen").on("click", function (e) {
        addNewMoyen(moyenRoot);
    })

});
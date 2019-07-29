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
        if(!path.search("draft")) {
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
        data.forEach(function (elem) {
            let input = $("form [name='" + elem.name + "']");
            if (input.is('input[type=checkbox]')) {
                input.filter("[value='" + elem.value + "']").prop("checked", 1);
            } else if(-1 !== elem.name.search("immatriculation_fr")) {
                $('#add-controlled-elem').trigger("click");
                input.val(elem.value);
                input.trigger("change");
            } else {
                input.val(elem.value);
                input.trigger("change");
            }
        });
    }, 500)


});
import $ from 'jquery';
import Vue from "vue";
import redirectToList from "./redirectToList.js";

$(document).ready(function() {
  new Vue({
    el: "#validation_buttons",
    data: {
      confirmBeforeLeave: true,
    },
    mounted: function() {
      window.addEventListener('beforeunload', this.handleUnload);
    },
    methods: {
      handleUnload: function(event) {
        if(!this.confirmBeforeLeave) {
          return true;
        }
        event.returnValue = "Si vous quittez cette page les données non enregistrées seront perdues. \nVoulez-vous continuer ?";
        return "Si vous quittez cette page les données non enregistrées seront perdues. \nVoulez-vous continuer ?";
      },
      doNotConfirmLeave: function() {
        this.confirmBeforeLeave = false;
      },
      saveDraft: function() {
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
      },
      deleteRapport: function() {
        const deleteRapport = confirm("Voulez vous supprimer les données de ce rapport ? \n" +
            "Cette action est définitive, il sera impossible de récupérer les données. ");
        if(deleteRapport) {
          let path = window.location.pathname;
          //If this is a brand new Rapport, nothing is saved so nothing to delete, just quits the page
          if(-1 !== path.search("draft")) {
            $.ajax({
              type: "DELETE",
              url: path,
              contentType: "application/json; charset=utf-8",
              dataType: "json",
            })
              .catch(function(reason) {
                //Maybe DELETE is not allowed, trying fallback URL
                if(405 === reason.status ||
                    403 === reason.status ||
                    400 === reason.status) {
                  return $.ajax({
                    type: "POST",
                    url: path + "/delete",
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                  });
                } else {
                  var notif = '<div class="notification error">Une erreur est survenue (' + reason.status + ') </div>';
                  $('.notifications').append($(notif));
                  setTimeout($('.notification').fadeOut(400), 180000);
                }
              })
              .then(function(data) {
                if("success" === data.status) {
                  redirectToList(data);
                }
              })
            ;
          } else {
            redirectToList({"text": "Rapport supprimé avec succès"})
          }
        }

      }
    }
  });
});
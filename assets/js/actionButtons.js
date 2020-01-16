import $ from 'jquery';
import Vue from "vue";
import moment from 'moment';
import redirectToList from "./redirectToList.js";

$(document).ready(function() {
  new Vue({
    el: "#validation_buttons",
    data: {
      confirmBeforeLeave: true,
      editDraft: false,
      index: null,
      drafts: []
    },
    mounted: function() {
      window.addEventListener('beforeunload', this.handleUnload);

      this.drafts = JSON.parse(localStorage.getItem("draft")) || [];
      const path = window.location.pathname;
      const pos =path.search(/draft\/[0-9]*/);
      if (-1 === pos) {
        this.index = this.drafts.length;
      } else {
        this.index = path.substring(pos+6);
        this.editDraft = true;
        this.restaureSave();
      }
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
        let rapport = {
          'debutDate': $('#rapport_dateDebutMission_date').val(),
          'debutHeure': $('#rapport_dateDebutMission_time').val(),
          'finDate': $('#rapport_dateFinMission_date').val(),
          'finHeure': $('#rapport_dateFinMission_time').val(),
          'agents': [],
          'conjointe': $('#rapport_conjointe').prop("checked"),
          'serviceConjoints': $('#service-conjoints select').val(),
          'moyens': [],
          'arme': $('#rapport_arme').prop("checked")
        };

        $('#agents input').each(function(index, object) {
          if($(object).prop("checked")) {
            rapport.agents.push($(object).val())
          }
        })

        $('#moyens li.moyen').each(function(index, object) {
            rapport.moyens.push([
                $(object).find("select").val(),
                $(object).find("input[id$=_distance]").val(),
                $(object).find("input[id$=_tempsMoteur]").val()
            ])
          });

        let newMetadata = {
          'id': this.index,
          'debut': $('#rapport_dateDebutMission_date').val(),
          'edit': moment().format('DD-MM-YYYY, HH:mm')
        },
            data = {
              'metadata': newMetadata,
              'rapport': rapport,
              'missions': (JSON.parse(localStorage.getItem('missions')) || {}),
              'timeDivision': (JSON.parse(localStorage.getItem('timeDivision')) || {}),
            };

        if(this.editDraft) {
          this.drafts[this.index] = data;
        } else {
          this.drafts.push(data);
        }

        localStorage.setItem('draft', JSON.stringify(this.drafts));

      },
      restaureSave: function() {
        let draft = this.drafts[this.index];
        $('#rapport_dateDebutMission_date').val(draft.rapport.debutDate);
        $('#rapport_dateDebutMission_time').val(draft.rapport.debutHeure);
        $('#rapport_dateFinMission_date').val(draft.rapport.finDate);
        $('#rapport_dateFinMission_time').val(draft.rapport.finHeure);
        $('#rapport_arme').prop("checked", draft.rapport.arme);
        $('#rapport_conjointe').prop("checked", draft.rapport.conjointe);
        $('#service-conjoints select').val(draft.rapport.serviceConjoints);

        for(let id in draft.rapport.agents) {
          $('#rapport_agents_'+draft.rapport.agents[id]).prop("checked", true);
        }
        for(let id in draft.rapport.moyens) {
          $('#add-new-moyen').trigger("click");
          $('#rapport_moyens_'+(Number(id)+1)+'_moyen').val(draft.rapport.moyens[id][0]);
          $('#rapport_moyens_'+(Number(id)+1)+'_moyen').trigger("change");
          $('#rapport_moyens_'+(Number(id)+1)+'_distance').val(draft.rapport.moyens[id][1]);
          $('#rapport_moyens_'+(Number(id)+1)+'_tempsMoteur').val(draft.rapport.moyens[id][2]);
          $('#service-conjoints select').trigger("change");
        }

      },
      deleteRapport: function() {
        const deleteRapport = confirm("Voulez vous supprimer les données de ce rapport ? \n" +
            "Cette action est définitive, il sera impossible de récupérer les données. ");
        if(deleteRapport) {
          //If this is a brand new Rapport, nothing is saved so nothing to delete, just quits the page
          if(this.editDraft) {
            let deleteIndex = Number(this.index);
            let filteredDrafts = this.drafts.filter(function(val, index) {
              return index !== deleteIndex;
            });
            localStorage.setItem('draft', JSON.stringify(filteredDrafts));
            redirectToList({"text": "Rapport supprimé avec succès"})
          } else {
            redirectToList({"text": "Rapport supprimé avec succès"})
          }
        }

      }
    }
  });
});
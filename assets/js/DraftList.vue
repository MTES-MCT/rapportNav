<template>
    <div>
        <ul>
            <li v-for="(draft, index) in drafts">
                <a :href="'/rapport/draft/'+index">
                    Brouillon n°{{ index }}
                </a>, mission du {{ draft.metadata.debut }} édité le {{ draft.metadata.edit }}
                <a class="button small warning" @click="deleteDraft(index)"><i class="fas fa-trash-alt"></i>Supprimer</a>
            </li>
        </ul>
        <div v-if="1 > drafts.length">Pas de brouillons enregistrés</div>
    </div>
</template>

<script>
    export default {
        name: "draftList",
        props: {},
        data: function() {
            return {drafts: []};
        },
        mounted: function() {
            this.drafts = JSON.parse(localStorage.getItem("draft")) || [];
        },
        methods: {
            deleteDraft: function(index) {
                if(confirm("Cette action efface ce brouillon sur votre poste, elle est définitive. Confirmez-vous la suppression du brouillon ? ")) {
                    this.drafts.splice(index, 1);
                    localStorage.setItem("draft", JSON.stringify(this.drafts));
                }
            }
        }
    }
</script>

<style scoped></style>
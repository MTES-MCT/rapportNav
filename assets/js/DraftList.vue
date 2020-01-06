<template>
    <div>
        <ul>
            <li v-for="(draft, index) in drafts">
                <a :href="'/rapport/draft/'+index">
                    Brouillon n°{{ index }}, mission du {{ draft.metadata.debut }} éditée le {{ draft.metadata.edit }}
                </a>
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
        }
    }
</script>

<style scoped>

</style>
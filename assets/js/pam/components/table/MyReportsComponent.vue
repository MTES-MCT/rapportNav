<template>
  <div class="myReports">
    <h5>Mes Rapports</h5>
    <div role="alert" class="fr-alert fr-alert--info">
      <p class="fr-alert__title">Aucun rapport</p>
      <p>Vous n'avez pas encore rempli de rapport.</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "MyReportsComponent",
  data() {
    return {
      rapports: []
    }
  }
}
</script>

<style scoped>

</style>

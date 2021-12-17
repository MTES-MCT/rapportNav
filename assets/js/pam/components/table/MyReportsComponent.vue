<template>
  <div class="myReports">
    <h5>Mes Rapports</h5>
    <AlertComponent title="Aucun rapport" message="Vous n'avez pas encore rempli de rapport."></AlertComponent>
  </div>
</template>

<script>
import AlertComponent from "../alert/AlertComponent";
export default {
  name: "MyReportsComponent",
  components: {AlertComponent},
  data() {
    return {
      rapports: []
    }
  }
}
</script>

<style scoped>

</style>

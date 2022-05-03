<template>
  <div>
    <HeaderHomeComponent name-site="RapportNav"></HeaderHomeComponent>
    <div class="fr-container fr-mt-31v">
      <h3 class="home-heading-1">Bonjour</h3>
      <CurrentReportComponent></CurrentReportComponent>
      <MyReportsComponent></MyReportsComponent>
    </div>
  </div>
</template>

<script>
import MyReportsComponent from "../components/table/MyReportsComponent";
import CurrentReportComponent from "../components/CurrentReportComponent";
import HeaderHomeComponent from "../components/HeaderHomeComponent";
import DownloadAEMComponent from "../components/DownloadAEMComponent";
export default {
  name: "HomeComponent",
  components: {DownloadAEMComponent, HeaderHomeComponent, CurrentReportComponent, MyReportsComponent}
}
</script>

<style scoped>

</style>

<template>
  <div>
    <router-view></router-view>

    <FooterComponent/>
  </div>
</template>

<script>
import FooterComponent from "./components/FooterComponent";
export default {
  name: "App",
  components: {FooterComponent}
}
</script>

<style scoped>

</style>

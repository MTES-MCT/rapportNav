<template>
  <div role="alert"
       :class="'fr-alert fr-alert--' + type"
  >
    <p class="fr-alert__title">{{ title }}</p>
    <p>{{ message }}</p>
  </div>
</template>

<script>
export default {
  name: "AlertComponent",
  props: {
    title: String,
    message: String,
    type: {
      type: String,
      default: () => { return 'info' }
    }
  }
}
</script>

<style scoped>

</style>

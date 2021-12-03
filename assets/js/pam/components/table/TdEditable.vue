<template>
    <td
        class="td-table-controle"
        contenteditable="true"
        @keyup="getValue($event.target)"
    >
    </td>
</template>

<script>
export default {
  name: "TdEditable",
  props: {
    controle: {
      type: Object,
      default: null
    }
  },
  methods: {
    getValue(target) {
      this.$emit('input', parseInt(target.innerText))
      this.$emit('change', parseInt(target.innerText))
    }
  }
}
</script>

<style scoped>

</style>
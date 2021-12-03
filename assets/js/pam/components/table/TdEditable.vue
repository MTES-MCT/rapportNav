<template>
  <td class="td-observation td-indicateur" v-if="observation">
    <i class="ri-message-2-fill" v-on:click="displayObservationInput = !displayObservationInput"></i>
    <div
        class="tooltip-observation"
        v-bind:class="{'d-none': !displayObservationInput}"
    >
      <textarea name="observation" id="observation" cols="4" rows="6" class="fr-input" placeholder="Observations"  @keyup="getValue($event.target)"></textarea>
    </div>
  </td>
  <td
      :class="'td-table-controle ' + classList"
      contenteditable="true"
      @keyup="getValue($event.target)"
      v-else
  >
  </td>
</template>

<script>
export default {
  name: "TdEditable",
  props: {
   classList: {
     type: String,
     default: null
   },
  observation: {
    type: Boolean,
    default: false
  }

  },
  methods: {
    getValue(target) {
      this.$emit('input', parseInt(target.innerText))
      this.$emit('change', parseInt(target.innerText))
    }
  },
  data() {
    return {
      displayObservationInput: false
    }
  }
}
</script>

<style scoped>

</style>
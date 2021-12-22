<template>
  <td class="td-observation td-indicateur" v-if="observation">
    <i class="ri-message-2-fill" v-on:click="displayObservationInput = !displayObservationInput"></i>
    <div
        class="tooltip-observation"
        v-bind:class="{'d-none': !displayObservationInput}"
    >
      <textarea name="observation" id="observation" cols="4" rows="6" class="fr-input" placeholder="Observations" :value="value"  @keyup="getValue($event.target, true)"></textarea>
    </div>
  </td>
  <td
      :class="'td-table-controle ' + classList"
      contenteditable="true"
      @keyup="getValue($event.target)"
      v-else
      v-text="value"
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
  },
  value: {
     type: Number | String,
    default: null
  },
  textObservation: {
     type: String,
    default: null
  }
  },
  methods: {
    getValue(target, isTextarea = false) {
      if(!isTextarea) {
        this.$emit('input', parseInt(target.innerText))
        this.$emit('change', parseInt(target.innerText))
      } else {
        this.$emit('input', target.value)
        this.$emit('change', target.value)
      }

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
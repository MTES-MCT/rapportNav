<template>
  <td class="td-observation td-indicateur" v-if="observation">
    <i class="ri-message-2-fill" v-on:click="displayObservationInput = !displayObservationInput"></i>
    <div
        class="tooltip-observation"
        v-bind:class="{'d-none': !displayObservationInput}"
    >
      <textarea name="observation" id="observation" cols="4" rows="6" class="fr-input" placeholder="Observations" :value="value"  @keyup="getValue($event, true)"></textarea>
    </div>
  </td>
  <td
      v-else-if="total"
      :class="'td-table-controle ' + classList"
      v-text="value"
  >
  </td>
  <td
      :class="'td-table-controle ' + classList"
      contenteditable="true"
      @keyup="getValue($event)"
      @keypress="onKeyPress($event)"
      v-else
      v-text="val"
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
  },
    total: Boolean
  },
  mounted() {
    this.val = this.value;
  },
  methods: {
    getValue(e, isTextarea = false) {
      const target = e.target;
      if(!isTextarea) {
        this.$emit('change', parseInt(target.innerText))
      }
      else {
        this.$emit('input', target.value)
        this.$emit('change', target.value)
      }
    },
    onKeyPress(e) {
      if(isNaN(e.key)) {
        e.preventDefault();
      }
    }
  },
  data() {
    return {
      displayObservationInput: false,
      val: null
    }
  }
}
</script>

<style scoped>

</style>

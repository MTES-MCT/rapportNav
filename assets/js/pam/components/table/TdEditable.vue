<template>
  <td
      class="td-table-controle"
      contenteditable="true"
      @keyup="getValue($event)"
      @keypress="onKeyPress($event)"
      v-else
      v-text="displayedValue">
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
    this.displayedValue = this.value;
  },
  methods: {
    getValue(e, isTextarea = false) {
      const target = e.target;
      if(!isTextarea) {
        let value = parseInt(target.innerText);
        if(isNaN(value)) {
          value = 0;
        }
        this.$emit('change', value)
        this.$emit('input', value)
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
    },
    hideTooltip(event) {
      if(!this.$refs.observation.contains(event.target)) {
        this.hidden = true;
      }
    }
  },
  data() {
    return {
      hidden: true,
      displayedValue: null
    }
  }
}
</script>

<style scoped>

</style>

<template>
  <div class="space-between">
    <label class="fr-label">{{ label }}</label>
    <div class="InputAddOn">
      <input
          class="InputAddOn-field fr-input"
          v-bind:class="{ 'fr-input-valid': isValid }"
          :type="type"
          @change="valueChanged"
          @keydown="keydown"
          v-on:change="checkInputValid($event)"
          min="0"
          :value="value"

      >
      <button
          class="InputAddOn-item"
          v-if="addOn !== null"
          v-bind:class="{ 'fr-input-valid': isValid }"
      >
        {{ addOn }}
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "InputNumberComponent",
  methods: {
    valueChanged(e){
      this.$emit('input', e.target.value);
      this.$emit('change',e.target.value);
    },
    keydown(e){
      if(e.keyCode === 13){
        this.$emit('input', e.target.value);
        this.$emit('change',e.target.value);
        this.$emit('enter');
      }
    },
    checkInputValid(e) {
      if(e.target.value.length > 0) {
        this.isValid = true;
      } else {
        this.isValid = false;
      }
    }
  },
  props: {
    label : {
      type: String,
      default: null
    },
    addOn: {
      type: String,
      default: null
    },
    type: {
      type: String,
      default: 'text'
    },
    value: {
      type: Number,
      default: null
    }
  },
  data () {
    return {
      isValid: null
    }
  }
}
</script>

<style scoped>
</style>
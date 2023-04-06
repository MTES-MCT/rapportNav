<template>
  <div class="input-number">
    <div class="space-between">
      <label class="fr-label input-label">{{ label }}</label>
      <div class="InputAddOn input-field">
        <input
            :id="id"
            class="InputAddOn-field fr-input"
            v-bind:class="[
                error && !value ? 'fr-input-invalid' : null,
                value ? 'fr-input-valid' : null
            ]"
            @keyup="valueChanged"
            @change="valueChanged"
            min="0"
            :value="value"
            type="number"
        >
        <span
            class="InputAddOn-item"
            v-if="addOn !== null"
            v-bind:class="[
                error && !value ? 'fr-input-invalid' : null,
                value ? 'fr-input-valid' : null
            ]"
        >
        {{ addOn }}
      </span>
      </div>
    </div>
    <p class="fr-error-text" v-if="error">
      Merci de remplir ce champ.
    </p>
  </div>
</template>

<script>
export default {
  name: "InputNumberComponent",
  mounted() {
  },
  methods: {
    valueChanged(e){
      const value = e.target.value !== "" ? e.target.value : null;
      this.$emit('input', value);
   //   this.$emit('change',value);
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
    value: {
      type: Number,
      default: null
    },
    error: {
      type: Boolean,
      default: false
    },
    id: String
  }
}
</script>

<style scoped>
</style>

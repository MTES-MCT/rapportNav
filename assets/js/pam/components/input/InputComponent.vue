<template>
  <div class="space-between">
    <label class="fr-label">{{ label }}</label>
    <div class="InputAddOn">
      <input
          class="InputAddOn-field fr-input"
          :type="type"
          @change="valueChanged"
          @keydown="keydown"
      >
      <button class="InputAddOn-item" v-if="addOn !== null" :value="value">{{ addOn }}</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "InputComponent",
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
      type: String,
      default: null
    }
  },
  data () {
    return {
    }
  }
}
</script>

<style scoped>

</style>
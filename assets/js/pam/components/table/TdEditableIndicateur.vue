<template>
  <td class="td-observation td-indicateur" v-if="observation && !isIndicateurChild"  ref="observation">
    <i class="ri-message-2-fill icon-observation" @click="hidden = !hidden" aria-hidden="true"></i>
    <div
        class="tooltip-observation"
        v-if="!hidden"
        v-click-outside="hideTooltip">
      <textarea name="observation" id="observation" cols="4" rows="6" class="fr-input" placeholder="Observations" :value="value"  @keyup="getValue($event, true)"></textarea>
    </div>
  </td>
  <td class="td-observation td-indicateur-child" v-else-if="observation && isIndicateurChild"  ref="observation">
    <i class="ri-message-2-fill icon-observation" @click="hidden = !hidden" aria-hidden="true"></i>
    <div
        class="tooltip-observation"
        v-if="!hidden"
        v-click-outside="hideTooltip">
      <textarea name="observation" id="observation" cols="4" rows="6" class="fr-input" placeholder="Observations" :value="value"  @keyup="getValue($event, true)"></textarea>
    </div>
  </td>
  <td
      v-else-if="isTotalCell"
      :class="'td-table-total td-indicateur'"
      v-text="value"
  >
  </td>
  <td
      v-else-if="isIndicateurChild"
      contenteditable="true"
      @keyup="getValue($event)"
      @keypress="onKeyPress($event)"
      class="td-indicateur-child"
      v-text="displayedValue"
  >
  </td>
  <td
      class="td-indicateur td-fillable"
      v-bind:class="{ 'automatic-cell': isAutomaticCell }"
      contenteditable="true"
      @keyup="getValue($event)"
      @keypress="onKeyPress($event)"
      v-else
      v-text="displayedValue"
  >
  </td>
</template>

<script>
export default {
  name: "TdEditableIndicateur",
  props: {
    observation: Boolean,
    value: Number | String,
    isTotalCell: Boolean,
    isAutomaticCell: Boolean,
    isIndicateurChild: Boolean
  },
  mounted() {
    this.displayedValue = this.value;
  },
  methods: {
    hideTooltip(event) {
      if(!this.$refs.observation.contains(event.target)) {
        this.hidden = true;
      }
    },
    getValue(e, isTextarea = false) {
      const target = e.target;
      if(!isTextarea) {
        let value = parseInt(target.innerText);
        if(isNaN(value)) {
          value = 0;
        }
        this.$emit('change', value)
        this.$emit('input', value)
      } else {
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
      hidden: true,
      automaticEnabled: false,
      displayedValue: null
    }
  }
}
</script>

<style scoped>

</style>

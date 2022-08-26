<template>
  <td class="td-observation"
      v-bind:class="[ isIndicateurChild ? 'td-indicateur-child' : 'td-indicateur' ]"
      v-if="observation"  ref="observation">
    <i class="ri-message-2-fill icon-observation" @click="hidden = !hidden" aria-hidden="true"></i>
    <div
        class="tooltip-observation"
        v-if="!hidden"
        v-click-outside="hideTooltip">
      <textarea name="observation" id="observation" cols="4" rows="6" class="fr-input" placeholder="Observations" :value="value"  @keyup="getValue($event, true)"></textarea>
    </div>
  </td>
  <td
      v-else-if="isTotalCell && !isIndicateurChild"
      class="td-table-total td-indicateur"
      v-bind:class="[indicateurData.total !== indicateurData.automaticValue && indicateurData.isAutomaticCell ? 'text-red-error' : null]"
      v-text="value">
  </td>

  <td
      v-else-if="isTotalCell && isIndicateurChild"
      class="td-indicateur-child"
      v-text="value">
  </td>
  <td
      v-else-if="isIndicateurChild"
      contenteditable="true"
      ref="tdIndicateur"
      @keyup="getValue($event)"
      @keypress="onKeyPress($event)"
      class="td-indicateur-child"
      v-text="displayedValue"
  >
  </td>
  <td
      v-else-if="indicateurData.isAutomaticCell && indicateurData.automaticEnabled && isMainMission && isPrincipaleCell"
      contenteditable="false"
      class="td-indicateur"
  >
    {{ displayedValue }}
    <i class="ri-calculator-fill automatic-icon fr-mr-2v" aria-hidden="true" @click="popupHidden = !popupHidden" />
        <div class="tooltip-automatic-calculate" v-if="!popupHidden">
          <div class="fr-toggle fr-toggle--label-left" v-click-outside="hideCalculAutoTooltip">
            <input type="checkbox" :checked="indicateurData.automaticEnabled" class="fr-toggle__input" :aria-describedby="'toggle-' + id + '-hint-text'" :id="'toggle-' + id" v-model="indicateurData.automaticEnabled">
            <label class="fr-toggle__label" :for="'toggle-' + id">Calculé automatiquement à partir des déclarations opérationnelles</label>
          </div>
        </div>
  </td>
  <td
      v-else-if="indicateurData.isAutomaticCell && !indicateurData.automaticEnabled && isMainMission && isPrincipaleCell"
      contenteditable="true"
      class="td-indicateur"
      ref="tdIndicateur"
      @keyup="getValue($event)"
      @keypress="onKeyPress($event)"
  >
      {{ displayedValue }}
    <i class="ri-calculator-fill automatic-icon-error fr-mr-2v" aria-hidden="true" @click="popupHidden = !popupHidden" readonly="true" ref="automaticIcon" v-if="indicateurData.total !== indicateurData.automaticValue" />
    <i class="ri-calculator-fill automatic-icon fr-mr-2v" aria-hidden="true" @click="popupHidden = !popupHidden" readonly="true" ref="automaticIcon" v-else />
    <div class="tooltip-automatic-calculate" v-if="!popupHidden" ref="calculAutoTooltip">
      <div class="fr-toggle fr-toggle--label-left" v-click-outside="hideCalculAutoTooltip">
        <input type="checkbox" :checked="indicateurData.automaticEnabled" class="fr-toggle__input" :aria-describedby="'toggle-' + id + '-hint-text'" :id="'toggle-' + id" v-model="indicateurData.automaticEnabled">
        <label class="fr-toggle__label" :for="'toggle-' + id">Calculé automatiquement à partir des déclarations opérationnelles</label>
        <p class="fr-hint-text">La réactivation des calculs automatique supprimera les données renseignées manuellement.</p>
        <p class="fr-hint-text text-red-error" v-if="indicateurData.total !== indicateurData.automaticValue">Vous avez saisi un chiffre qui ne correspond pas aux informations renseignées dans la partie Contrôles opérationnels</p>
      </div>
    </div>
  </td>
  <td
      v-else-if="indicateurData.isAutomaticCell && indicateurData.automaticEnabled && isMainMission && !isPrincipaleCell"
      contenteditable="false"
      class="td-indicateur">
  </td>
  <td
      v-else-if="indicateurData.isAutomaticCell && !indicateurData.automaticEnabled && isMainMission && !isPrincipaleCell"
      contenteditable="true"
      class="td-indicateur"
      ref="tdIndicateur"
      @keyup="getValue($event)"
      @keypress="onKeyPress($event)"
      v-text="displayedValue"
  >
  </td>
  <td
      v-else-if="indicateurData.isAutomaticCell && indicateurData.automaticEnabled && !isMainMission && isPrincipaleCell"
      contenteditable="false"
      class="td-indicateur">
  </td>
  <td
      v-else-if="indicateurData.isAutomaticCell && !indicateurData.automaticEnabled && !isMainMission && isPrincipaleCell"
      contenteditable="true"
      ref="tdIndicateur"
      class="td-indicateur"
      @keyup="getValue($event)"
      @keypress="onKeyPress($event)"
      v-text="displayedValue"
  >
  </td>

  <td
      v-else-if="indicateurData.isAutomaticCell && indicateurData.automaticEnabled && !isMainMission && !isPrincipaleCell"
      contenteditable="false"
      class="td-indicateur">
    {{ displayedValue }}
    <i class="ri-calculator-fill automatic-icon fr-mr-2v" aria-hidden="true" @click="popupHidden = !popupHidden" />
    <div class="tooltip-automatic-calculate" v-if="!popupHidden">
      <div class="fr-toggle fr-toggle--label-left" v-click-outside="hideCalculAutoTooltip">
        <input type="checkbox" :checked="indicateurData.automaticEnabled" class="fr-toggle__input" :aria-describedby="'toggle-' + id + '-hint-text'" :id="'toggle-' + id" v-model="indicateurData.automaticEnabled">
        <label class="fr-toggle__label" :for="'toggle-' + id">Calculé automatiquement à partir des déclarations opérationnelles</label>
      </div>
    </div>
  </td>

  <td
      v-else-if="indicateurData.isAutomaticCell && !indicateurData.automaticEnabled && !isMainMission && !isPrincipaleCell"
      contenteditable="true"
      class="td-indicateur"
      ref="tdIndicateur"
      @keyup="getValue($event)"
      @keypress="onKeyPress($event)">
    {{ displayedValue }}
    <i class="ri-calculator-fill automatic-icon-error fr-mr-2v" aria-hidden="true" @click="popupHidden = !popupHidden" readonly="true" ref="automaticIcon" v-if="indicateurData.total !== indicateurData.automaticValue" />
    <i class="ri-calculator-fill automatic-icon fr-mr-2v" aria-hidden="true" @click="popupHidden = !popupHidden" readonly="true" ref="automaticIcon" v-else />
    <div class="tooltip-automatic-calculate" v-if="!popupHidden" ref="calculAutoTooltip">
      <div class="fr-toggle fr-toggle--label-left" v-click-outside="hideCalculAutoTooltip">
        <input type="checkbox" :checked="indicateurData.automaticEnabled" class="fr-toggle__input" :aria-describedby="'toggle-' + id + '-hint-text'" :id="'toggle-' + id" v-model="indicateurData.automaticEnabled">
        <label class="fr-toggle__label" :for="'toggle-' + id">Calculé automatiquement à partir des déclarations opérationnelles</label>
        <p class="fr-hint-text">La réactivation des calculs automatique supprimera les données renseignées manuellement.</p>
        <p class="fr-hint-text text-red-error" v-if="indicateurData.total !== indicateurData.automaticValue">Vous avez saisi un chiffre qui ne correspond pas aux informations renseignées dans la partie Contrôles opérationnels</p>
      </div>
    </div>
  </td>
  <td
      class="td-indicateur td-fillable"
      contenteditable="true"
      ref="tdIndicateur"
      @keyup="getValue($event)"
      @keypress="onKeyPress($event)"
      v-else
      v-text="displayedValue">
  </td>
</template>

<script>
export default {
  name: "TdEditableIndicateur",
  props: {
    observation: Boolean,
    value: Number | String,
    isTotalCell: Boolean,
    isIndicateurChild: Boolean,
    indicateur: Object,
    alerteCoherent: Boolean,
    isPrincipaleCell: Boolean,
    isMainMission: Boolean
  },
  mounted() {
    this.displayedValue = this.value;
    if(!this.observation) {
      this.indicateurData.isAutomaticCell = this.indicateurData.isAutomaticCell || false;
    } else {
      this.indicateurData = {
        isAutomaticCell: false,
        automaticEnabled: false
      }
    }

  },
  methods: {
    hideTooltip(event) {
      if(!this.$refs.observation.contains(event.target)) {
        this.hidden = true;
      }
    },
    hideCalculAutoTooltip(event) {
      if(!this.$refs.calculAutoTooltip.contains(event.target) && this.$refs.automaticIcon !== event.target) {
        this.popupHidden = true;
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
    },
  },
  data() {
    return {
      hidden: true,
      displayedValue: null,
      popupHidden: true,
      id: this._uid,
      indicateurData: this.indicateur ? this.indicateur : {
        automaticEnabled: false
      }
    }
  },
  watch: {
    'indicateurData.automaticEnabled': function(newVal) {
      this.indicateur.automaticEnabled = newVal;
      if(this.isPrincipaleCell && !this.isMainMission) {
        this.displayedValue = null;
      }
      else if(!this.isPrincipaleCell && this.isMainMission) {
        this.displayedValue = null;
      }
      else {
        this.displayedValue = this.indicateurData.automaticValue;
      }

      if(newVal) {
        this.indicateur.reset = true;
        this.$emit('input', this.indicateurData.automaticValue);
        this.$emit('change', this.indicateurData.automaticValue);
      }


    },
    value: function(newVal, oldVal) {

      if(this.indicateurData.reset) {
        if(this.isPrincipaleCell && this.isMainMission) {
          this.displayedValue = this.indicateurData.automaticValue;
          this.indicateurData.isPrincipaleCellFilled = true;
        }

        if(!this.isPrincipaleCell && !this.isMainMission){
          this.displayedValue = this.indicateurData.automaticValue;
          this.indicateurData.isSecondaireCellFilled = true;
        }

       if(this.indicateurData.isPrincipaleCellFilled && this.indicateurData.isSecondaireCellFilled) {
          this.indicateurData.reset = false;
          this.indicateurData.isPrincipaleCellFilled = false;
          this.indicateurData.isSecondaireCellFilled = false;
        }
      } else {
        const $tdIndicateur = this.$refs.tdIndicateur;
        if($tdIndicateur) {
          $tdIndicateur.onblur = (event) => {
            this.displayedValue = newVal;
          }
        }
      }
    }
  }
}
</script>

<style scoped>

</style>

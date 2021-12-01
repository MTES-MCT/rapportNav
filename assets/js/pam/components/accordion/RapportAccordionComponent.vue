<template>
  <div class="box-dropdown fr-mt-2w">
    <ul class="fr-accordions-group" v-if="type === 'controle'">
      <li v-for="(c, index) in controles">
        <div class="box-shadow-card" :id="c.id">
          <section class="fr-accordion box-shadow-card-body">
            <div class="fr-accordion__title ">
              <div class="fr-container--fluid">
                <div class="fr-grid-row">
                  <div class="fr-col-11">
                    <button class="fr-accordion__btn fr-fi-arrow-down-s-line fr-btn--icon-left" aria-expanded="true" :aria-controls="'accordion-' + c.id">
                     {{c.title}}
                    </button>
                  </div>
                  <div class="fr-col-1 fr-mt-2v" v-if="removeBtn === true">
                    <button class="fr-fi-delete-fill btn-remove" aria-hidden="true" @click="removeControle(index)"></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="fr-collapse" :id="'accordion-' + c.id ">
              <div class="divider-horizontal--accordion"></div>
              <TableControleComponent v-if="type === 'controle'" :id="c.id"></TableControleComponent>
            </div>
          </section>
        </div>
      </li>
    </ul>
    <ModalAddControle @clicked="onClickModal"></ModalAddControle>
  </div>
</template>

<script>
import TableControleComponent from "../table/TableControleComponent";
import TableIndicateurComponent from "../table/TableIndicateurComponent";
import ModalAddControle from "../ModalAddControle";
export default {
  name: "RapportAccordionComponent",
  components: { TableControleComponent, TableIndicateurComponent, ModalAddControle },
  props: {
    title: {
      type: String,
      default: null
    },
    type: {
      type: String,
      default: null
    },
    removeBtn: {
      type: Boolean,
      default: false
    },
    identifier: {
      type: String,
      default: null
    }
  },
  data: function() {
    return {
      id: this._uid,
      controles: [
        {
          title: 'Contrôle en mer de navires de pêche professionnelle',
          id: this._uid
        }
      ]
    }
  },
  methods: {
    onClickModal(value, id) {
      let newControle = {
        title: value,
        id: id
      };
      this.controles.push(newControle);
    },
    removeControle(index) {
      this.controles.splice(index, 1);
    }
  }
}
</script>

<style scoped>

</style>
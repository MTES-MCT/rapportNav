<template>
  <div>
    <header role="banner" class="fr-header">
      <div class="fr-header__body">
        <div class="fr-container">
          <div class="fr-header__body-row">
            <div class="fr-header__brand fr-enlarge-link">
              <div class="fr-header__brand-top">
                <div class="fr-header__logo">
                  <p class="fr-logo">
                    République
                    <br>Française
                  </p>
                </div>
                <div class="fr-header__navbar">
                  <button class="fr-btn--menu fr-btn" data-fr-opened="false" aria-controls="modal-833"
                          aria-haspopup="menu" title="Menu" id="fr-btn-menu-mobile">
                    Menu
                  </button>
                </div>
              </div>
              <div class="fr-header__service" v-if="nameSite !== null">
                <a href="/pam" :title="'Accueil - ' +  nameSite ">
                  <p class="fr-header__service-title">{{ nameSite }}</p>
                </a>
              </div>
              <div class="divider-vertical"></div>
            </div>

            <div class="num-report" v-if="numReport !== null">
              <p class=" fr-text--md text-grey fr-ml-2v">Rapport n°{{ numReport }}</p>
            </div>


            <div class="informations" v-if="saved || draft">
              <nav class="fr-nav" id="navigation-773" role="navigation" aria-label="Menu principal">
                <ul class="fr-nav__list">
                  <li class="fr-nav__item">
                    <button class="fr-nav__btn fr-fi-download-line fr-btn--icon-left fr-text" aria-expanded="false"
                            aria-controls="menu-776">Télécharger
                    </button>
                    <div class="fr-collapse fr-menu" id="menu-776">
                      <ul class="fr-menu__list">
                        <li class="download-item">
                          <a class="fr-nav__link fr-btn--icon-left fr-fi-download-line" href="#" target="_self"
                             :aria-controls="'fr-modal-download' + rapport.id" data-fr-opened="false"
                             @click.prevent="typeDownload = 'rapport'">
                            Télécharger le rapport de patrouille (.docx)</a>
                        </li>
                        <li class="download-item">
                          <a class="fr-nav__link fr-btn--icon-left fr-fi-download-line"
                             @click.prevent="typeDownload = 'indicateurs'"
                            href="#" target="_self" :aria-controls="'fr-modal-download' + rapport.id" data-fr-opened="false">
                            Télécharger les indicateurs de mission (.xlsx)
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="fr-header__tools responsive-btn fr-ml-8w" v-if="createdBy.id === user.service.id || createdBy.id === null">
              <div class="fr-header__tools-links">
                <ul class="fr-links-group">
                  <li>
                    <button
                        class="fr-btn--menu fr-btn fr-fi-check-line fr-btn--icon-left mr-2"
                        data-fr-opened="false"
                        aria-controls="modal-870"
                        aria-haspopup="validate"
                        title="Valider le rapport"
                        @click="submitted"
                        v-if="!saved"
                    >
                      Valider le rapport
                    </button>

                    <button
                        class="fr-btn--menu fr-btn fr-fi-check-line fr-btn--icon-left mr-2"
                        data-fr-opened="false"
                        aria-controls="modal-870"
                        aria-haspopup="validate"
                        title="Valider le rapport"
                        @click="update"
                        v-if="saved"
                    >
                      Valider le rapport
                    </button>
                  </li>
                  <li>
                    <button
                        id="header_enregistrer_brouillon_btn"
                        class="fr-btn--menu fr-btn mr-2 fr-fi-save-fill fr-btn--secondary fr-btn--icon-left"
                        data-fr-opened="false"
                        aria-controls="modal-870"
                        aria-haspopup="draft"
                        title="Enregistrer"
                        @click="drafted"
                        :disabled="saved"
                    >
                      Enregistrer
                    </button>
                  </li>
                  <li>
                    <a class="fr-link--icon-left fr-fi-close-line fr-text text-bold text-red-error float-right"
                      data-fr-opened="false" aria-controls="fr-modal-200" href="#" v-if="!saved">Quitter
                    </a>
                    <router-link class="fr-link--icon-left fr-fi-close-line fr-text text-bold text-red-error float-right"
                       data-fr-opened="false" aria-controls="fr-modal-200" :to="'/pam'" v-else>Quitter
                    </router-link>
                  </li>
                </ul>
              </div>
            </div>

            <div class="fr-header__body-row responsive-btn-header" v-if="createdBy.id === user.service.id || createdBy.id === null">
              <div class="">
                <div class="">
                  <ul class="fr-btns-group fr-btns-group--inline fr-btns-group--icon-left">
                    <li>
                      <button
                          class="fr-btn--menu fr-btn fr-fi-check-line fr-btn--icon-left mr-2"
                          title="Valider le rapport"
                          @click="submitted"
                      >
                        Valider le rapport
                      </button>
                    </li>
                    <li>
                      <button
                          class="fr-btn--menu fr-btn mr-2 fr-fi-save-fill fr-btn--secondary fr-btn--icon-left"
                          title="Enregistrer"
                          @click="drafted"
                      >
                        Enregistrer
                      </button>
                    </li>
                    <li>
                      <a class="fr-link--icon-left fr-fi-close-line fr-text text-bold text-red-error"
                        data-fr-opened="false" aria-controls="fr-modal-200" href="#" v-if="!saved">Quitter
                      </a>
                      <router-link class="fr-link--icon-left fr-fi-close-line fr-text text-bold text-red-error float-right"
                                   data-fr-opened="false" aria-controls="fr-modal-200" :to="'/pam'" v-else>Quitter
                      </router-link>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>

      <div class="fr-header__menu fr-modal" id="modal-833" aria-labelledby="fr-btn-menu-mobile">
        <div class="fr-container">
          <button class="fr-link--close fr-link" aria-controls="modal-833">Fermer</button>
          <div class="fr-header__menu-links"></div>
          <nav class="fr-header__menu-links" id="navigation-832" role="navigation" aria-label="Menu principal">
            <ul class="fr-nav__list">
              <li class="fr-nav__item" v-if="saved || draft">
                <button class="fr-nav__btn fr-text" aria-expanded="false"
                        aria-controls="menu-888">Télécharger
                </button>
                <div class="fr-collapse fr-menu" id="menu-888">
                  <ul class="fr-menu__list">
                    <li class="download-item">
                      <a class="fr-nav__link fr-btn--icon-left fr-fi-download-line" href="#" target="_self"
                         :aria-controls="'fr-modal-download' + rapport.id" data-fr-opened="false"
                         @click.prevent="typeDownload = 'rapport'">
                        Télécharger le rapport de patrouille (.docx)</a>
                    </li>
                    <li class="download-item">
                      <a class="fr-nav__link fr-btn--icon-left fr-fi-download-line"
                         @click.prevent="typeDownload = 'indicateurs'"
                         href="#" target="_self" :aria-controls="'fr-modal-download' + rapport.id" data-fr-opened="false">
                        Télécharger les indicateurs de mission (.xlsx)
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>

    </header>

    <ModalConfirmationComponent @save-exit="update(true)" @draft-exit="drafted(true)" :saved="saved" :num-rapport="rapport.id" v-if="rapport && !saved" />
    <ModalConfirmationComponent @save-exit="update(true)" @draft-exit="drafted(true)" :saved="saved" v-else />
    <ModalMsgDownload :rapport="rapport" :type="typeDownload" :draft="draft" v-if="draft || saved" />
  </div>
</template>

<script>
  import ModalConfirmationComponent from "./ModalConfirmationComponent";
  import axios from "axios";
  import {sanitizeUrl} from "@braintree/sanitize-url";
  import ModalMsgDownload from "./modal/ModalMsgDownload";
  export default {
    name: "HeaderComponent",
    components: {ModalMsgDownload, ModalConfirmationComponent},
    props: {
      nameSite: {
        type: String,
        default: 'RapportNav'
      },
      numReport: {
        type: String,
        default: null
      },
      draft: {
        type: Boolean,
        default: () => { return false }
      },
      saved: {
        type: Boolean,
        default: () => { return false }
      },
      rapport: {
        type: Object,
        default: null
      },
      user: Object,
      createdBy: {
        type: Object,
        default: () => {
          return {
            id: null
          }
        }
      }
    },
    mounted() {
    },
    methods: {
      submitted() {
        this.$emit('submitted');
      },
      drafted(exit = false) {
        this.$emit('drafted', exit)
      },
      update(exit = false) {
        this.$emit('update', exit);
      }
    },
    data() {
      return {
        typeDownload: 'indicateurs'
      }
    }
  };
</script>

<style scoped lang="css">

</style>

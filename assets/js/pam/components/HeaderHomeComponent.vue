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
                <a href="/" :title="'Accueil - ' +  nameSite ">
                  <p class="fr-header__service-title">{{ nameSite }}</p>
                </a>
              </div>
            </div>

            <div class="fr-header__tools responsive-btn fr-ml-8w">
              <div class="fr-header__tools-links">
                <ul class="fr-links-group">
                  <li>
                    <button
                        class="fr-btn--menu fr-btn fr-fi-add-circle-fill fr-btn--icon-left mr-2"
                        data-fr-opened="false"
                        aria-controls="modal-870"
                        title="Créer un rapport"
                    >
                      Créer un rapport
                    </button>
                  </li>
                  <li>
                    <button
                        class="fr-btn--menu fr-btn mr-2 fr-fi-user-line fr-btn--secondary fr-btn--icon-left"
                        data-fr-opened="false"
                        aria-controls="modal-870"
                        title="Mon profil"
                    >
                      Mon profil
                    </button>
                  </li>
                  <li>

                  </li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>
    </header>

  </div>
</template>

<script>
export default {
  name: "HeaderHomeComponent",
  props: {
    nameSite: String
  }
}
</script>

<style scoped>

</style>

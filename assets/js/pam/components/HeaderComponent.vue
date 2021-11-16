<template>
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
                <button class="fr-btn--menu fr-btn" data-fr-opened="false" aria-controls="modal-833" aria-haspopup="menu" title="Menu" id="fr-btn-menu-mobile">
                  Menu
                </button>
              </div>
            </div>
            <div class="fr-header__service">
              <a href="/" title="Accueil - RapportNav">
                <p class="fr-header__service-title">RapportNav</p>
              </a>
            </div>
            <div class="divider-vertical fr-mr-2v"></div>
            <div class="fr-header__service">
              <a href="/" title="Accueil - RapportNav">
                <p class="fr-header__service-title fr-text--lg text-grey fr-mr-4v">Marée n°7745</p>
              </a>
            </div>
          </div>

          <div class="informations">
              <nav class="fr-nav" id="navigation-773" role="navigation" aria-label="Menu principal">
                <ul class="fr-nav__list">
                    <li class="fr-nav__item">
                        <button class="fr-nav__btn fr-fi-download-line fr-btn--icon-left fr-text" aria-expanded="false" aria-controls="menu-776">Télécharger</button>
                        <div class="fr-collapse fr-menu" id="menu-776">
                            <ul class="fr-menu__list">
                                <li>
                                    <a class="fr-nav__link" href="#" target="_self">Lien de navigation</a>
                                </li>
                                <li>
                                    <a class="fr-nav__link" href="#" target="_self">Lien de navigation</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
          </div>
          <div class="fr-header__tools">
            <div class="fr-header__tools-links">
              <ul class="fr-links-group">
                <li>
                  <button
                      class="fr-btn--menu fr-btn fr-fi-check-line fr-btn--icon-left mr-2"
                      data-fr-opened="false"
                      aria-controls="modal-870"
                      aria-haspopup="validate"
                      title="Valider le rapport"
                  >
                   Valider le rapport
                  </button>
                </li>
                <li>
                  <button
                      class="fr-btn--menu fr-btn mr-2 fr-fi-save-fill fr-btn--secondary fr-btn--icon-left"
                      data-fr-opened="false"
                      aria-controls="modal-870"
                      aria-haspopup="draft"
                      title="Enregistrer"
                  >
                    Enregistrer
                  </button>
                </li>
                <li>
                  <a class="fr-link--icon-left fr-fi-close-line fr-text text-bold text-red-error" href="#">Quitter</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
  export default {
    name: "HeaderComponent"
  };
</script>

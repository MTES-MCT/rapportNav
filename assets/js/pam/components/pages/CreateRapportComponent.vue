<template>
  <div class=" fr-mt-9w">
    <div class="fr-grid-row">
      <div class="listMenuSide fr-mr-5w">
        <nav class="fr-ml-14w fr-text--sm fr-mt-n1w">
          <ul class="list-unstyled">
            <div class="fr-grid-row">
              <div class="fr-col-2"><span class="fr-fi-arrow-right-line fr-fi" aria-hidden="true"></span></div>
              <div class="fr-col-10"><li class="nav-list active text-icon--left"> Informations générales</li></div>
            </div>
            <div class="fr-grid-row">
              <div class="fr-col-2"></div>
              <div class="fr-col-10"><li class="nav-list">Activités du navire</li></div>
            </div>
            <div class="fr-grid-row">
              <div class="fr-col-2"></div>
              <div class="fr-col-10"><li class="nav-list">Contrôles opérationnels</li></div>
            </div>
            <div class="fr-grid-row">
              <div class="fr-col-2"></div>
              <div class="fr-col-10"><li class="nav-list">Indicateurs de missions</li></div>
            </div>

          </ul>
        </nav>
      </div>

      <div class=" mainContent">
        <h5 class="text-blue-france text-800">Informations générales</h5>
        <div class="box-shadow-card informationGeneral">
          <div class="box-shadow-card-body">
            <h6>Dates de la marée</h6>
            <div class="form-inline">
              <label class="fr-label" for="start-date">
                De
              </label>
              <div class="fr-input-wrap">
                <input class="form-valid form-custom form-date" type="date" id="start-date" name="text-input-calendar">
              </div>
              <div class="fr-input-wrap">
                <input class="form-valid form-custom form-time  " type="time" id="start-time" name="text-input-calendar">
              </div>

              <label class="fr-label" for="end-date">
                à
              </label>
              <div class="fr-input-wrap">
                <input class="fr-input" type="date" id="text-input-text" name="text-input-text">
              </div>
              <div class="fr-input-wrap">
                <input class="form-time" type="time" id="end-time" name="text-input-calendar">
              </div>
            </div>
            <div class="divider-horizontal"></div>

            <div class="equipage fr-mt-3w">
              <h6>Equipage</h6>
              <div class="fr-container--fluid">
                <div class="fr-grid-row">
                  <div class="fr-col-8">
                    <div class="fr-grid-row">
                      <div class="fr-col-4">
                        <ul class="no-style">
                          <li class="equipier">
                            <div class="fr-grid-row">
                              <div class="fr-col-11 equipName ">
                                David Vincent-Ramassamy
                                <span class="equipRole">Commandant</span>
                              </div>
                              <div class="fr-col-1 tooltip">
                                <span class="ri-more-fill more-option-icon ">
                                </span>
                                <div class="tooltipBox fr-px-2w fr-py-2w">
                                  <input class="fr-input" type="text" id="text-input-groups1" name="text-input-groups1" value="David Vincent">

                                  <select class="fr-select fr-mt-3v" id="select" name="select">
                                    <option value="1">Commandant</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                    <option value="4">Option 4</option>
                                  </select>

                                  <textarea class="fr-input fr-mt-3v" id="textarea" name="textarea" placeholder="Observations"></textarea>

                                  <button class="custom-btn fr-fi-checkbox-circle-line fr-btn--icon-left fr-mt-3v remove-equip-btn">
                                    Supprimer le membre
                                  </button>
                                </div>
                              </div>

                            </div>
                          </li>
                          <li>
                            <div class="fr-grid-row equipier">
                              <div class="fr-col-11 equipName">
                                David Vincent
                                <span class="equipRole">Commandant</span>
                              </div>
                              <div class="fr-col-1 ">
                                <i class="ri-more-fill more-option-icon"></i>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="fr-grid-row equipier">
                              <div class="fr-col-11 equipName">
                                David Vincent
                                <span class="equipRole">Commandant</span>
                              </div>
                              <div class="fr-col-1 ">
                                <i class="ri-more-fill more-option-icon"></i>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="fr-grid-row equipier">
                              <div class="fr-col-11 equipName">
                                David Vincent
                                <span class="equipRole">Commandant</span>
                              </div>
                              <div class="fr-col-1 ">
                                <i class="ri-more-fill more-option-icon"></i>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>

                      <div class="fr-col-4">
                        <ul class="no-style">
                          <li class="equipier">
                            <div class="fr-grid-row">
                              <div class="fr-col-11 equipName">
                                David Vincent-Miantchy
                                <span class="equipRole">Commandant</span>
                              </div>
                              <div class="fr-col-1 ">
                                <i class="ri-more-fill more-option-icon"></i>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="fr-grid-row equipier">
                              <div class="fr-col-11 equipName">
                                David Vincent
                                <span class="equipRole">Commandant</span>
                              </div>
                              <div class="fr-col-1 ">
                                <i class="ri-more-fill more-option-icon"></i>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="fr-grid-row equipier">
                              <div class="fr-col-11 equipName">
                                David Vincent
                                <span class="equipRole">Commandant</span>
                              </div>
                              <div class="fr-col-1 ">
                                <i class="ri-more-fill more-option-icon"></i>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="fr-grid-row equipier">
                              <div class="fr-col-11 equipName">
                                David Vincent
                                <span class="equipRole">Commandant</span>
                              </div>
                              <div class="fr-col-1 ">
                                <i class="ri-more-fill more-option-icon"></i>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>

                      <div class="fr-col-4">
                        <ul class="no-style">
                          <li class="equipier">
                            <div class="fr-grid-row">
                              <div class="fr-col-11 equipName">
                                David Vincent
                                <span class="equipRole">Commandant</span>
                              </div>
                              <div class="fr-col-1 ">
                                <i class="ri-more-fill more-option-icon"></i>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="fr-grid-row equipier">
                              <div class="fr-col-11 equipName">
                                David Vincent
                                <span class="equipRole">Commandant</span>
                              </div>
                              <div class="fr-col-1 ">
                                <i class="ri-more-fill more-option-icon"></i>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="fr-grid-row equipier">
                              <div class="fr-col-11 equipName">
                                David Vincent
                                <span class="equipRole">Commandant</span>
                              </div>
                              <div class="fr-col-1 ">
                                <i class="ri-more-fill more-option-icon"></i>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="fr-grid-row equipier">
                              <div class="fr-col-11 equipName">
                                David Vincent
                                <span class="equipRole">Commandant</span>
                              </div>
                              <div class="fr-col-1 ">
                                <i class="ri-more-fill more-option-icon"></i>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>

                  </div>
                  <div class="fr-col-4">
                    <input class="fr-input" type="text" id="text-input-text" name="text-input-text" placeholder="Ajouter des membres">
                  </div>
                </div>
              </div>
            </div>
            <div class="divider-horizontal"></div>
            <div class="mission fr-mt-3w">
              <h6>Missions à réaliser <span class="fr-fi-xs fr-fi-information-fill icon-grey" aria-hidden="true"></span> </h6>
              <div class="fr-container--fluid fr-mt-4w">
                <div class="fr-grid-row">
                  <div class="fr-col-6 fr-pr-4w">
                    <div class="fr-form-group">
                      <fieldset class="fr-fieldset">
                        <div class="fr-fieldset__content">

                          <div class="checkbox-group main-task-active">
                            <div class="fr-checkbox-group fr-checkbox-group--sm ">
                              <input type="checkbox" id="checkboxes-1" name="checkboxes-1">
                              <label class="fr-label text-sm" for="checkboxes-1">Assistance aux navires en difficultés
                              </label>
                            </div>
                            <div class="fr-toggle fr-toggle--label-left toggle-custom">
                              <input type="checkbox" class="fr-toggle__input" aria-describedby="toggle-698-hint-text" id="toggle-698">
                              <label class="fr-toggle__label" for="toggle-698">Mission principale</label>
                            </div>
                          </div>

                          <div class="checkbox-group">
                            <div class="fr-checkbox-group fr-checkbox-group--sm ">
                              <input type="checkbox" id="checkboxes-2" name="checkboxes-1">
                              <label class="fr-label text-sm" for="checkboxes-3">Répression contre les rejets illicites, lutte contre les pollutions et protection de l’environnement
                              </label>
                            </div>
                          </div>


                          <div class="checkbox-group">
                            <div class="fr-checkbox-group fr-checkbox-group--sm ">
                              <input type="checkbox" id="checkboxes-3" name="checkboxes-1">
                              <label class="fr-label text-sm" for="checkboxes-3">Surveillance et contrôles pour la protection de l’environnement
                              </label>
                            </div>
                          </div>

                          <div class="checkbox-group main-task-active">
                            <div class="fr-checkbox-group fr-checkbox-group--sm ">
                              <input type="checkbox" id="checkboxes-4" name="checkboxes-1">
                              <label class="fr-label text-sm" for="checkboxes-1">Souveraineté et protection des intérêts nationaux
                              </label>
                            </div>
                            <div class="fr-toggle fr-toggle--label-left toggle-custom">
                              <input type="checkbox" class="fr-toggle__input" aria-describedby="toggle-699-hint-text" id="toggle-700">
                              <label class="fr-toggle__label" for="toggle-700">Mission principale</label>
                            </div>
                          </div>
                        </div>
                      </fieldset>
                    </div>
                  </div>

                  <div class="fr-col-6 with-vertical-divider fr-pl-4w">

                    <div class="fr-form-group">
                      <fieldset class="fr-fieldset">
                        <div class="fr-fieldset__content">

                          <div class="checkbox-group">
                            <div class="fr-checkbox-group fr-checkbox-group--sm ">
                              <input type="checkbox" id="checkboxes-5" name="checkboxes-5">
                              <label class="fr-label text-sm" for="checkboxes-5">Lutte contre l’immigration illégale par voie maritime
                              </label>
                            </div>
                          </div>

                          <div class="checkbox-group main-task-active">
                            <div class="fr-checkbox-group fr-checkbox-group--sm ">
                              <input type="checkbox" id="checkboxes-6" name="checkboxes-1">
                              <label class="fr-label text-sm" for="checkboxes-6">Lutte contre les activités de pêche illégale, gestion du patrimoine marin et des ressources publiques marines
                              </label>
                            </div>
                            <div class="fr-toggle fr-toggle--label-left toggle-custom">
                              <input type="checkbox" class="fr-toggle__input" aria-describedby="toggle-699-hint-text" id="toggle-699">
                              <label class="fr-toggle__label" for="toggle-698">Mission principale</label>
                            </div>
                          </div>

                          <div class="checkbox-group main-task-active">
                            <div class="fr-checkbox-group fr-checkbox-group--sm ">
                              <input type="checkbox" id="checkboxes-7" name="checkboxes-1">
                              <label class="fr-label text-sm" for="checkboxes-7">Sureté maritime
                              </label>
                            </div>
                            <div class="fr-toggle fr-toggle--label-left toggle-custom">
                              <input type="checkbox" class="fr-toggle__input" aria-describedby="toggle-699-hint-text" id="toggle-699">
                              <label class="fr-toggle__label" for="toggle-698">Mission principale</label>
                            </div>
                          </div>

                        </div>
                      </fieldset>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="heading-custom fr-mt-3w">
          <h5 class="text-blue-france text-800 ">Activité du navire</h5>
          <div class="total">
            <span>Total</span>
            <div class="total-values">
              <span class="dayInSea text-blue-france text-bold">10 jours en mer</span>
              <span class="missionTrackTime text-blue-france text-bold">52 heures de mission</span>
            </div>
          </div>
        </div>

        <!-- Activité du navire -->
        <div class="box-shadow-card shipActivity ">
          <div class="box-shadow-card-body">
            <!-- Présence à la mer -->
            <div class="presenceAtSea">
              <h6>Présence à la mer</h6>
              <div class="fr-container--fluid">
                <div class="fr-grid-row">
                  <div class="fr-col-4 fr-mr-2w">
                    <label class="fr-label" for="dayAtSeaInput">Nombre de jour en mer</label>
                    <input class="fr-input unit-placeholder fr-input-valid" value="10" type="text" id="dayAtSeaInput" name="text-input-text" placeholder="j">
                  </div>
                  <div class="fr-col-2 fr-mr-2w">
                    <label class="fr-label" for="navEff">Navigation eff.</label>
                    <input class="fr-input unit-placeholder fr-input-valid" type="text" value="99" id="navEff" name="text-input-text" placeholder="h">
                  </div>
                  <div class="fr-col-2">
                    <label class="fr-label" for="mouillage">Mouillage</label>
                    <input class="fr-input unit-placeholder" type="text" id="mouillage" name="text-input-text" placeholder="h">
                  </div>
                </div>
              </div>
            </div>

            <div class="divider-horizontal"></div>

            <!-- Présence à quai -->
            <div class="presenceAtQuai">
              <h6>Présence à quai</h6>
              <div class="fr-container--fluid">
                <div class="fr-grid-row">
                  <div class="fr-col input-group-100 fr-mr-1w">
                    <label class="fr-label" for="dayAtSeaInput">Maintenance</label>
                    <input class="fr-input unit-placeholder" type="text" id="maintenance" name="text-input-text" placeholder="h">
                  </div>
                  <div class="fr-col fr-mr-1w">
                    <label class="fr-label" for="navEff">Météo</label>
                    <input class="fr-input unit-placeholder" type="text" id="meteo" name="text-input-text" placeholder="h">
                  </div>
                  <div class="fr-col fr-mr-1w">
                    <label class="fr-label" for="representation">Répresentation</label>
                    <input class="fr-input unit-placeholder" type="text" id="representation" name="text-input-text" placeholder="h">
                  </div>
                  <div class="fr-col fr-mr-1w">
                    <label class="fr-label" for="administration">Administration</label>
                    <input class="fr-input unit-placeholder" type="text" id="administration" name="text-input-text" placeholder="h">
                  </div>
                  <div class="fr-col fr-mr-1w">
                    <label class="fr-label" for="autre">Autre</label>
                    <input class="fr-input unit-placeholder" type="text" id="autre" name="text-input-text" placeholder="h">
                  </div>
                  <div class="fr-col">
                    <label class="fr-label" for="contrPort">Contr. Port</label>
                    <input class="fr-input unit-placeholder" type="text" id="contrPort" name="text-input-text" placeholder="h">
                  </div>
                </div>
              </div>
            </div>

            <div class="divider-horizontal"></div>

            <!-- Indisponibilité -->
            <div class="unavailability">
              <h6>Indisponibilité</h6>
              <div class="fr-container--fluid">
                <div class="fr-grid-row">
                  <div class="fr-col-2 fr-mr-2w">
                    <label class="fr-label" for="technique">Technique</label>
                    <input class="fr-input unit-placeholder" type="text" id="technique" name="text-input-text" placeholder="h">
                  </div>
                  <div class="fr-col-2">
                    <label class="fr-label" for="personnel">Personnel</label>
                    <input class="fr-input unit-placeholder" type="text" id="personnel" name="text-input-text" placeholder="h">
                  </div>
                </div>
              </div>
            </div>

            <div class="divider-horizontal"></div>

            <!-- Distance et consommation -->
            <div class="distanceAndConso">
              <h6>Distance et consommation</h6>
              <div class="fr-container--fluid">
                <div class="fr-grid-row">
                  <div class="fr-col-3 fr-mr-2w">
                    <label class="fr-label" for="traveled">Distance parcourue</label>
                    <input class="fr-input unit-placeholder" type="text" id="traveled" name="text-input-text" placeholder="miles">
                  </div>
                  <div class="fr-col-3 fr-mr-2w">
                    <label class="fr-label" for="goConso">GO marine consommé</label>
                    <input class="fr-input unit-placeholder" type="text" id="goConso" name="text-input-text" placeholder="litres">
                  </div>
                  <div class="fr-col-3">
                    <label class="fr-label" for="essenceConso">Essence consommée</label>
                    <input class="fr-input unit-placeholder" type="text" id="essenceConso" name="text-input-text" placeholder="litres">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Contrôles opérationnel -->
        <div class="operationalControl fr-mt-10w">
          <div class="heading-custom heading-custom-space-between">
            <h5 class="text-blue-france text-800">Contrôles opérationnel</h5>
            <button class="fr-btn fr-btn--secondary" data-fr-opened="false" aria-controls="fr-modal-1">
              <i class="ri-add-circle-fill fr-mt-1v fr-mr-1w"></i> <span class="text-bold">Ajouter un contrôle</span>
            </button>
            <!-- Modale Simple
     La balise <dialog> peut être placée n'importe où sur la page, toutefois
     nous vous conseillons, si vous en avez la possibilité,
     d'en faire un enfant direct de la balise <body>
-->

            <dialog aria-labelledby="fr-modal-title-modal-1" role="dialog" id="fr-modal-1" class="fr-modal">
              <div class="fr-container fr-container--fluid fr-container-md">
                <div class="fr-grid-row fr-grid-row--center">
                  <div class="fr-col-12 fr-col-md-8">
                    <div class="fr-modal__body">
                      <div class="fr-modal__header">
                      </div>
                      <div class="fr-modal__content">
                        <h1 id="fr-modal-title-modal-4" class="fr-modal__title">Ajouter un contrôle</h1>
                        <div class="fr-container fr-grid-row--gutters fr-mt-5w">
                          <div class="row-flex">
                            <div class="add-control-box fr-mr-1v">
                              <span class="add-control-link">
                                <i class="ri-ship-2-fill add-control-icon"></i>
                                Contrôle en mer de navires de pêche professionnelle
                              </span>
                            </div>
                            <div class="add-control-box fr-mr-1v">
                              <span class="add-control-link  ">
                                <i class="ri-ship-fill add-control-icon"></i>
                                Contrôle en mer de navires de plaisance professionnelle
                              </span>
                            </div>
                            <div class="add-control-box ">
                              <span class="add-control-link ">
                                <i class="ri-sailboat-line add-control-icon"></i>
                                Contrôle en mer des navires de plaisance de loisir
                              </span>
                            </div>
                          </div>
                          <div class="fr-grid-row fr-mt-2w">
                            <div class="fr-col-4 add-control-box">
                              <span class="add-control-link">
                                <i class="ri-ship-2-line add-control-icon"></i>
                                Contrôle à terre de navires de pêche professionnelle
                              </span>
                            </div>
                            <div class="fr-col-4 add-control-box fr-ml-1v">
                              <span class="add-control-link  ">
                                <i class="ri-more-fill add-control-icon"></i>
                                Autre mission
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </dialog>
          </div>

          <div class="box-dropdown fr-mt-2w">
            <ul class="fr-accordions-group">
              <li>
                <div class="box-shadow-card">
                  <section class="fr-accordion box-shadow-card-body">
                    <div class="fr-accordion__title ">
                      <div class="fr-container--fluid">
                        <div class="fr-grid-row">
                          <div class="fr-col-11">
                            <button class="fr-accordion__btn fr-fi-arrow-down-s-line fr-btn--icon-left" aria-expanded="true" aria-controls="accordion-89">
                              Contrôle en mer des navires de pêche professionnelle
                            </button>
                          </div>
                          <div class="fr-col-1 fr-mt-2v">
                            <button class="fr-fi-delete-fill btn-remove" aria-hidden="true"></button>
                          </div>
                      </div>
                      </div>
                    </div>
                    <div class="fr-collapse" id="accordion-89">

                      <div class="fr-table ">
                        <div class="divider-horizontal--accordion"></div>
                        <table>
                          <thead>
                          <tr>
                            <th scope="col">
                              <div class="col-width">Pavillon</div>
                            </th>
                            <th scope="col"><div class="col-width">Nb de navires contrôlés</div></th>
                            <th scope="col"><div class="col-width">Nb PV pêche sanitaire</div></th>
                            <th scope="col"><div class="col-width">Nb PV titre navig role/déc. eff</div></th>
                            <th scope="col" class="text-icon--left text-blue-france-250"><i class="ri-add-circle-fill"></i> Ajouter un PV, nav déroutés...</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td class="">
                              <select class="select">
                                <option>FR</option>
                                <option>US</option>
                                <option>ES</option>
                              </select>
                            </td>
                            <td contenteditable="true" style="width: 20%"></td>
                            <td contenteditable="true"></td>
                            <td contenteditable="true"></td>
                            <td class="no-exist"></td>
                          </tr>
                          <div class="add-pavillon"><i class="ri-add-circle-fill"></i>  Ajouter un pavillon</div>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </section>
                </div>

              </li>

              <li>
                <section class="fr-accordion box-shadow-card">
                  <div class="fr-accordion__title ">
                    <div class="fr-container--fluid">
                      <div class="fr-grid-row">
                        <div class="fr-col-11">
                          <button class="fr-accordion__btn fr-fi-arrow-down-s-line fr-btn--icon-left" aria-expanded="true" aria-controls="accordion-89">
                            Contrôle en mer des navires de plaisance non professionnels
                          </button>
                        </div>
                        <div class="fr-col-1 fr-mt-2v">
                          <button class="fr-fi-delete-fill btn-remove" aria-hidden="true"></button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="fr-collapse" id="accordion-90">
                    <!-- données de test -->
                  </div>
                </section>
              </li>
            </ul>
          </div>
        </div>


        <!-- Indicateurs de mission -->
        <div class="indicMission fr-mt-10w">
          <div class="heading-custom heading-custom-space-between">
            <h5 class="text-blue-france text-800">Indicateurs de mission</h5>
          </div>

          <div class=" box-dropdown">
            <ul class="fr-accordions-group">
              <li>
                <section class="fr-accordion box-shadow-card">
                  <div class="fr-accordion__title ">
                    <div class="fr-container--fluid">
                      <div class="fr-grid-row">
                        <div class="fr-col">
                          <button class="fr-accordion__btn fr-fi-arrow-down-s-line fr-btn--icon-left" aria-expanded="true" aria-controls="accordion-105">
                            Contrôle en mer des navires de pêche professionnelle
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="fr-collapse" id="accordion-105">
                    <div class="fr-table ">
                      <div class="divider-horizontal--accordion"></div>
                      <table>
                        <thead>
                        <tr>
                          <th scope="col">
                            <div class="col-width">Missions</div>
                          </th>
                          <th scope="col"><div class="col-width">Principale</div></th>
                          <th scope="col"><div class="col-width">Secondaire</div></th>
                          <th scope="col"><div class="col-width">Total</div></th>
                          <th scope="col" class=""> Observations</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td class="">
                          </td>
                          <td contenteditable="true" style="width: 20%"></td>
                          <td contenteditable="true"></td>
                          <td contenteditable="true"></td>
                          <td class=" icon-center"><i class="ri-message-2-fill"></i></td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </section>
              </li>

              <li>
                <section class="fr-accordion box-shadow-card">
                  <h3 class="fr-accordion__title ">
                    <button class="fr-accordion__btn fr-fi-arrow-down-s-line fr-btn--icon-left" aria-expanded="true" aria-controls="accordion-92">
                      Lutte contre l’immigration illégale par voie maritime
                    </button>
                  </h3>
                  <div class="fr-collapse" id="accordion-92">
                    <!-- données de test -->
                  </div>
                </section>
              </li>
            </ul>
          </div>
        </div>
      </div>



      <div class="listMenuSide">
        <h6><i class="ri-history-line fr-mt-4w fr-mr-1v"></i> Historique</h6>
        <div class="fr-container--fluid-auto">
          <div class="history-group">
            <span class="history-date">Aujourd'hui</span>
            <div class="history-body">
              <div class="fr-grid-row">
                <div class="fr-col">
                  <span class="history-time">19:12</span>
                </div>
              </div>
              <div class="fr-grid-row">
                <div class="fr-col-2">
                  <img src="http://placebeard.it/155/150?26" class="fr-responsive-img" alt="">
                </div>
                <div class="fr-col-8 fr-ml-2v">
                  <p class="history-main-content">
                    <span class="text-bold">Romain Crampon</span> à réalisé 2 modifications.
                    <span class="history-see-more-details">Masquer les détails</span>
                  </p>
                  <div class="history-details">
                    <hr>
                    Ajout de "David Vincent" aux membres de l'équipe
                  </div>
                </div>
              </div>
            </div>

            <div class="history-body">
              <div class="fr-grid-row">
                <div class="fr-col">
                  <span class="history-time">13:12</span>
                </div>
              </div>
              <div class="fr-grid-row">
                <div class="fr-col-2">
                  <img src="http://placebeard.it/155/150?26" class="fr-responsive-img" alt="">
                </div>
                <div class="fr-col-8 fr-ml-2v">
                  <p class="history-main-content">
                    <span class="text-bold">Romain Crampon</span> à réalisé 2 modifications.
                    <span class="history-see-more-details">Voir les details</span>
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="history-group">
            <span class="history-date">jeudi 16 septembre</span>
            <div class="history-body">
              <div class="fr-grid-row">
                <div class="fr-col">
                  <span class="history-time">14:12</span>
                </div>
              </div>
              <div class="fr-grid-row">
                <div class="fr-col-2">
                  <img src="http://placebeard.it/155/150?26" class="fr-responsive-img" alt="">
                </div>
                <div class="fr-col-8 fr-ml-2v">
                  <p class="history-main-content">
                    <span class="text-bold">Romain Crampon</span> à réalisé 2 modifications.
                    <span class="history-see-more-details">Masquer les détails</span>
                  </p>
                  <div class="history-details">
                    <hr>
                    Ajout de "David Vincent" aux membres de l'équipe
                  </div>
                </div>
              </div>
            </div>

            <div class="history-body">
              <div class="fr-grid-row">
                <div class="fr-col">
                  <span class="history-time">11:12</span>
                </div>
              </div>
              <div class="fr-grid-row">
                <div class="fr-col-2">
                  <img src="http://placebeard.it/155/150?26" class="fr-responsive-img" alt="">
                </div>
                <div class="fr-col-8 fr-ml-2v">
                  <p class="history-main-content">
                    <span class="text-bold">Romain Crampon</span> à réalisé 2 modifications.
                    <span class="history-see-more-details">Voir les details</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CreateRapportComponent"
};
</script>

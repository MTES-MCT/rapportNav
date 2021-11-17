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
          <h6>Dates de la marée</h6>
          <div class="form-inline">
              <label class="fr-label" for="start-date">
                De
              </label>
              <div class="fr-input-wrap fr-fi-calendar-line">
                <input class="form-valid form-custom form-date" type="date" id="start-date" name="text-input-calendar">
              </div>
              <div class="fr-input-wrap">
                <input class="form-valid form-custom form-time" type="time" id="start-time" name="text-input-calendar">
              </div>

              <label class="fr-label" for="end-date">
                à
              </label>
              <div class="fr-input-wrap fr-fi-calendar-line">
                <input class="form-date" type="date" id="end-date" name="text-input-calendar">
              </div>
              <div class="fr-input-wrap">
                <input class="form-time" type="time" id="end-time" name="text-input-calendar">
              </div>
          </div>
          <div class="divider-horizontal"></div>

         <div class="equipage fr-mt-3w">
           <h6>Equipage</h6>
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
          <!-- Présence à la mer -->
          <div class="presenceAtSea">
            <h6>Présence à la mer</h6>
            <div class="fr-container--fluid">
              <div class="fr-grid-row">
                <div class="fr-col-4 fr-mr-2w">
                  <label class="fr-label" for="dayAtSeaInput">Nombre de jour en mer</label>
                  <input class="fr-input" type="text" id="dayAtSeaInput" name="text-input-text">
                </div>
                <div class="fr-col-2 fr-mr-2w">
                  <label class="fr-label" for="navEff">Navigation eff.</label>
                  <input class="fr-input" type="text" id="navEff" name="text-input-text">
                </div>
                <div class="fr-col-2">
                  <label class="fr-label" for="mouillage">Mouillage</label>
                  <input class="fr-input" type="text" id="mouillage" name="text-input-text">
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
                  <input class="fr-input" type="text" id="maintenance" name="text-input-text">
                </div>
                <div class="fr-col fr-mr-1w">
                  <label class="fr-label" for="navEff">Météo</label>
                  <input class="fr-input" type="text" id="meteo" name="text-input-text">
                </div>
                <div class="fr-col fr-mr-1w">
                  <label class="fr-label" for="representation">Répresentation</label>
                  <input class="fr-input" type="text" id="representation" name="text-input-text">
                </div>
                <div class="fr-col fr-mr-1w">
                  <label class="fr-label" for="administration">Administration</label>
                  <input class="fr-input" type="text" id="administration" name="text-input-text">
                </div>
                <div class="fr-col fr-mr-1w">
                  <label class="fr-label" for="autre">Autre</label>
                  <input class="fr-input" type="text" id="autre" name="text-input-text">
                </div>
                <div class="fr-col">
                  <label class="fr-label" for="contrPort">Contr. Port</label>
                  <input class="fr-input" type="text" id="contrPort" name="text-input-text">
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
                  <input class="fr-input" type="text" id="technique" name="text-input-text">
                </div>
                <div class="fr-col-2">
                  <label class="fr-label" for="personnel">Personnel</label>
                  <input class="fr-input" type="text" id="personnel" name="text-input-text">
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
                  <input class="fr-input" type="text" id="traveled" name="text-input-text">
                </div>
                <div class="fr-col-3 fr-mr-2w">
                  <label class="fr-label" for="goConso">GO marine consommé</label>
                  <input class="fr-input" type="text" id="goConso" name="text-input-text">
                </div>
                <div class="fr-col-3">
                  <label class="fr-label" for="essenceConso">Essence consommée</label>
                  <input class="fr-input" type="text" id="essenceConso" name="text-input-text">
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Contrôles opérationnel -->
        <div class="operationalControl">
          <div class="heading-custom heading-custom-space-between">
            <h5 class="text-blue-france text-800">Contrôles opérationnel</h5>
            <button class="fr-btn fr-btn--secondary">
              <i class="ri-add-circle-fill fr-mt-1v fr-mr-1w"></i> <span class="text-bold">Ajouter un contrôle</span>
            </button>
          </div>

          <div class=" box-dropdown">
            <ul class="fr-accordions-group">
              <li>
                <section class="fr-accordion box-shadow-card">
                  <h3 class="fr-accordion__title ">
                    <button class="fr-accordion__btn fr-fi-arrow-down-s-line fr-btn--icon-left" aria-expanded="true" aria-controls="accordion-89">
                      Contrôle en mer des navires de pêche professionnelle
                    </button>
                  </h3>
                  <div class="fr-collapse" id="accordion-89">
                    <!-- données de test -->
                  </div>
                </section>
              </li>

              <li>
                <section class="fr-accordion box-shadow-card">
                  <h3 class="fr-accordion__title ">
                    <button class="fr-accordion__btn fr-fi-arrow-down-s-line fr-btn--icon-left" aria-expanded="false" aria-controls="accordion-90">Intitulé accordéon</button>
                    <span class="accordion-helper">2 navires controlés</span>
                  </h3>
                  <div class="fr-collapse" id="accordion-90">
                    <!-- données de test -->
                  </div>
                </section>
              </li>
            </ul>
          </div>
        </div>

        <div class="fr-table ">
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
        <!-- Indicateurs de mission -->
        <div class="indicMission">
          <div class="heading-custom heading-custom-space-between">
            <h5 class="text-blue-france text-800">Indicateurs de mission</h5>
          </div>

          <div class=" box-dropdown">
            <ul class="fr-accordions-group">
              <li>
                <section class="fr-accordion box-shadow-card">
                  <h3 class="fr-accordion__title ">
                    <button class="fr-accordion__btn fr-fi-arrow-down-s-line fr-btn--icon-left" aria-expanded="true" aria-controls="accordion-91">
                      Contrôle en mer des navires de pêche professionnelle
                    </button>
                  </h3>
                  <div class="fr-collapse" id="accordion-91">
                    <!-- données de test -->
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



      <div class="listMenuSide"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CreateRapportComponent"
};
</script>

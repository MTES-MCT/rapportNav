<template>
    <div class="box-shadow-card-body" id="generalInformation">
      <h6>Dates de la marée</h6>
      <div class="form-inline">
        <label class="fr-label" for="start-date">
          De
        </label>
        <div class="fr-input-wrap">
          <input class="form-custom form-date" type="date" id="start-date" name="text-input-calendar">
        </div>
        <div class="fr-input-wrap">
          <input class="form-custom form-time" type="time" id="start-time" name="text-input-calendar">
        </div>

        <label class="fr-label" for="end-date">
          à
        </label>
        <div class="fr-input-wrap">
          <input class="form-custom form-date" type="date" id="end-date" name="text-input-text">
        </div>
        <div class="fr-input-wrap">
          <input class="form-time form-custom" type="time" id="end-time" name="text-input-calendar">
        </div>
      </div>
      <div class="divider-horizontal"></div>

      <div class="equipage fr-mt-3w">
        <h6>Equipage</h6>
        <div class="fr-container--fluid">
              <EquipageComponent></EquipageComponent>
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
                      <div class="define-date">
                        Définir les dates
                        <div class="define-date-form">
                          <div class="fr-input-group">
                            <label class="fr-label fr-label-left" for="text-input-calendar">
                              Du
                            </label>
                            <div class="fr-container--fluid">
                              <div class="fr-grid-row">
                                <div class="fr-col-lg-5 fr-col-sm-6">
                                  <div class="fr-input-wrap fr-fi-calendar-line">
                                    <input class="fr-input" type="date" name="text-input-calendar">
                                  </div>
                                </div>
                                <div class="fr-col-lg-5 fr-col-sm-6">
                                  <div class="">
                                    <input class="fr-input" type="time" name="text-input-calendar">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="fr-input-group">
                            <label class="fr-label fr-label-left" for="text-input-calendar">
                              au
                            </label>
                            <div class="fr-container--fluid">
                              <div class="fr-grid-row">
                                <div class="fr-col-5">
                                  <div class="fr-input-wrap fr-fi-calendar-line">
                                    <input class="fr-input" type="date" id="text-input-calendar" name="text-input-calendar">
                                  </div>
                                </div>
                                <div class="fr-col-5">
                                  <div class="">
                                    <input class="fr-input" type="time" id="text-input-calendar" name="text-input-calendar">
                                  </div>
                                </div>
                              </div>
                              <button class=""></button>
                            </div>
                          </div>
                        </div>
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
</template>

<script>
import EquipageComponent from "../EquipageComponent";

export default {
  name: "GeneralInformationCardComponent",
  components: { EquipageComponent },
  methods: {
    checkInputFilled() {
     let $input = $('.form-custom');
     $.map($input, (el) => {
       if($(el).val() === '') {
         $(el).addClass('form-not-filled')
       }
     })
    }
  },
  mounted() {
    this.checkInputFilled()
  }
}
</script>

<style scoped>

</style>
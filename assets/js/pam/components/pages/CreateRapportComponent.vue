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
        <div class="box-shadow-card">
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

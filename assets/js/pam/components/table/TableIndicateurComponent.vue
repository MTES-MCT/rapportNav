<template>
  <div class="table-custom">
    <table class="table-indicateur">
      <thead class="thead-indicateur">
      <th class="th-indicateur" scope="col">Missions</th>
      <th class="th-indicateur" scope="col">Principale</th>
      <th class="th-indicateur" scope="col">Secondaire</th>
      <th class="total-column th-indicateur" scope="col">Total</th>
      <th class="th-indicateur" scope="col">Observations</th>
      </thead>

      <tbody v-if="category !== 4">
        <tr class="tr-indicateur" v-for="(indicateur, index) in indicateurs">
          <th class="th-tr-indicateur" scope="row">{{ indicateur.category.nom }}</th>
          <TdEditableIndicateur :value="indicateur.principale" @change="setValue(indicateur, $event, 'principale', index)" :indicateur="indicateur" :is-main-mission="mission.is_main" :is-principale-cell="true" />
          <TdEditableIndicateur :value="indicateur.secondaire" @change="setValue(indicateur, $event, 'secondaire', index)" :indicateur="indicateur" :is-main-mission="mission.is_main"  :is-principale-cell="false"  />
          <TdEditableIndicateur :value="indicateur.total" is-total-cell />
          <TdEditableIndicateur v-model="indicateur.observations" observation />
        </tr>
      </tbody>
      <tbody v-else>
        <tr v-for="(indicateur, index) in indicateurs" :key="indicateur.category.id" v-if="indicateur.category.id === 13">
          <th class="th-tr-indicateur" scope="row">{{ indicateur.category.nom }}</th>
          <TdEditableIndicateur :value="indicateur.principale" @change="setValue(indicateur, $event, 'principale', index)" :indicateur="indicateur" :is-main-mission="mission.is_main" :is-principale-cell="true"   />
          <TdEditableIndicateur :value="indicateur.secondaire" @change="setValue(indicateur, $event, 'secondaire', index)" :indicateur="indicateur" :is-main-mission="mission.is_main"  :is-principale-cell="false"   />
          <TdEditableIndicateur :value="indicateur.total" is-total-cell />
          <TdEditableIndicateur v-model="indicateur.observations" observation />
        </tr>

        <tr v-else-if="indicateur.category.id === 14 || indicateur.category.id === 15">
          <th class="th-tr-indicateur-child" scope="row">... {{ indicateur.category.nom }}</th>
          <TdEditableIndicateur :value="indicateur.principale" @change="setValue(indicateur, $event, 'principale', index)" is-indicateur-child :indicateur="indicateur" :is-main-mission="mission.is_main" :is-principale-cell="true"   />
          <TdEditableIndicateur :value="indicateur.secondaire" @change="setValue(indicateur, $event, 'secondaire', index)" is-indicateur-child :indicateur="indicateur" :is-main-mission="mission.is_main"  :is-principale-cell="false"   />
          <TdEditableIndicateur :value="indicateur.total" is-total-cell is-indicateur-child />
          <TdEditableIndicateur v-model="indicateur.observations" observation is-indicateur-child />
        </tr>

        <tr v-else>
          <th class="th-tr-indicateur" scope="row">{{ indicateur.category.nom }}</th>
          <TdEditableIndicateur :value="indicateur.principale" @change="setValue(indicateur, $event, 'principale', index)" :indicateur="indicateur" :is-main-mission="mission.is_main" :is-principale-cell="true"   />
          <TdEditableIndicateur :value="indicateur.secondaire" @change="setValue(indicateur, $event, 'secondaire', index)" :indicateur="indicateur" :is-main-mission="mission.is_main"  :is-principale-cell="false"  />
          <TdEditableIndicateur :value="indicateur.total" is-total-cell />
          <TdEditableIndicateur v-model="indicateur.observations" observation />
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import TdEditable from "./TdEditable";
import TdEditableIndicateur from "./TdEditableIndicateur";
export default {
  name: "TableIndicateurComponent",
  components: {TdEditableIndicateur, TdEditable},
  props: {
    id : {
      type: Number,
      default: null
    },
    category: {
      type: Number,
      default: null
    },
    mission: Object,
    controles: Array,
    autresMissions: Object
  },
  methods: {
    setValue(indicateur, value, scope, index) {
      if(!indicateur.automaticEnabled) {
        indicateur.reset = false;
        if(scope === 'principale') {
          indicateur.principale = value;
        } else {
          indicateur.secondaire = value;
        }
      } else {
        if(scope === 'principale') {
          indicateur.principale = indicateur.automaticValue;
          indicateur.secondaire = null;
        } else {
          indicateur.secondaire = indicateur.automaticValue;
          indicateur.principale = null;
        }
      }

      this.setTotal(indicateur, index);
    },
    setAutomaticValue(indicateur, value, index) {
      if(indicateur.automaticEnabled) {
        indicateur.reset = true;
        if(this.mission.is_main) {
          indicateur.principale = value;
          indicateur.secondaire = null;
        } else {
          indicateur.secondaire = value;
          indicateur.principale = null;
        }
      } else {
        indicateur.reset = false;
      }

      indicateur.automaticValue = value;
      return this.setTotal(indicateur, index);
    },
    setTotal(indicateur, index) {
      let total = indicateur.automaticEnabled ? indicateur.automaticValue : indicateur.principale + indicateur.secondaire;
      return this.indicateurs[index].total = !isNaN(total) ? total : null;
    },
    setAutomaticAssistanceNavire(indicateurCategoryNom, value) {
      if(this.mission.category.nom === 'Assistance aux navires en difficulté et sécurité maritime') {
        this.indicateurs.filter((indicateur, index) => {
          if(indicateur.category.nom === indicateurCategoryNom) {
            this.setAutomaticValue(indicateur, value, index);
          }
        })
      }
    },
    setAutomaticLuttePollution(indicateurCategoryNom, value, isControleOp = false, controles = []) {
      if(this.mission.category.nom === 'Répression contre les rejets illicites, lutte contre les pollutions et protection de l\'environnement') {
        this.indicateurs.filter((indicateur, index) => {
          if(indicateur.category.nom === indicateurCategoryNom) {
            if(isControleOp) {
              let envPollution = [];
              controles.forEach((controle) => {
                envPollution.push(controle.nb_pv_env_pollution);
              });
              let total = 0;
              envPollution.forEach(pv =>  total += pv);
              this.setAutomaticValue(indicateur, total, index);
            } else {
              this.setAutomaticValue(indicateur, value, index);
            }
          }
        })
      }
    },
    setAutomaticPecheIllegale(controles) {
      let nbPvPecheSanitaire = [];
      let nbControlePecheSanitaire = [];

      controles.forEach((controle) => {
        if(controle.category.nom.includes('en mer')) {
          nbControlePecheSanitaire.push(controle.nb_controles_peche_sanitaire);
          nbPvPecheSanitaire.push(controle.nb_pv_peche_sanitaire);
        }
      });

      if(this.mission.category.nom === 'Lutte contre les activités de pêche illégale, gestion du patrimoine marin et des ressources publiques marines') {
        this.indicateurs.filter((indicateur, index) => {
          if(indicateur.category.nom === 'Nombre de navires contrôlés en mer (législation pêche)') {
            let total = 0;
            nbControlePecheSanitaire.forEach((pv) => {
              total += pv;
            })
            this.setAutomaticValue(indicateur, total, index);
          }

          if(indicateur.category.nom === 'Nombre de procès-verbaux dressés (législation pêche)') {
            let total = 0;
            nbPvPecheSanitaire.forEach((pv) => {
              total += pv;
            })
            this.setAutomaticValue(indicateur, total, index);
          }
        })
      }
    }
  },
  watch: {
    'autresMissions.nbAssistanceSauvetage': function(value) {
      this.setAutomaticAssistanceNavire('Nombre d\'opérations suivies (ayant fait l\'objet d\'un DEFREP)', value);
    },
    'autresMissions.dureeAssistanceSauvetage': function(value) {
      this.setAutomaticAssistanceNavire('Nombre d\'heures de mer', value);
    },
    'autresMissions.dureeLuttePollution': function(value) {
      this.setAutomaticLuttePollution('Nombre d\'heures de mer (surveillance et lutte)', value);
    },
    'autresMissions.nbLuttePollution': function(value) {
      this.setAutomaticLuttePollution('Nombre d\'opérations de lutte anti-pollution en mer', value);
    },
    'controles': function(controles) {
      this.setAutomaticLuttePollution('Nombre de procès-verbaux d\'infraction dressés', null,true, controles);
      this.setAutomaticPecheIllegale(controles);
    },
    'mission.is_main': function(value) {
      this.setAutomaticAssistanceNavire('Nombre d\'opérations suivies (ayant fait l\'objet d\'un DEFREP)', this.autresMissions.nbAssistanceSauvetage);
      this.setAutomaticAssistanceNavire('Nombre d\'heures de mer', this.autresMissions.dureeAssistanceSauvetage);
      this.setAutomaticLuttePollution('Nombre d\'heures de mer (surveillance et lutte)', this.autresMissions.dureeLuttePollution);
      this.setAutomaticLuttePollution('Nombre d\'opérations de lutte anti-pollution en mer', this.autresMissions.nbLuttePollution);
      this.setAutomaticLuttePollution('Nombre de procès-verbaux d\'infraction dressés', null, true, this.controles);
      this.setAutomaticPecheIllegale(this.controles);
    }
  },
  data() {
    return {
      indicateurs: this.mission.indicateurs
    }
  }
}
</script>

<style scoped>

</style>

// Require all css stylesheet from @gouvfr/dsfr
function requireAllCss(r) { r.keys().forEach(r); }
//requireAllCss(require.context('../../../../../node_modules/@gouvfr/dsfr/dist/css/', true, /\.css$/));

// Require all js files from @gouvfr/dsfr
import jquery from 'jquery';
import  '@gouvfr/dsfr/dist/css/core.css';
import '@gouvfr/dsfr/dist/css/header.min.css';
import '@gouvfr/dsfr/dist/css/buttons.min.css';
import '@gouvfr/dsfr/dist/css/accordions.min.css';
import '@gouvfr/dsfr/dist/css/cards.min.css';
import '@gouvfr/dsfr/dist/css/inputs.min.css';
import '@gouvfr/dsfr/dist/css/toggles.min.css';
import '@gouvfr/dsfr/dist/css/checkboxes.min.css';
import '@gouvfr/dsfr/dist/css/utilities.min.css';
import '@gouvfr/dsfr/dist/css/content.min.css';
import '@gouvfr/dsfr/dist/css/skiplinks.min.css';
import '@gouvfr/dsfr/dist/css/tiles.min.css';
import '@gouvfr/dsfr/dist/css/forms.min.css';
import '@gouvfr/dsfr/dist/css/sidemenu.min.css';
import '@gouvfr/dsfr/dist/css/selects.min.css';
import '@gouvfr/dsfr/dist/css/alerts.min.css';
import '@gouvfr/dsfr/dist/css/schemes.min.css';
import '@gouvfr/dsfr/dist/css/navigation.min.css';
import '@gouvfr/dsfr/dist/css/summary.min.css';
import '../../../../css/pam/base.css';
import 'remixicon/fonts/remixicon.css';
import '@gouvfr/dsfr/dist/js/dsfr.module.min.js';
//import '@gouvfr/dsfr/dist/js/dsfr.nomodule.min.js';
import '@gouvfr/dsfr/dist/js/accordions.module.min.js';
//import '@gouvfr/dsfr/dist/js/accordions.nomodule.min.js';
import '../../../../css/pam/table-controle.css'
import '../../../../css/pam/table-indicateur.css'
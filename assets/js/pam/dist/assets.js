// Require all css stylesheet from @gouvfr/dsfr
function requireAllCss(r) { r.keys().forEach(r); }
//requireAllCss(require.context('../../../../../node_modules/@gouvfr/dsfr/dist/css/', true, /\.css$/));

// Require all js files from @gouvfr/dsfr
import jquery from 'jquery';
import  '@gouvfr/dsfr/dist/core/core.css';
import '@gouvfr/dsfr/dist/component/header/header.min.css';
import '@gouvfr/dsfr/dist/component/button/button.min.css';
import '@gouvfr/dsfr/dist/component/accordion/accordion.min.css';
import '@gouvfr/dsfr/dist/component/card/card.min.css';
import '@gouvfr/dsfr/dist/component/input/input.min.css';
import '@gouvfr/dsfr/dist/component/toggle/toggle.min.css';
import '@gouvfr/dsfr/dist/component/checkbox/checkbox.min.css';
//import '@gouvfr/dsfr/dist/component/utilities.min.css';
import '@gouvfr/dsfr/dist/component/content/content.min.css';
import '@gouvfr/dsfr/dist/component/skiplink/skiplink.min.css';
import '@gouvfr/dsfr/dist/component/tile/tile.min.css';
import '@gouvfr/dsfr/dist/component/form/form.min.css';
import '@gouvfr/dsfr/dist/component/sidemenu/sidemenu.min.css';
import '@gouvfr/dsfr/dist/component/select/select.min.css';
import '@gouvfr/dsfr/dist/component/alert/alert.min.css';
import '@gouvfr/dsfr/dist/scheme/scheme.min.css';
import '@gouvfr/dsfr/dist/component/navigation/navigation.min.css';
import '@gouvfr/dsfr/dist/component/summary/summary.min.css';
import '@gouvfr/dsfr/dist/component/modal/modal.min.css';
import '@gouvfr/dsfr/dist/component/logo/logo.min.css';
import '../../../css/pam/base.css';
import 'remixicon/fonts/remixicon.css';
import '@gouvfr/dsfr/dist/dsfr/dsfr.module';
import '../../../css/override/dsfr_grid-tablet.css'
//import '@gouvfr/dsfr/dist/js/dsfr.nomodule.min.js';
import '@gouvfr/dsfr/dist/component/accordion/accordion.module.js';
import '@gouvfr/dsfr/dist/component/modal/modal.module';
//import '@gouvfr/dsfr/dist/js/accordions.nomodule.min.js';
import '../../../css/pam/table-controle.css'
import '../../../css/pam/table-indicateur.css'
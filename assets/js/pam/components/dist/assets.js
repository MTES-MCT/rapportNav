// Require all css stylesheet from @gouvfr/dsfr
function requireAllCss(r) { r.keys().forEach(r); }
requireAllCss(require.context('../../../../../node_modules/@gouvfr/dsfr/dist/css/', true, /\.css$/));

// Require all js files from @gouvfr/dsfr


import '../../../../css/pam/base.css';
import 'remixicon/fonts/remixicon.css';
import '@gouvfr/dsfr/dist/js/dsfr.module.min.js';
//import '@gouvfr/dsfr/dist/js/dsfr.nomodule.min.js';
import '@gouvfr/dsfr/dist/js/accordions.module.min.js';
//import '@gouvfr/dsfr/dist/js/accordions.nomodule.min.js';
// Require all css stylesheet from @gouvfr/dsfr
function requireAllCss(r) { r.keys().forEach(r); }
requireAllCss(require.context('../../../../../node_modules/@gouvfr/dsfr/dist/css/', true, /\.css$/));

// Require all js files from @gouvfr/dsfr
/*function requireAllJs(r) { r.keys().forEach(r); }
requireAllJs(require.context('../../../../../node_modules/@gouvfr/dsfr/dist/js/', true, /\.js$/));*/


import '../../../../css/pam/base.css';
import 'remixicon/fonts/remixicon.css'
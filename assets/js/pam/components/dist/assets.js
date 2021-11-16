// Require all css stylesheet from @gouvfr/dsfr
function requireAll(r) { r.keys().forEach(r); }
requireAll(require.context('../../../../../node_modules/@gouvfr/dsfr/dist/css/', true, /\.css$/));

import '../../../../css/pam/base.css';
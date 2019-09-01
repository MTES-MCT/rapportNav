const Encore = require('@symfony/webpack-encore');

//This is mostly for PHPStorm / any IDE to be able to understand this file
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}


Encore
// directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     */
    //Common for most pages
    .addEntry('app', './assets/js/app.js')

    //Common for all rapport forms
    .addEntry('rapport', [
                                    './assets/js/moyenManage.js',
                                    './assets/js/rapportBord.js',
                                    './assets/js/rapportPechePied.js',
                                    './assets/js/rapportCommercialisation.js',
                                    './assets/js/manageDraft.js',
                                    './assets/js/mission.js'
                ])

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // only one instance of modules even for multiple require in js files (ex. : required in aps.js and page.js)
    .enableSingleRuntimeChunk()

    .enableVueLoader()

    .autoProvidejQuery()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

// uncomment if you use TypeScript
//.enableTypeScriptLoader()

// uncomment if you're having problems with a jQuery plugin
//.autoProvidejQuery()

// uncomment if you use API Platform Admin (composer req api-admin)
//.enableReactPreset()
//.addEntry('admin', './assets/js/admin.js')
;

module.exports = Encore.getWebpackConfig();

const Encore = require('@symfony/webpack-encore');
const WorkboxPlugin = require('workbox-webpack-plugin');
const FaviconsWebpackPlugin = require('favicons-webpack-plugin');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/js/app.js')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableLessLoader()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })
    .configureBabel(function (babelConfig) {
        babelConfig.plugins.push("@babel/plugin-proposal-class-properties");
    })
    .addLoader({
        test: /\.html$/i,
        loader: 'html-loader',
        options: {
            esModule: false
        }
    })
    .disableFontsLoader()
    .addLoader({
        test: /\.(svg|ttf|eot|png|woff(2)?)(\?[a-z0-9]+)?$/,
        use: [{
            loader: 'file-loader',
            options: {
                esModule: false
            }
        }]
    })
    .addPlugin(
        new FaviconsWebpackPlugin({
            logo: './assets/img/logo.svg',
            mode: 'webapp', // optional can be 'webapp' or 'light' - 'webapp' by default
            devMode: 'webapp', // optional can be 'webapp' or 'light' - 'light' by default
            cache: false,
            favicons: {
                appName: 'Cloud Explorer',
                appDescription: 'Access your iCloud data.',
                developerName: 'Bitter Digital Solutions Ltd.',
                developerURL: "https://www.bitter.de",
                background: '#fff',
                theme_color: '#333'
            }
        })
    )
    .addPlugin(
        new WorkboxPlugin.GenerateSW({
            clientsClaim: true,
            skipWaiting: true
        })
    )
;

Encore.configureLoaderRule('images', loaderRule => {
    loaderRule.test = /\.(png|jpg|jpeg|gif|ico|webp)$/;
});

module.exports = Encore.getWebpackConfig();
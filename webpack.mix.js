const mix = require('laravel-mix');
const glob = require('glob');
const path = require('path');
const ReplaceInFileWebpackPlugin = require('replace-in-file-webpack-plugin');
const rimraf = require('rimraf');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.options({
    cssNano: {
        discardComments: false,
    }
});

mix.js('resources/js/app.js', 'public/assets/js').vue({
    version: 3,
    options: {
        compilerOptions: {
            isCustomElement: (tag) => ['v-'].includes(tag),
        },
    },
});

// mix.css('resources/css/custom.css', 'public/assets/css/style.bundle.css');
// mix.minify(['public/assets/js/app.js', 'public/assets/css/style.bundle.css']);


// Build 3rd party plugins css/js
mix.sass('resources/mix/plugins.scss', `public/assets/plugins/global/plugins.bundle.css`).then(() => {
    // remove unused preprocessed fonts folder
    rimraf(path.resolve('public/fonts'), () => {
    });
}).sourceMaps(!mix.inProduction())
    // .setResourceRoot('./')
    .options({processCssUrls: false})
    .scripts(require('./resources/mix/plugins.js'), `public/assets/plugins/global/plugins.bundle.js`);

// Build theme css/js
mix.sass(`resources/sass/style.scss`, `public/assets/css/style.bundle.css`, {sassOptions: {includePaths: ['node_modules']}})
    // .options({processCssUrls: false})
    .scripts(require(`./resources/mix/scripts.js`), `public/assets/js/scripts.bundle.js`);

// Build custom 3rd party plugins
(glob.sync(`resources/mix/vendors/**/*.js`) || []).forEach(file => {
    mix.scripts(require('./' + file), `public/assets/${file.replace(path.normalize('resources/mix/vendors/'), 'plugins/custom/')}`);
});
(glob.sync(`resources/mix/vendors/**/*.scss`) || []).forEach(file => {
    mix.sass(file, `public/assets/${file.replace(path.normalize('resources/mix/vendors/'), 'plugins/custom/').replace('scss', 'css')}`);
});

// JS pages (single page use)
// (glob.sync(`${dir}/js/custom/**/*.js`) || []).forEach(file => {
//     var output = `public/assets/${file.replace(path.normalize(dir), '')}`;
//     mix.scripts(file, output);
// });

let plugins = [
    new ReplaceInFileWebpackPlugin([
        {
            // rewrite font paths
            dir: path.resolve(`public/assets/plugins/global`),
            test: /\.css$/,
            rules: [
                {
                    // fontawesome
                    search: /url\((\.\.\/)?webfonts\/(fa-.*?)"?\)/g,
                    replace: 'url(./fonts/@fortawesome/$2)',
                },
                {
                    // lineawesome fonts
                    search: /url\(("?\.\.\/)?fonts\/(la-.*?)"?\)/g,
                    replace: 'url(./fonts/line-awesome/$2)',
                },
                {
                    // bootstrap-icons
                    search: /url\(.*?(bootstrap-icons\..*?)"?\)/g,
                    replace: 'url(./fonts/bootstrap-icons/$1)',
                },
                {
                    // fonticon
                    search: /url\(.*?(fonticon\..*?)"?\)/g,
                    replace: 'url(./fonts/fonticon/$1)',
                },
                {
                    // keenicons
                    search: /url\(.*?((keenicons-.*?)\..*?)'?\)/g,
                    replace: 'url(./fonts/$2/$1)',
                },
            ],
        },
    ]),
];

mix.webpackConfig({
    plugins: plugins,
    ignoreWarnings: [{
        module: /esri-leaflet/,
        message: /version/,
    }],
});

// Webpack.mix does not copy fonts, manually copy
(glob.sync(`resources/vendors/keenicons/**/*.+(woff|woff2|eot|ttf|svg)`) || []).forEach(file => {
    mix.copy(file, `public/assets/plugins/global/fonts/${path.parse(file).name}/${path.basename(file)}`);
});
glob.sync('node_modules/+(@fortawesome|socicon|line-awesome|bootstrap-icons)/**/*.+(woff|woff2|eot|ttf)').forEach(file => {
    const [, folder] = file.match(/node_modules[\\|/](.*?)[\\|/]/);
    mix.copy(file, `public/assets/plugins/global/fonts/${folder}/${path.basename(file)}`);
});

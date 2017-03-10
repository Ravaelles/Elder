const {mix} = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

//mix.js('resources/assets/js/app.js', 'public/js')
//   .sass('resources/assets/sass/app.scss', 'public/css');

// === CSS =============================================================

// Merge AdminLTE into one css file
//    mix.styles([
//     'admin-lte/bootstrap.css',
//     'admin-lte/admin-lte.css',
//     'admin-lte/skin-blue.css',
//     'admin-lte/square-blue.css'
//        'admin-lte/**'
//    ], 'public/css/admin-lte.css');

/** // Fonts
 mix.styles([
 '**'
 ], 'public/css/fonts.css'); */

mix.sass([
    'custom/**'
], 'public/css/all.css');

// === JS ==============================================================

// Base scripts
/**mix.scripts([
 'public/plugins/jQuery/jQuery-2.1.4.min.js', // jQuery 2.1.4
 'public/plugins/jQuery-wheel/jquery.mousewheel.min.js', // jQuery wheel
 'public/js/bootstrap.min.js', // Bootstrap 3.3.2 J
 'public/js/app.min.js', // AdminLTE App
 ], 'public/js/compressed/base.min.js', 'public');*/

// Game specific scripts
mix.js([
    'project.js',
    'engine/**',
    'worldmap/**',
], 'public/js/compressed/game.min.js');
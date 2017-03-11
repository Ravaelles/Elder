const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

elixir.config.sourcemaps = false;

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

//elixir((mix) => {
//    mix.sass('app.scss')
//       .webpack('app.js');
//});

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

elixir((mix) => {

    // UI
    mix.sass([
        'custom/**'
    ], 'public/css/project.min.css');

    // PLUGINS
    mix.styles([
        '../plugins/*/*.css'
    ], 'public/css/plugins.min.css');

});

// === JS ==============================================================

// Base scripts
/**mix.scripts([
 'public/plugins/jQuery/jQuery-2.1.4.min.js', // jQuery 2.1.4
 'public/plugins/jQuery-wheel/jquery.mousewheel.min.js', // jQuery wheel
 'public/js/bootstrap.min.js', // Bootstrap 3.3.2 J
 'public/js/app.min.js', // AdminLTE App
 ], 'public/js/compressed/base.min.js', 'public');*/

elixir((mix) => {

    // Plugins
    mix.scripts([
        '../plugins/*/*.js'
    ], 'public/js/compressed/plugins.min.js');

    // UI
    mix.scripts([
        'project.js'
    ], 'public/js/compressed/app.min.js');

    // Engine
    mix.scripts([
        'engine/**'
    ], 'public/js/compressed/engine.min.js');

    // Worldmap
    mix.scripts([
        'worldmap/**'
    ], 'public/js/compressed/worldmap.min.js');

});
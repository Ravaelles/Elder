var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {

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
    ], 'public/css/compressed/ui.css');

});

// Map Engine CSS
elixir(function (mix) {

    mix.sass([
        'map/**'
    ], 'public/css/compressed/map.css');

});

// ALL.CSS
elixir(function (mix) {

    mix.sass([
        '../../../public/css/compressed/ui.css',
        '../../../public/css/compressed/map.css'
    ], 'public/css/all.css');

});

// Scripts

elixir(function (mix) {

    // Base scripts
    /**mix.scripts([
     'public/plugins/jQuery/jQuery-2.1.4.min.js', // jQuery 2.1.4
     'public/plugins/jQuery-wheel/jquery.mousewheel.min.js', // jQuery wheel
     'public/js/bootstrap.min.js', // Bootstrap 3.3.2 J
     'public/js/app.min.js', // AdminLTE App
     ], 'public/js/compressed/base.min.js', 'public');*/

    // Game specific scripts
    mix.scripts([
        'project.js',
        'map/**',
    ], 'public/js/compressed/game.min.js');

});

/**elixir(function (mix) {

 // Game specific scripts
 mix.scripts([
 'map/**',
 ], 'public/js/compressed/map.min.js');

 });*/
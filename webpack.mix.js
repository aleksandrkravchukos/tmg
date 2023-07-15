const mix = require('laravel-mix');

mix.sass('resources/scss/app.sass', 'public/css')
    .js('resources/js/app.js', 'public/js')
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery']
    });

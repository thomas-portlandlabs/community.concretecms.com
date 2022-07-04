// Javascript dependencies are compiled with Laravel Mix https://laravel.com/docs/5.5/mix
let mix = require('laravel-mix');

mix.webpackConfig({
    resolve: {
        symlinks: false
    },
    externals: {
        jquery: 'jQuery',
        bootstrap: true,
        vue: 'Vue',
        moment: 'moment'
    }
});

mix.setResourceRoot('../');
mix.setPublicPath('../');

mix.js('assets/js/frontend.js', 'js/skyline/frontend.js')
mix.sass('assets/scss/frontend.scss', 'css/skyline/frontend.css')


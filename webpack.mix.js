const mix = require('laravel-mix');

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

mix.sass('resources/css/dashboard/sass/app.scss', 'public/css/dashboard')
    // DASHBOARD
        .js('resources/js/dashboard/admin.js', 'public/js/dashboard/admin')
            // BLOG
                .js('resources/js/dashboard/blog/blog.js', 'public/js/dashboard/blog')
                .js('resources/js/dashboard/blog/create.js', 'public/js/dashboard/blog')
                .js('resources/js/dashboard/blog/update.js', 'public/js/dashboard/blog')
            // FITUR - FITUR
                .js('resources/js/dashboard/fitur/fitur.js', 'public/js/dashboard/fitur')

    // DASHBOARD

    .js('resources/js/dashboard/app.js', 'public/js/dashboard').extract();

mix.version();

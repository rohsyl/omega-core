const mix = require('laravel-mix');
const WebpackShellPlugin = require('webpack-shell-plugin');

/**
 * For dev purpose.
 */
var postBuildPublish = true;
var postBuildDirectory = '../gsr-website';

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

mix.webpackConfig(webpack => {
    return {
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
                'window.jQuery': 'jquery',
                Popper: ['popper.js', 'default'],
                Swal: 'swal'
            }),
            new WebpackShellPlugin({
                onBuildExit: postBuildPublish ? [
                    'cd ' + postBuildDirectory + ' && php artisan vendor:publish --provider="rohsyl\\OmegaCore\\ServiceProvider" --tag="public" --force'
                ] : []
            })
        ],
        resolve: {
            alias: {
                'jquery': path.join(__dirname, 'node_modules/jquery/dist/jquery'),
                'swal': path.join(__dirname, 'node_modules/sweetalert2/dist/sweetalert2')
            }
        }
    };
});


mix
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/grapes/grapes.js', 'public/js')
    .sass('resources/sass/grapes/grapes.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts')
    .copy('resources/js/summernote/font', 'public/css/font')
    .copy('resources/sass/static/images','public/images')
    .options({
        processCssUrls: false
    })
    ;

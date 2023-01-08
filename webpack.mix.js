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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix.styles([
    'public/app-assets/backend/vendors/css/forms/toggle/bootstrap-switch.min.css',
    'public/app-assets/backend/vendors/css/forms/toggle/switchery.min.css',
    'public/app-assets/backend/vendors/css/forms/selects/select2.min.css',
    'public/app-assets/backend/vendors/css/tables/datatable/datatables.min.css',
    'public/app-assets/backend/vendors/css/tables/extensions/buttons.dataTables.min.css',
    'public/app-assets/backend/css/plugins/forms/switch.min.css',
    'public/app-assets/backend/css/core/colors/palette-switch.min.css',
    'public/app-assets/backend/css/plugins/loaders/loaders.min.css',
    'public/app-assets/backend/css/plugins/animate/animate.min.css',
    'public/app-assets/backend/customs/css/style.css',
], 'public/app-assets/backend/build/css/main.css');

mix.styles([
    'public/app-assets/backend/css-rtl/app.min.css',
    'public/app-assets/backend/css-rtl/core/menu/menu-types/vertical-menu.min.css',
    'public/app-assets/backend/css-rtl/core/colors/palette-gradient.min.css',
    'public/app-assets/backend/css-rtl/core/colors/palette-loader.min.css',
    'public/app-assets/backend/css-rtl/custom-rtl.css',
    'public/app-assets/backend/customs/css/style_ar.css',
], 'public/app-assets/backend/build/css/main-rtl.css');

mix.styles([
    'public/app-assets/backend/css/app.min.css',
    'public/app-assets/backend/css/core/menu/menu-types/vertical-menu.min.css',
    'public/app-assets/backend/css/core/colors/palette-gradient.min.css',
    'public/app-assets/backend/css/core/colors/palette-loader.min.css',
], 'public/app-assets/backend/build/css/main-ltr.css');

mix.styles([
    'public/app-assets/backend/customs/css/loading.css',
    'public/app-assets/backend/customs/css/preview-file.css',
    'public/app-assets/backend/customs/css/email.css',
], 'public/app-assets/backend/build/css/custom.css');

mix.scripts([
    'public/app-assets/backend/vendors/js/vendors.min.js',
    'public/app-assets/backend/vendors/js/forms/select/select2.full.min.js',
    'public/app-assets/backend/vendors/js/forms/extended/maxlength/bootstrap-maxlength.js',
    'public/app-assets/backend/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js',
    'public/app-assets/backend/vendors/js/forms/toggle/bootstrap-switch.min.js',
    'public/app-assets/backend/vendors/js/forms/toggle/bootstrap-checkbox.min.js',
    'public/app-assets/backend/vendors/js/forms/toggle/switchery.min.js',
    'public/app-assets/backend/vendors/js/ui/headroom.min.js',
    'public/app-assets/backend/vendors/js/tables/datatable/datatables.min.js',
    'public/app-assets/backend/js/scripts/forms/select/form-select2.js',
    'public/app-assets/backend/js/scripts/forms/input-groups.js',
    'public/app-assets/backend/js/scripts/fontawesome-all.min.js',
    'public/app-assets/backend/js/core/app-menu.min.js',
    'public/app-assets/backend/js/core/app.min.js',
    'public/app-assets/backend/js/scripts/customizer.min.js',
    'public/app-assets/backend/js/scripts/forms/switch.min.js',
    'public/app-assets/backend/js/scripts/popover/popover.min.js',
    'public/app-assets/backend/customs/js/public-functions.js',
    'public/app-assets/backend/customs/js/preview-file.js',
    'public/app-assets/backend/customs/js/email-notification.js',
    'public/app-assets/backend/customs/js/script.js',
    'public/app-assets/backend/customs/js/check-offline.js',
    'public/app-assets/backend/customs/js/lock-page.js',
    'public/app-assets/backend/customs/js/search.js',
], 'public/app-assets/backend/build/js/main.js');

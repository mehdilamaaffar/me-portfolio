let mix = require('laravel-mix');

mix
  .js('resources/assets/js/app.js', 'public/js')
  .sass('resources/assets/sass/app.scss', 'public/css')
  .scripts([
    'resources/assets/vendors/js/lightbox-plus-jquery.min.js',
    'resources/assets/vendors/js/dropzone.min.js',
  ], 'public/js/vendor.js')
  .styles([
    'resources/assets/vendors/css/lightbox.min.css',
    'resources/assets/vendors/css/dropzone.min.css',
  ], 'public/css/vendor.css')
  .browserSync({
    proxy: 'localhost:8000',
    open: false,
  })

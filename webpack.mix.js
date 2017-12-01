let mix = require('laravel-mix');

mix
  .js('resources/assets/js/app.js', 'public/js')
  .sass('resources/assets/sass/app.scss', 'public/css')
  .scripts([
    'resources/assets/vendor/js/lightbox-plus-jquery.min.js',
    'resources/assets/vendor/js/dropzone.min.js',
  ], 'public/js/vendor.js')
  .styles([
    'resources/assets/vendor/css/lightbox.min.css',
    'resources/assets/vendor/css/dropzone.min.css',
  ], 'public/css/vendor.css')
  .browserSync('localhost:8000')

const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       require('tailwindcss'),
   ])
   .js('node_modules/@fullcalendar/core/main.js', 'public/js')
   .js('node_modules/@fullcalendar/daygrid/main.js', 'public/js')
   .js('node_modules/@fullcalendar/interaction/main.js', 'public/js');
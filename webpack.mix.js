let mix = require('laravel-mix');

mix.postCss('resources/css/locations.css', 'public/css', [require("tailwindcss")])

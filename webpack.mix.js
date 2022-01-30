let mix = require('laravel-mix')

mix.js('resources/js/filter.js', 'dist/js')
    .webpackConfig({
        resolve: {
            symlinks: false
        }
    })

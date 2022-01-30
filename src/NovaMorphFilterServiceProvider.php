<?php

namespace Mostafaznv\NovaMorphFilter;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class NovaMorphFilterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Nova::serving(function(ServingNova $event) {
            Nova::script('nova-morph-filter', __DIR__ . '/../dist/js/filter.js');
        });
    }
}

<?php

use App\Providers\RedirectUrlServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\redirectUrlServiceProvider::class,
    Barryvdh\Debugbar\ServiceProvider::class,
];

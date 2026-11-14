<?php

use App\Providers\AppServiceProvider;
use App\Providers\AuthServiceProvider;
use App\Providers\EventServiceProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\HorizonServiceProvider;
use App\Providers\RouteServiceProvider;
use App\Providers\SocialstreamServiceProvider;
use App\Providers\TeamServiceProvider;

return [
    \App\Providers\ApiHostServiceProvider::class,
    AppServiceProvider::class,
    AuthServiceProvider::class,
    EventServiceProvider::class,
    FortifyServiceProvider::class,
    HorizonServiceProvider::class,
    RouteServiceProvider::class,
    SocialstreamServiceProvider::class,
    TeamServiceProvider::class,
];

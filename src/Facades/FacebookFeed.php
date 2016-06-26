<?php

namespace Denismitr\FacebookFeed\Facades;

use Illuminate\Support\Facades\Facade;

class FacebookFeed extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'facebookfeed';
    }
}
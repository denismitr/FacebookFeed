<?php

namespace Denismitr\FacebookFeed;

use Facebook\Facebook;
use Illuminate\Support\ServiceProvider;
use Denismitr\FacebookFeed\FacebookFeed;

class FacebookFeedServiceProvider extends ServiceProvider
{
    public function register()
    {
        $config = __DIR__ . '/../config/facebookfeed.php';
        $this->mergeConfigFrom($config, 'facebookfeed');

        $this->app->bind('facebookfeed', function() {

            $fb = new Facebook([
                'app_id' => config('facebookfeed.app_id'),
                'app_secret' => config('facebookfeed.app_secret'),
                'default_graph_version' => config('facebookfeed.default_graph_version')
            ]);

            return new FacebookFeed($fb);
        });
    }
}
#FacebookFeed API for Laravel
by Denis Mitrofanov 2016

##Install
    composer require denismitr/facebookfeed

Add `Denismitr\FacebookFeed\FacebookFeedServiceProvider.php` to Laravel's `config/app.php` __providers__ array.
And also you can use `FacebookFeed` facade also by adding `Denismitr\FacebookFeed\Facades\FacebookFeed.php`
to `config/app.php` the __facades__ array

##Usage

At this moment there are two main methods in the FacebookFeed API:

*[image](#Upload an image)
*[link](#Send a link to a webpage)

###Upload an image

    FacebookFeed::image('Some message', '/path/to/image.jpg')->send();

###Send a link to a webpage

    Facebook::link('Some message', 'http://a_link.to/a_page')->send();

###Exceptions

There are three __exception classes__:

    //Invalid facebook api variables
    Denismitr\FacebookFeed\Exceptions\InvalidEnvSetting.php

    //File is not readable
    Denismitr\FacebookFeed\Exceptions\InvalidFilePath.php

    //Error while sending to facebook
    Denismitr\FacebookFeed\Exceptions\SendToFacebook.php

###Environment variables

The environment variables must be set like so:

*FACEBOOK_ID=your facebook id
*FACEBOOK_SECRET=your facebook secret key
*FACEBOOK_API=v2.6
*FACEBOOK_TOKEN=your facebook token

##Important

The long-term __Facebook__ access token you can get through the [Graph API Explorer](https://developers.facebook.com/tools-and-support/) and it is required to get it from the name of the Facebook APP you are using, but connected to the user account.

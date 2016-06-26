<?php

namespace Denismitr\FacebookFeed;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Exceptions\FacebookResponseException;
use Denismitr\FacebookFeed\Exceptions\SendToFacebook;
use Denismitr\FacebookFeed\Exceptions\InvalidFilePath;
use Denismitr\FacebookFeed\Exceptions\InvalidEnvSetting;

class FacebookFeed
{
    //Stores the FacebookAPI instance
    protected $fb;

    //Data to be send
    protected $data = [];

    //Send to url
    protected $sentTo;

    //GraphNode
    public $graphNode;


    public function __construct(Facebook $fb)
    {
        $this->fb = $fb;
    }

    /**
     * Upload an image
     *
     * @param  [string] $message
     * @param  [string] $imagePath
     * @return [FacebookFeed]
     */
    public function image($message, $imagePath)
    {
        if ( ! is_readable($imagePath)) {
            throw new InvalidFilePath("'{$imagePath}' is not a readable path!");
        }

        $this->data = [
            'message' => $message,
            'source' => $this->fb->fileToUpload($imagePath)
        ];

        $this->sendTo = config('facebookfeed.upload_photo', '/me/photos');

        return $this;
    }



    public function link($message, $link)
    {
        $this->data = [
            'message' => $message,
            'link' => $link
        ];

        $this->sendTo = config('facebookfeed.upload_link', '');

        return $this;
    }


    /**
     * Send data to facebook
     *
     * @return [void]
     */
    public function send()
    {
        $facebook_token = config('facebookfeed.facebook_token');

        if ( empty($facebook_token) ) {
            throw new InvalidEnvSetting("Facebook token has not been provided properly");
        }

        try {
          // Returns a `Facebook\FacebookResponse` object
          $response = $this->fb->post($this->sendTo, $this->data, $facebook_token);
        } catch(FacebookResponseException $e) {
            throw new SendToFacebook('Graph returned an error: ' . $e->getMessage());
        } catch(FacebookSDKException $e) {
            throw new SendToFacebook('Facebook SDK returned an error: ' . $e->getMessage());
        }

        $this->graphNode = $response->getGraphNode();
    }
}
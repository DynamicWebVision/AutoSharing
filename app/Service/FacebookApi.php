<?php namespace App\Service;

use Request;
use Session;
use Facebook;

class FacebookApi {

    protected $fb;

    public $shareLinkData;

    public function __construct() {

        $this->fb = new Facebook\Facebook([
            'app_id' => '1180934571930789',
            'app_secret' => 'fff1caf5641cf21f71c54f9d80bb5105',
            'default_graph_version' => 'v2.5'
        ]);

    }

    public function loginUrl() {
        $helper = $this->fb->getRedirectLoginHelper();
        $permissions = ['manage_pages', 'publish_pages']; // optional
        $loginUrl = $helper->getLoginUrl('http://shouldbearule.com/login-callback.php', $permissions);

        echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
    }

    public function shareNeedaruleWall() {

        $accessToken = 'EAAQyDcGptKUBANvRvRZA3EN1puvecZB6WBb3kiAgZCjXDm1xNl9SBEtPNPWlXjVQikCVWXVZC8TdlTD7PoHhiDZCdSLdNQsbgH8qwZBrLm9ZAlxrQwx2BBmlyPlZAgAZB2dDUi5N2A2KzCQVfZBndhg77J6y7b2nwsNrkZD';

        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $this->fb->post('982003408582363/feed', $this->shareLinkData, $accessToken);

        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

    }
}
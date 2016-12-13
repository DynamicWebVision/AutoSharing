<?php namespace App\Http\Controllers;

use Request;
use Session;
use Facebook;

class FacebookController extends Controller {

    protected $fb;

    public function __construct() {
        session_start();
        $this->fb = new \App\Service\FacebookApi();
    }

    public function loginUrl() {
        $helper = $this->fb->getRedirectLoginHelper();
        $permissions = ['manage_pages', 'publish_pages']; // optional
        $loginUrl = $helper->getLoginUrl('http://shouldbearule.com/login-callback.php', $permissions);

        echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
    }

    public function autoWallShare() {

//        $cronJob = new \App\Http\Controllers\CronController();
//        $cronJob->cronId = 8;
//        $cronJob->start();
//
//        $autoTweet = \App\Model\Nar\AutomatedTweets::orderBy('last_facebook_post')->take(1)->get();
//
//        $autoTweet = $autoTweet[0];
//
//        $rule = \App\Model\Nar\Rule::find($autoTweet->R_KEY);
//
//        $this->fb->shareLinkData = [
//            'link' => 'http://shouldbearule.com/rule/'.$rule->URL
//        ];
//
//        $this->fb->shareNeedaruleWall();
//
//        $saveAutoTweet = \App\Model\Nar\AutomatedTweets::find($autoTweet->id);
//
//        $saveAutoTweet->last_facebook_post = time();
//
//        $saveAutoTweet->save();
//
//        $cronJob->end(1);
    }

    public function getLongToken() {

        $url = 'https://graph.facebook.com/v2.2/oauth/access_token?grant_type=fb_exchange_token&client_id=1180934571930789&client_secret=fff1caf5641cf21f71c54f9d80bb5105&fb_exchange_token=EAAQyDcGptKUBAGHgE30LaPZCfZCnfk9P7DtB0MTe0AgcpokuZCRCDfsWoZBz5EGlgzB2ktiACuXFC6dejiaieAQXRJ5taOjzHv6s2jhPKl9ZAC4MnTfkZBrb62wgRgoMHAbRhvuTUxezZAua1mR0ErgZBm3uRMSOq6dLCWZBhF3SLPwZDZD';

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curl, CURLOPT_URL, $url);
        $resp = curl_exec($curl);

        return $resp;
    }

    public function getMyInfo() {
        $url = 'https://graph.facebook.com/v2.2/me?access_token=EAAQyDcGptKUBAAftgNXJXMQX4zmTLwZCVp3ATTgchhEr0sxft4FCQgjSKapbctmGnT4jZB2ttSHqPU2iNZBeQTInhVTZAU8AOqXOIwvwAwEp15ZAbcTBdvCh8nQ0WJZC4GRZBbCp53JZAGNHtZBvFawje';

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curl, CURLOPT_URL, $url);
        $resp = curl_exec($curl);

        return $resp;
    }

    public function permanentToken() {
        $url = 'https://graph.facebook.com/v2.2/10108295725251974/accounts?access_token=EAAQyDcGptKUBAAftgNXJXMQX4zmTLwZCVp3ATTgchhEr0sxft4FCQgjSKapbctmGnT4jZB2ttSHqPU2iNZBeQTInhVTZAU8AOqXOIwvwAwEp15ZAbcTBdvCh8nQ0WJZC4GRZBbCp53JZAGNHtZBvFawje';

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curl, CURLOPT_URL, $url);
        $resp = curl_exec($curl);

        return $resp;
    }
}
<?php namespace App\Service;

use App\Library\Twitter\TwitterOAuth;
use App\Config;

class Twitter  {

    public $exchange;
    public $timePeriod;

    public $apiAccess;

    public function setApi() {
        $config = new Config();

        $this->apiAccess = new \App\Library\Twitter\TwitterOAuth($config->twitterCredientials['consumerKey'],
            $config->twitterCredientials['consumerSecret'],
            $config->twitterCredientials['accessToken'],
            $config->twitterCredientials['accessTokenSecret']);
    }

    public function getOauthRequestToken() {
        //$this->setApi();

        $favoriteCriteria = array(
            "oauth_callback"=> urlencode('http://autoshare.local/twitter_success')
        );
        return $this->apiAccess->post('oauth/request_token', $favoriteCriteria);
    }

    public function search($searchPhrase, $sinceId) {
        $searchCriteria = array(
            "q"=>$searchPhrase,
            "count"=>"100",
            "lang"=>"en",
            "since_id"=>$sinceId
        );

        $searchResponse = $this->apiAccess->get('search/tweets', $searchCriteria);

        return $searchResponse;
    }

    public function favorite($tweetId) {
        $favoriteCriteria = array(
            "id"=> $tweetId
        );
        return $this->apiAccess->post('favorites/create', $favoriteCriteria);
    }

    public function tweet($tweetText, $media) {
        $tweetCriteria = array(
            "status"=> $tweetText
        );

        if ($media) {
            $tweetCriteria['media_ids'] = $media;
        }

        return $this->apiAccess->post('statuses/update', $tweetCriteria);
    }

    public function postMedia($base64) {
        $requestCriteria = array(
            "media_data"=>$base64
        );

        $response = $this->apiAccess->post('https://upload.twitter.com/1.1/media/upload.json', $requestCriteria);

        return $response;
    }

    public function makeMediaLength($tweetText) {
        $utility = new \App\Service\Utility();

        while (strlen($tweetText) > 113) {
            $revText = strrev($tweetText);

            if (strpos($revText, "#")) {
                $hashPosition = strpos($revText, "#");
                $endWithHash = substr($revText, 0, $hashPosition+1);
                $restOfString = substr($revText, $hashPosition+1);

                $hashToRemove = substr($endWithHash, strpos($revText, " "));

                $tweetText = strrev(str_replace($hashToRemove, "", $endWithHash).$restOfString);
            }
            else {
                $excessLength = strlen($revText) - 110;

                $link = substr($revText, 0, strpos($revText, ':ptth')+6);

                $ruleLength = strlen(substr($revText, strpos($revText, ':ptth')+6));

                $ruleTextLength = 116 - $excessLength;

                $ruleLengthCutoff = $ruleLength - $ruleTextLength;

                $revRuleText = substr($revText, strpos($revText, ':ptth')+6 + $excessLength);

                $revText = $link."...".$revRuleText;

                $tweetText = strrev($revText);
            }
        }
        return $tweetText;
    }
}

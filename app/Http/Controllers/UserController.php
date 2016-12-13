<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Model\TwitterAuth;

class UserController extends Controller
{

    /**
     * @Get("/registration")
     */
    public function getAccounts() {

        $existingAccounts = [];

        //Check Twitter
        $twitterAuth = TwitterAuth::where('user_id', Auth::user()->id)->first();

        if (!$twitterAuth) {
            $existingAccounts['twitter'] = false;
            $existingAccounts['twitterInfo'] = false;
        }
        else {
            $twitterInfo = [];

            $twitterInfo['screenName'] = $twitterAuth->screen_name;

            $twitterInfo['name'] = $twitterAuth->name;
            $twitterInfo['twitterImg'] = $twitterAuth->twitter_img_url;

            $existingAccounts['twitter'] = true;
            $existingAccounts['twitterInfo'] = $twitterInfo;
        }
        //return json_encode($existingAccounts);
        return $existingAccounts;
    }
}

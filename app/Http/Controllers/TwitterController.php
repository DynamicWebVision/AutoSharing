<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\Twitter;
use App\Model\TwitterAuth;
use Session;
use Auth;

class TwitterController extends Controller
{
    public function userTwitterAccessLogin() {
        // your SIGN IN WITH TWITTER  button should point to this route
        $sign_in_twitter = true;
        $force_login = false;

        // Make sure we make this request w/o tokens, overwrite the default values in case of login.
        \Twitter::reconfig(['token' => '', 'secret' => '']);
        $token = \Twitter::getRequestToken(\route('twitter.callback'));

        if (isset($token['oauth_token_secret']))
        {
            $url = \Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

            Session::put('oauth_state', 'start');
            Session::put('oauth_request_token', $token['oauth_token']);
            Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

            return \Redirect::to($url);
        }

        return \Redirect::route('twitter.error');
    }

    public function twitterLoginRedirect(Request $request) {

        // You should set this route on your Twitter Application settings as the callback
        // https://apps.twitter.com/app/YOUR-APP-ID/settings
        if (Session::has('oauth_request_token'))
        {
            $request_token = [
                'token'  => Session::get('oauth_request_token'),
                'secret' => Session::get('oauth_request_token_secret'),
            ];

            \Twitter::reconfig($request_token);

            $oauth_verifier = false;

            if (null !== $request->get('oauth_verifier'))
            {
                $oauth_verifier = $request->get('oauth_verifier');

                // getAccessToken() will reset the token for you
                $token = \Twitter::getAccessToken($oauth_verifier);
                $credentials = \Twitter::getCredentials();

                $twitterAuth = TwitterAuth::where('user_id', Auth::user()->id)->first();

                if (!$twitterAuth) {
                    $twitterAuth = new TwitterAuth();

                    $twitterAuth->user_id = Auth::user()->id;
                }

                $twitterAuth->oauth_verifier = $oauth_verifier;

                $twitterAuth->twitter_user_id = $token['user_id'];

                $twitterAuth->screen_name = $token['screen_name'];

                $twitterAuth->twitter_img_url = $credentials->profile_image_url_https;

                $twitterAuth->name = $credentials->name;

                $twitterAuth->save();
            }

            if (!isset($token['oauth_token_secret']))
            {
                return \Redirect::route('twitter.login')->with('flash_error', 'We could not log you in on Twitter.');
            }

            $userSettings = \Twitter::getSettings();

            if (is_object($credentials) && !isset($credentials->error))
            {
                // $credentials contains the Twitter user object with all the info about the user.
                // Add here your own user logic, store profiles, create new users on your tables...you name it!
                // Typically you'll want to store at least, user id, name and access tokens
                // if you want to be able to call the API on behalf of your users.

                // This is also the moment to log in your users if you're using Laravel's Auth class
                // Auth::login($user) should do the trick.

                Session::put('access_token', $token);

                return \Redirect::to('/manage_account')->with('flash_notice', 'Congrats! You\'ve successfully signed in!');
            }

            return
                \Redirect::route('twitter.error')->with('flash_error', 'Crab! Something went wrong while signing you up!');
        }

    }

    public function test() {
        \Twitter::reconfig(['consumer_key' => 'RXISZqfwnuVQe9L3SszyfA', 'consumer_secret' => '86JnEdA7x50G0S087B4UFInOm1afPkZkwSgmiyxwk',
            'token' => '3148579164-j1eoLgsPrUUnF5MMtGkL9wG6gf3QjTEC5k7gp9r', 'secret' => 'xMBaBEetC29lbT3aKK97g1oJet6bMH4yvs5ri5T2b2t9R']);

        $responce = \Twitter::postTweet(array('status' => 'Test post api yeah buddy', 'format' => 'json'));

        echo "asdfasdf";


    }
}

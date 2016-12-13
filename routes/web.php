<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/tasks', function () {
    $tasks = \App\Task::latest()->get();
    return $tasks;
});

//Route::get('/registration', function () {
//    return view('register');
//});
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/manage_account', 'HomeController@manageAccount');

Route::get('/api/social_accounts', 'UserController@getAccounts');

Route::get('/vue', function() {
    $tasks = \App\Task::latest()->get();

    return view('vue', compact('tasks'));
});

Route::get('/vue_laravel', function() {
    //$tasks = \App\Task::latest()->get();

    return view('welcome');
});

Route::get('/get_link_data', 'LinkController@getLinkOgData');

Route::get('/twitter_success', function() {
   echo "yah twitter success";
});


Route::get('twitter/login', ['as' => 'twitter.login', 'uses' => 'TwitterController@userTwitterAccessLogin']);

Route::get('twitter/callback', ['as' => 'twitter.callback', 'uses' => 'TwitterController@twitterLoginRedirect']);


Route::get('twitter/test', 'TwitterController@test');

Route::get('twitter/error', ['as' => 'twitter.error', function(){
    // Something went wrong, add your own error handling here
}]);

Route::get('twitter/logout', ['as' => 'twitter.logout', function(){
    Session::forget('access_token');
    return Redirect::to('/')->with('flash_notice', 'You\'ve successfully logged out!');
}]);

//Route::get('twitter/callback', 'TwitterController@twitterLoginRedirect');

Route::get('twitter/error', ['as' => 'twitter.error', function(){
    // Something went wrong, add your own error handling here
}]);

Route::get('twitter/logout', ['as' => 'twitter.logout', function(){
    Session::forget('access_token');
    return Redirect::to('/')->with('flash_notice', 'You\'ve successfully logged out!');
}]);

Auth::routes();

Route::get('/home', 'HomeController@index');

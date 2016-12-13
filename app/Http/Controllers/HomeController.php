<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Model\TwitterAuth;

class HomeController extends Controller
{
    protected $request;

//    public function __construct(Request ) {
//        $this->request = $request;
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $request->session()->put('user_id', Auth::user()->id);

        echo "sadfasdf";
        return view('home');
    }

    public function manageAccount(Request $request) {
        return view('account');
    }

    public function getAccounts(Request $request) {
        $twitterAuth = TwitterAuth::where('user_id', Auth::user()->id)->first();
        return json_encode($twitterAuth->toArray());

    }
}

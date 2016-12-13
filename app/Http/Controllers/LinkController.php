<?php

namespace App\Http\Controllers;

use App\Service\HtmlParser;
use App\Service\Scraper;

class LinkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getLinkOgData() {
        $newLink = 'http://shouldbearule.com/rule/Do-not-wear-pink-boots-with-a-pink-long-coat';

        $scraper = new Scraper();
        $html = $scraper->getCurl($newLink);

        $parser = new HtmlParser();

        $ogData = $parser->getOgData($html);
        echo "asdfsafd";
    }
}

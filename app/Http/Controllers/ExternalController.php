<?php

namespace App\Http\Controllers;

class ExternalController extends Controller
{
    /**
     * @Get("/registration")
     */
    public function registration() {
        return view('register');
    }
}

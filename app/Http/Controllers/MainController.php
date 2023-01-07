<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function getHome()
    {
        return view('home');
    }

    public function getAbout()
    {
        return view('about');
    }
}

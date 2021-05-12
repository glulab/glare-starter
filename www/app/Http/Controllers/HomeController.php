<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ignite\Support\Facades\Form;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sections = \App\Models\Section::whereActive(true)->whereType('home')->orderBy('position')->get();
        $sections = $sections->groupBy('location');

        return view('home.home')
            ->with('homeSeo', Form::load('home', 'home_seo'))
            ->with('homeContent', Form::load('home', 'home_content'))
            ->with('sections', $sections)
        ;
    }
}

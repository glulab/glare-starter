<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ignite\Support\Facades\Form;
use Illuminate\Support\Facades\Auth;

class PageContactController extends Controller
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

    public function show()
    {
        return view('page-contact.show')
            ->with('page', \App\Models\Page::whereActive(true)->whereRoute('contact')->firstOrNew())
        ;
    }
}

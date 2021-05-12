<?php

namespace App\Http\Controllers;

// use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
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
    public function show($slug)
    {
        $q = \App\Models\Page::query();

        $q->whereSlug($slug);

        if (!Auth::guard('lit')->check()) {
            $q->whereActive(true);
        }

        $page = $q->firstOrFail();

        return view('page.show')
            ->with('page', $page)
        ;
    }
}

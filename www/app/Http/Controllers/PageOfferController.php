<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ignite\Support\Facades\Form;
use Illuminate\Support\Facades\Auth;

class PageOfferController extends Controller
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
     * [index description]
     *
     * @return [type] [description]
     */
    public function index()
    {
        $page = \App\Models\Page::whereActive(true)->whereRoute('offer')->firstOrNew();

        return view('page-offer.index')
            ->with('page', $page)
        ;
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
        $q->whereType('offer');

        $page = $q->firstOrFail();

        session(['last_viewed_offer' => ['label' => $page->title, 'url' => request()->fullurl()/*$page->urlByType*/]]);

        return view('page-offer.show')
            ->with('page', $page)
        ;
    }
}

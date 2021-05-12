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
        try {
            $page = \App\Models\Page::whereActive(true)->whereRoute('offer')->firstOrFail();
        } catch (\Exception $e) {
            // explode suffix '.html'
            $slug = explode('.', request()->path());
            return app()->call('App\Http\Controllers\PageController@show', ['slug' => $slug[0]]);
        }

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

        $q->with('photo_links');

        $q->with('galleries');

        $q->whereSlug($slug);

        if (!Auth::guard('lit')->check()) {
            $q->whereActive(true);
        }

        $q->whereType('offer');

        $page = $q->firstOrFail();

        session(['last_viewed_page' => ['label' => $page->title, 'url' => request()->fullurl()]]);
        session(['last_viewed_offer' => ['label' => $page->title, 'url' => request()->fullurl()]]);

        return view('page-offer.show')
            ->with('page', $page)
        ;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ignite\Support\Facades\Form;
use Illuminate\Support\Facades\Auth;

class PageGalleryController extends Controller
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
            $q = \App\Models\Page::query();

            $q->with('photo_links');
            $q->with('galleries');

            $q->whereAction('gallery');

            if (!Auth::guard('lit')->check()) {
                $q->whereActive(true);
            }

            $page = $q->firstOrFail();

            session(['last_viewed_page' => ['label' => $page->title, 'url' => request()->fullurl()]]);

        } catch (\Exception $e) {
            // explode suffix '.html'
            $slug = explode('.', request()->path());
            return app()->call('App\Http\Controllers\PageController@show', ['slug' => $slug[0]]);
        }

        return view('page-gallery.index')
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

        $q->whereAction('gallery');
        // $q->whereSlug($slug);

        if (!Auth::guard('lit')->check()) {
            $q->whereActive(true);
        }

        $page = $q->firstOrNew();

        session(['last_viewed_page' => ['label' => $page->title, 'url' => request()->fullurl()]]);

        $gallery = \App\Models\Gallery::whereActive(true)->whereSlug($slug)->first();

        return view('page-gallery.show')
            ->with('page', $page)
            ->with('gallery', $gallery)
        ;
    }
}

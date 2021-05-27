<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ignite\Support\Facades\Form;
use Illuminate\Support\Facades\Auth;

class PageBlogController extends Controller
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
        $q = \App\Models\Page::query();

        $q->whereAction('blog');

        if (!Auth::guard('lit')->check()) {
            $q->whereActive(true);
        }

        $page = $q->firstOrNew();

        return view('page-blog.index')
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

        $q->whereType('blog');
        $q->whereSlug($slug);

        if (!Auth::guard('lit')->check()) {
            $q->whereActive(true);
        }

        $page = $q->firstOrFail();

        session(['last_viewed_blog' => ['label' => $page->title, 'url' => request()->fullurl()/*$page->urlByType*/]]);

        return view('page-blog.show')
            ->with('page', $page)
        ;
    }
}

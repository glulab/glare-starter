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

    public function index()
    {
        return view('page-gallery.index')
            ->with('page', \App\Models\Page::whereActive(true)->whereRoute('gallery')->firstOrNew())
        ;
    }

    public function show($slug)
    {
        $gallery = \App\Models\Gallery::whereActive(true)->whereSlug($slug)->first();

        return view('page-gallery.show')
            ->with('page', \App\Models\Page::whereActive(true)->whereRoute('gallery')->firstOrNew())
            ->with('gallery', $gallery)
        ;
    }
}

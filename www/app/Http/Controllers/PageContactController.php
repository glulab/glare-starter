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
        try {
            $q = \App\Models\Page::query();

            $q->with('photo_links');
            $q->with('galleries');

            $q->whereAction('contact');

            if (!Auth::guard('lit')->check()) {
                $q->whereActive(true);
            }

            $page = $q->firstOrFail();

        } catch (\Exception $e) {
            // explode suffix '.html'
            $slug = explode('.', request()->path());
            return app()->call('App\Http\Controllers\PageController@show', ['slug' => $slug[0]]);
        }

        return view('page-contact.show')
            ->with('page', $page)
        ;
    }
}

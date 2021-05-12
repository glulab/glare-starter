<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ignite\Support\Facades\Form;
use Illuminate\Support\Facades\Auth;

class PageRealizationController extends Controller
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
    public function show()
    {
        $q = \App\Models\Page::whereRoute('realizations');
        if (!Auth::guard('lit')->check()) {
            $q->whereActive(true);
        }

        // TODO: It could be refactored to sql query retrieving recods only needed for current page
        $page = $q->firstOrFail();

        // \Cache::forget('site:products_for_realizations');
        if (!\Cache::has('site:products_for_realizations')) :
            $this->groups = null;
            $this->products = collect([]);
            $groupsIds = \LitSettings::context()->categories_for_reazlizations;
            $this->groups = \App\Models\Group::with('products')->whereIn('id', $groupsIds)->get();

            $this->groups->each(function($group, $kGroup) {
                $this->products = $this->products->merge($group->products);
            });

            $this->products = $this->products->unique('id')->sortByDesc('date_add')->values();
            \Cache::put('site:products_for_realizations', $this->products, 60 * 60 * 6);
        else :
            $this->products = \Cache::get('site:products_for_realizations', collect([]));
        endif;

        $this->products = \CollectionHelper::paginate($this->products, \LitSettings::context('pagination', 50));

        // dd($this->products);

        session(['last_viewed_offer' => ['label' => $page->title, 'url' => request()->fullurl()/*$page->urlByType*/]]);

        return view('page-realizations.show')
            ->with('page', $page)
            ->with('products', $this->products)
        ;
    }
}

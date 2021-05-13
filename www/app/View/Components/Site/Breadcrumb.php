<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $breadcrumb = [];
    protected $model;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($showHome = true, $model = null)
    {
        $this->showHome = $showHome;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        parse_str(request()->getQueryString(), $this->queryString);
        $this->resolveBreadcrumb();
        return view('components.site.breadcrumb');
    }

    public function resolveBreadcrumb()
    {
        if ($this->showHome) {
            $this->breadcrumb[] = $this->resolveHome();
        }

        $this->breadcrumb = array_merge($this->breadcrumb, $this->resolveRoute());
    }

    public function resolveHome()
    {
        return [
            'label' => trans("site/breadcrumb.home"),
            'href' => url('/'),
            'active' => request()->path() === '/',
        ];
    }

    public function resolveRoute()
    {
        $routeName = request()->route()->getName();
        $methodName = 'resolve' . \Str::studly(str_replace('.', '_', $routeName));
        if (method_exists($this, $methodName)) {
            return call_user_func_array([$this, $methodName], [$routeName]);
        } else {
            return $this->resolveSegment(1);
        }
    }

    public function resolveSegment($number)
    {
        $segment = request()->segment($number);
        $b = [
            $number => [
                'label' => trans("site/breadcrumb.$segment"),
                'href' => url("$segment"),
                'active' => url()->full() === url("$segment"),
            ],
        ];
        return $b;
    }

    public function resolveOfferIndex($routeName)
    {
        $b = [];
        $b[]  = [
            'label' => 'Oferta',
            'href' => route('offer.index'),
            'active' => url()->full() === route('offer.index'),
        ];
        // if (!empty($this->queryString)) {
        //     // dd($this->queryString);
        // }
        return $b;
    }

    public function resolveOfferShow($routeName)
    {
        $b = [];
        $b[]  = [
            'label' => 'Oferta',
            'href' => route('offer.index'),
            'active' => url()->full() === route('offer.index'),
        ];
        $b[]  = [
            'label' => __($this->model->property_type) ?? '',
            'href' => route('offer.index', [
                'market_type' => $this->model->market_type,
                'transaction' => $this->model->transaction,
                'property_type' => $this->model->property_type,
            ]),
            'active' => url()->full() === route('offer.index', [
                'market_type' => $this->model->market_type,
                'transaction' => $this->model->transaction,
                'property_type' => $this->model->property_type,
            ]),
        ];
        $b[]  = [
            'label' => $this->model->title ?? '-',
            'href' => route('offer.show', ['id' => $this->model->id ?? 0]),
            'active' => url()->full() === route('offer.show', ['id' => $this->model->id ?? 0]),
        ];
        return $b;
    }

    public function getQuerySegments($url = null)
    {
        if (is_null($url)) {
            $url = url()->full();
        }
        $exploded = explode('?', $url);
        if (!isset($exploded[1])) {
            return [];
        }
        parse_str($exploded[1], $querySegments);
        return $querySegments;
    }

    public function isActive($url)
    {
        if (url()->full() === url($url)) {
            return true;
        }
        if (request()->path() === $url) {
            return true;
        }
        return false;
        // dump(request()->root());
        // dump(request()->path());
        // dump(request()->decodedPath());
        // dump(request()->segments());
        // dump(request()->segment(1));
        // dump(request()->url());
        // dump(request()->fullUrl());
        // dump(request()->getQueryString());
        // dump(request()->fullUrlWithQuery(['param1' => 'value1']));

        // dump(request()->route()->getName());
        // dump(request()->route()->getController());
        // dump(request()->route()->getDomain());
        // dump(request()->route()->getPrefix());
        // dump(request()->route()->getAction());
        // dump(request()->route()->getValidators());
        // dump(request()->route()->getCompiled());
        // dump(request()->route()->getActionName());
        // dump(request()->route()->getActionMethod());
        // dump(url()->full());
        // dd($url);
    }
}

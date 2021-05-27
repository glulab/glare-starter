<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

/**
 * <x-site.breadcrumb-array :segments="['home', 'route|offer.index||offer', 'session|last_viewed_offer', ['App\Support\View\Breadcrumb\ProductBreadcrumb', ['product' => $page]], 'basic|' . $page->name . '|' . $page->url]" />
 * <x-site.breadcrumb-array :segments="['home', 'route|offer.index', 'session|last_viewed_offer']" />
 * <x-site.breadcrumb-array :segments="['home', 'route|offer.index', 'basic|' . $page->name . '|' . $page->url]" />
 * <x-site.breadcrumb-array :segments="['home', 'route|offer.index', 'page']" :page="$page" />
 */
class BreadcrumbArray extends Component
{
    public $breadcrumb = [];
    protected $page;

    protected $segments;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($segments = [], $page = null)
    {
        $this->segments = $segments;
        $this->page = $page;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        foreach ($this->segments as $segmentInput) {
            if (is_array($segmentInput)) {
                $bc = app()->make($segmentInput[0], $segmentInput[1])->resolve();
                if (!empty($bc['label'])) {
                    $this->breadcrumb[] = $bc;
                }
            } elseif (is_string($segmentInput)) {
                $segment = explode('|', $segmentInput);
                $methodName = 'resolve' . ($segment[0] ?? 'default');
                if (method_exists($this, $methodName)) {
                    $bc = call_user_func_array([$this, $methodName], [$segment]);
                    if (!empty($bc['label'])) {
                        $this->breadcrumb[] = $bc;
                    }
                }
            }
        }
        return view('components.site.breadcrumb-array');
    }

    public function resolveHome($segment)
    {
        return [
            'label' => trans("site::breadcrumbs.home"),
            'href' => url('/'),
            'active' => request()->path() === '/',
        ];
    }

    public function resolveBasic($segment)
    {
        return [
            'label' => $segment[1] ?? '',
            'href' => $segment[2] ?? request()->url(),
            'active' => request()->url() === ($segment[2] ?? ''),
        ];
    }

    public function resolveSession($segment)
    {
        $sessionKey = isset($segment[1]) ? $segment[1] : null;

        $request = request();

        return [
            'label' => $request->session()->get("$sessionKey.label", ''),
            'href' => $request->session()->get("$sessionKey.url", ''),
            'active' => request()->url() === $request->session()->get("$sessionKey.url", ''),
        ];
    }

    /**
     * route|route-name|overridden-label
     *
     * @param [type] $segment [description]
     *
     * @return [type] [description]
     */
    public function resolveRoute($segment)
    {
        $routeName = $segment[1] ?? '';
        $routeLabel = $segment[2] ?? '';
        if (empty($routeLabel)) {
            $routeLabel = trans("site::breadcrumbs.$segment[1]");
        }
        return [
            'label' => $routeLabel,
            'href' => \Route::has($routeName) ? route($routeName) : '#',
            'active' => \Route::currentRouteName() === $routeName,
        ];
    }

    public function resolvePage($segment)
    {
        return [
            'label' => $this->page->title ?? '',
            'href' => $this->page->url ?? '#',
            'active' => request()->url() === $this->page->url ?? '',
        ];
    }
}

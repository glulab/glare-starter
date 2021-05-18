<?php

namespace App\View\Components\Site;

use Illuminate\Http\Request;
use Illuminate\View\Component;

class ContactForm extends Component
{
    public $containerClass;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, $containerClass = null)
    {
        $this->request = $request;
        $this->containerClass = $containerClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        if (!config('site.services.contact-form')) {
            return '';
        }

        $show = false;
        $exclude = false;

        $showOnRoutes = (array) config('site.options.contact-form-show-on-routes');
        $excludeFromRoutes = (array) config('site.options.contact-form-exclude-from-routes');

        foreach ($showOnRoutes as $route) {
            $show = $show || $this->request->routeIs($route);
        }

        foreach ($excludeFromRoutes as $route) {
            $exclude = $exclude || $this->request->routeIs($route);
        }

        if ($show === false) {
            return '';
        }

        if ($exclude === true) {
            return '';
        }

        return view('components.site.contact-form');
    }
}

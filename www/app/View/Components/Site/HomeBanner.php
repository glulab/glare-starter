<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;
use Ignite\Support\Facades\Form;

class HomeBanner extends Component
{
    public $homeBanner;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        if (!config('site.services.home-banner')) {
            return '';
        }

        $this->homeBanner = Form::load('home', 'home_banner');

        if (empty($this->homeBanner->active)) {
            return '';
        }

        if (!empty($this->homeBanner->url)) {
            $this->homeBanner->href = $this->homeBanner->url;
        } elseif(!empty($this->homeBanner->route)) {
            $this->homeBanner->href = $this->homeBanner->route->resolve();
        }

        return view('components.site.home-banner');
    }
}

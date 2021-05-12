<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;
use Ignite\Support\Facades\Form;

class HomeSlider extends Component
{
    public $homeSlider;
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class = '')
    {
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        if (!config('site.services.home-slider')) {
            return '';
        }

        $this->homeSlider = Form::load('home', 'home_slider');

        if (empty($this->homeSlider)) {
            return '';
        }

        $this->homeSlider->slider = $this->homeSlider->slider->map(function ($item, $key) {
            if (!empty($item->url)) {
                $item->href = $item->url;
            } elseif(!empty($item->route)) {
                $item->href = $item->route->resolve();
            }
            return $item;
        });

        return view('components.site.home-slider');
    }
}

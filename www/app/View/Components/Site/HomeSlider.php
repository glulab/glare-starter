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
        $this->homeSlider = Form::load('site', 'home_slider');
        if (empty($this->homeSlider)) {
            return '';
        }
        return view('components.site.home-slider');
    }
}

<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class Frontimage extends Component
{
    public $image;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($image = null)
    {
        $this->image = $image;
        if (empty($this->image)) {
            $site = app('site-shared')['site'];
            $this->image = $site->banner;
        }
        if (empty($this->image) && is_file(public_path('images/page/banner.jpg'))) {
            $this->image = asset('images/page/banner.jpg');
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if (empty($this->image)) {
            return '';
        }

        return view('components.site.frontimage');
    }
}

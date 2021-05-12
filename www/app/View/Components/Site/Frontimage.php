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
            $site = app('lit-shared')['site'];
            $this->image = $site->banner;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if (!is_callable($this->image)) {
            return '';
        }

        return view('components.site.frontimage');
    }
}

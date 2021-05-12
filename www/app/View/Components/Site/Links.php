<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class Links extends Component
{
    public $links;
    public $class;
    public $dir;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($links, $class = '', $dir = 'icons/links')
    {
        $this->links = $links;
        $this->class = $class;
        $this->dir = $dir;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if (empty($this->links) || count($this->links) === 0) {
            return '';
        }

        return view('components.site.links');
    }
}

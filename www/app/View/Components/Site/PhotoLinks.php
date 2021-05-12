<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class PhotoLinks extends Component
{
    public $items;
    public $class;
    public $containerClass;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($items, $class = '', $containerClass = '')
    {
        $this->items = $items;
        $this->class = $class;
        $this->containerClass = $containerClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.site.photo-links')
            ->with('items', $this->items)
            ->with('class', $this->class)
            ->with('containerClass', $this->containerClass)
        ;
    }
}

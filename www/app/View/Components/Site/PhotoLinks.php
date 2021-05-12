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
        if (empty($this->items)) {
            return '';
        }
        $this->items = $this->items->map(function ($item, $key) {
            if (!empty($item->url)) {
                $item->href = $item->url;
            } elseif(!empty($item->route)) {
                $item->href = $item->route->resolve();
            }
            return $item;
        });

        return view('components.site.photo-links')
            ->with('items', $this->items)
            ->with('class', $this->class)
            ->with('containerClass', $this->containerClass)
        ;
    }
}

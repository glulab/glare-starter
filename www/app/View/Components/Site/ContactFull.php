<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class ContactFull extends Component
{
    public $class;
    public $dir;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class = '', $dir = 'icons-contact')
    {
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
        return view('components.site.contact-full');
    }
}

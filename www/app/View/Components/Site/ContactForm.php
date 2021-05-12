<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class ContactForm extends Component
{
    public $containerClass;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($containerClass = null)
    {
        $this->containerClass = $containerClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.site.contact-form');
    }
}

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
        if (!config('site.services.contact-form')) {
            return '';
        }
        return view('components.site.contact-form');
    }
}

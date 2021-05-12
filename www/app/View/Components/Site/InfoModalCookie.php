<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class InfoModalCookie extends Component
{
    public $title;
    public $text;
    public $active;
    public $accept;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $text, $active = true, $accept = 'X')
    {
        $this->title = $title;
        $this->text = $text;
        $this->active = $active;
        $this->accept = $accept;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        if (!$this->active || (\Cookie::has('site-info-modal-cookie-accept') && (bool) \Cookie::get('site-info-modal-cookie-accept') === true)) {
            return '';
        }
        return view('components.site.info-modal-cookie');
    }
}

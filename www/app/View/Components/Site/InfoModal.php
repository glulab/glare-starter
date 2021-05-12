<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class InfoModal extends Component
{
    public $title;
    public $text;
    public $active;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $text, $active = true)
    {
        $this->title = $title;
        $this->text = $text;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        if ($this->active && request()->path() === '/') {
            return view('components.site.info-modal');
        }
        return '';
    }
}

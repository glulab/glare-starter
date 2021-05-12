<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class SystemPagesMenu extends Component
{
    public $systemPages;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $this->systemPages = \App\Models\Page::whereActive(true)->whereType('system')->get();
        return view('components.site.system-pages-menu');
    }
}

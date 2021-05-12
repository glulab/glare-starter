<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;
use Ignite\Support\Facades\Form;

class HomeBanner extends Component
{
    public $homeBanner;

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
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $this->homeBanner = Form::load('site', 'home_banner');

        if (empty($this->homeBanner->active)) {
            return '';
        }

        $exploded = explode('|', $this->homeBanner->text);
        $trimmed = [];

        foreach ($exploded as $line) {
            $trimmed[] = trim($line);
        }

        $this->homeBanner->lines = $trimmed;

        return view('components.site.home-banner');
    }
}

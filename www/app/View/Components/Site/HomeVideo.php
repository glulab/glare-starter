<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;
use Ignite\Support\Facades\Form;

class HomeVideo extends Component
{
    public $homeVideo;

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
        $this->homeVideo = Form::load('site', 'home_video');

        if (empty($this->homeVideo->active)) {
            return '';
        }

        $exploded = explode('|', $this->homeVideo->text);
        $trimmed = [];

        foreach ($exploded as $line) {
            $trimmed[] = trim($line);
        }

        $this->homeVideo->lines = $trimmed;

        return view('components.site.home-video');
    }
}

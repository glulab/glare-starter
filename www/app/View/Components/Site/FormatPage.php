<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class FormatPage extends Component
{
    public $formattedText;
    public $class;

    protected $text;
    protected $images;
    protected $nl2br;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text, $images, $class = '', $nl2br = false)
    {
        $this->text = $text;
        $this->images = $images;
        $this->class = $class;
        $this->nl2br = $nl2br;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $this->formattedText = \ViewHelper::formatPage($this->text, $this->images, $this->nl2br);
        return view('components.site.format-page');
    }
}

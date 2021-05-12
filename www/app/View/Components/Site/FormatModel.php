<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class FormatModel extends Component
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
    public function __construct($model, $components = [], $class = '', $nl2br = false)
    {
        $this->model = $model;
        $this->components = $components;

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
        $this->formattedText = \ViewHelper::formatModel($this->model, $this->nl2br);
        return view('components.site.format-model');
    }
}

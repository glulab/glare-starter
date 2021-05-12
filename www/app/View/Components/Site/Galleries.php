<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class Galleries extends Component
{

    protected $feed;
    public $galleries;
    public $class = null;
    public $attrs = null;
    public $size = null;
    public $miniature = 'miniature';
    public $thumb = 'thumb';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($feed, $class = null, $attrs = null, $size = null, $miniature = 'miniature', $thumb = 'thumb')
    {
        $this->feed = $feed;
        $this->class = $class;
        $this->attrs = $attrs;
        $this->size = $size;
        $this->miniature = $miniature;
        $this->thumb = $thumb;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if (isset($this->feed->galleries)) {
            $this->galleries = $this->feed->galleries;
        } elseif (is_iterable($this->feed)) {
            $this->galleries = $this->feed;
        } elseif (is_object($this->feed) && basename(get_class($this->feed)) === 'Gallery') {
            $this->galleries = collect([$this->feed]);
        } else {
            $this->galleries = [];
        }

        return view('components.site.galleries')
            ->with('galleries', $this->galleries)
            ->with('class', $this->class)
            ->with('attrs', $this->attrs)
            ->with('size', $this->size)
            ->with('miniature', $this->miniature)
            ->with('thumb', $this->thumb)
        ;
    }
}

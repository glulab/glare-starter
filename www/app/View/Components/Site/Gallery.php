<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class Gallery extends Component
{

    public $gallery;
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
    public function __construct($gallery, $class = null, $attrs = null, $size = null, $miniature = 'miniature', $thumb = 'thumb')
    {
        $this->gallery = $gallery;
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
        if (is_numeric($this->gallery)) {
            $this->gallery = \App\Models\Gallery::whereActive(true)->whereId($this->gallery)->first();
        }
        if (is_null($this->gallery)) {
            return '';
        }

        if (!is_object($this->gallery) || !basename(get_class($this->gallery)) === 'Gallery' || empty(optional($this->gallery)) ||  count($this->gallery->images) === 0) {
            return '';
        }

        return view('components.site.gallery')
            ->with('gallery', $this->gallery)
            ->with('class', $this->class)
            ->with('attrs', $this->attrs)
            ->with('size', $this->size)
            ->with('miniature', $this->miniature)
            ->with('thumb', $this->thumb)
        ;
    }
}

<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class Photos extends Component
{

    protected $gallery;
    public $images;
    public $class = '';
    public $attrs = [];
    public $size = '';
    public $miniature = 'miniature';
    public $thumb = 'thumb';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($images, $class = '', $attrs = null, $size = null, $miniature = 'miniature', $thumb = 'thumb')
    {
        $this->images = $images;
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
        if (is_numeric($this->images)) {

            $this->gallery = \App\Models\Gallery::whereActive(true)->whereId($this->images)->first();

            if (is_null($this->gallery)) {
                return '';
            }

            if (!is_object($this->gallery) || !basename(get_class($this->gallery)) === 'Gallery') {
                return '';
            }

            $this->images = $this->gallery->images;
        }

        $this->attrs = str_replace('=', '="', http_build_query($this->attrs ?? [], null, '" ')).'"';

        if (empty($this->images) || count($this->images) === 0) {
            return '';
        }

        return view('components.site.photos')
            ->with('images', $this->images)
            ->with('class', $this->class)
            ->with('attrs', $this->attrs)
            ->with('size', $this->size ?? '')
            ->with('miniature', $this->miniature)
            ->with('thumb', $this->thumb)
        ;
    }
}

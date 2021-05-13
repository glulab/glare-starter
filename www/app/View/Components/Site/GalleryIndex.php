<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class GalleryIndex extends Component
{
    public $gallery;
    public $title = '';
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
    public function __construct($title = '', $class = null, $attrs = null, $size = null, $miniature = 'miniature', $thumb = 'thumb')
    {
        $this->title = $title;
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
        $galleries = \App\Models\Gallery::whereActive(true)->get();

        $this->gallery = new \App\Models\Gallery([
            'title' => $this->title,
            'description' => '',
            'active' => true,
        ]);

        $images = [];

        $galleries->each(function ($item, $key) use (&$images) {
            if (!empty($item->image)) {

                $cp = $item->image->custom_properties;
                $cp['alt'] = $item->title;
                $cp['title'] = $item->title;
                $item->image->custom_properties = $cp;

                $item->image->slug = $item->slug;

                $images[] = $item->image;
            }
        });

        $this->gallery->imagesCollection = collect($images);

        // return app()->make(\App\View\Components\Site\Gallery::class, ['gallery' => $this->gallery]);
        return view('components.site.gallery-index')
            ->with('gallery', $this->gallery)
            ->with('class', $this->class)
            ->with('attrs', $this->attrs)
            ->with('size', $this->size)
            ->with('miniature', $this->miniature)
            ->with('thumb', $this->thumb)
        ;
    }
}

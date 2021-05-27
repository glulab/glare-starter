<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

/**
 * <x-site.page-title :page="$page" class="page-title" :prefix="['div' => ['text' => 'some text'], 'a' => ['text' => 'some text', 'href' => route('offer.index')]]"/>
 */
class PageTitle extends Component
{
    protected $page;
    public $text;
    public $tag;
    public $class;
    public $prefix;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($page, $class = null, $prefix = null)
    {
        $this->page = $page;
        $this->class = $class;
        $this->prefix = $prefix;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $defaultTag = config('site.options.page-title-default-tag', 'h1');
        $defaultClass = config('site.options.page-title-default-class', 'page-title');

        if (is_array($this->page)) {
            $this->text = $this->page['title'] ?? '';
            $this->tag = $this->page['title_tag'] ?? $defaultTag;
        } elseif(is_object($this->page)) {
            $this->text = $this->page->title ?? '';
            $this->tag = $this->page->title_tag ?? $defaultTag;
        } else {
            $this->text = $page ?? '';
            $this->tag = $defaultTag;
        }

        $this->class = $this->class ?: $defaultClass;

        $this->prefix = $this->resolvePrefix();

        if ($this->tag === '-') {
            return '';
        }

        return view('components.site.page-title');
    }

    public function resolvePrefix()
    {
        if (empty($this->prefix)) {
            return '';
        }
        $o = $this->resolveArrayPrefix($this->prefix);
        return $o;
    }

    public function resolveArrayPrefix($prefix)
    {
        $o = '';
        foreach ($prefix as $tag => $attributes) {
            $text = '';
            $attrArray = [];
            foreach ($attributes as $key => $val) {
                if ($key === 'text') {
                    $text .= $val;
                } else {
                    $attrArray[$key] = $val;
                }
            }
            $attrsList = \Helper::attributesToString($attrArray ?? []);
            $o .=  "<$tag $attrsList>$text</$tag>";
        }
        return $o;
    }
}

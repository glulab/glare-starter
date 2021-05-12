<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class LineSplitter extends Component
{
    public $text;
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text, $class = '')
    {
        $this->text = $text;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->text = trim($this->text);
        if (empty($this->text)) {
            return '';
        }

        $separator = "\r\n";
        if (strpos($this->text, ' | ') !== false) {
            $separator = '|';
        } elseif (strpos($this->text, '|') !== false) {
            $separator = '|';
        } elseif (strpos($this->text, "\r\n") !== false) {
            $separator = "\r\n";
        } elseif (strpos($this->text, "\n") !== false) {
            $separator = "\n";
        } elseif (strpos($this->text, "\r") !== false) {
            $separator = "\r";
        }

        $exploded = explode($separator, $this->text);
        $trimmed = [];

        foreach ($exploded as $line) {
            $trimmed[] = trim($line);
        }

        $this->lines = $trimmed;

        return view('components.site.line-splitter')
            ->with('text', $this->text)
            ->with('lines', $this->lines)
            ->with('class', $this->class)
        ;
    }
}

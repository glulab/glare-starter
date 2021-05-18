<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

class ContactBasic extends Component
{
    public $class;
    public $dir;
    public $entries = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class = '', $dir = 'icons/contact')
    {
        $data = app('lit-shared')['settings'];

        $this->class = $class;
        $this->dir = $dir;
        $this->entries = [
            'telephone' => [
                'keyType' => 'span',
                'file' => null,
                'value' => $data->site_telephone ?? null,
                'href' => 'tel:' . str_replace(' ', '', $data->site_telephone ?? ''),
            ],
            'email' => [
                'keyType' => 'span',
                'file' => null,
                'value' => $data->site_email ?? null,
                'href' => 'mailto:'.($data->site_email ?? ''),
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->checkEntries();

        return view('components.site.contact-basic');
    }

    protected function checkEntries()
    {
        foreach ($this->entries as $key => $entry) {
            if (empty($entry['value'])) {
                unset($this->entries[$key]);
                continue;
            }
            if (empty($this->dir)) {
                continue;
            }
            $filePath = "images/{$this->dir}/{$key}.png";
            if (is_file(public_path($filePath))) {
                $this->entries[$key]['keyType'] = 'img';
                $this->entries[$key]['file'] = asset($filePath);
            }
        }
    }
}


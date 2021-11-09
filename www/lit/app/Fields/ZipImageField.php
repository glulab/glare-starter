<?php

namespace Lit\Fields;

use Ignite\Crud\BaseField;

class ZipImageField extends BaseField
{
    protected $component = 'zip-image';

    /**
     * Set default field attributes.
     *
     * @return void
     */
    // public function mount()
    // {
    //     // $this->setAttribute('type', 'image');
    //     $this->accept('application/zip');
    // }

    /**
     * Accept mime types.
     *
     * @param string $mimeTypes
     *
     * @return $this
     */
    public function accept($mimeTypes)
    {
        $this->setAttribute('accept', $mimeTypes);

        return $this;
    }
}

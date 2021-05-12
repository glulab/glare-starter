<?php

namespace Lit\Repeatables;

use Ignite\Crud\Fields\Block\Repeatable;
use Ignite\Crud\Fields\Block\RepeatableForm;
use Ignite\Page\Table\ColumnBuilder;

class ContentBlockImageRepeatable extends Repeatable
{
    /**
     * Repeatable type.
     *
     * @var string
     */
    protected $type = 'content_block_image';

    /**
     * The represantive view of the repeatable.
     *
     * @var string
     */
    protected $view = 'rep.content_block_image';

    /**
     * Build the repeatable preview.
     *
     * @param  ColumnBuilder $preview
     * @return void
     */
    public function preview(ColumnBuilder $preview): void
    {
        $preview->col('<img src="{image.conversion_urls.thumb}">');
    }

    /**
     * Build the repeatable form.
     *
     * @param  RepeatableForm $form
     * @return void
     */
    public function form(RepeatableForm $form): void
    {
        $form->image('image')->title('Zdjęcia')->maxFiles(1)->crop(0)->hint('Zdjęcia')->expand();
        // $form->textarea('text')->title('Tekst')->placeholder('Treść')->hint('Treść');
    }
}

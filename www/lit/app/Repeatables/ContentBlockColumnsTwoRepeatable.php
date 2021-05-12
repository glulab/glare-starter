<?php

namespace Lit\Repeatables;

use Ignite\Crud\Fields\Block\Repeatable;
use Ignite\Crud\Fields\Block\RepeatableForm;
use Ignite\Page\Table\ColumnBuilder;

class ContentBlockColumnsTwoRepeatable extends Repeatable
{
    /**
     * Repeatable type.
     *
     * @var string
     */
    protected $type = 'content_block_columns_two';

    /**
     * The represantive view of the repeatable.
     *
     * @var string
     */
    protected $view = 'rep.content_block_columns_two';

    /**
     * Build the repeatable preview.
     *
     * @param  ColumnBuilder $preview
     * @return void
     */
    public function preview(ColumnBuilder $preview): void
    {
        $preview->col('{left_title}');
        $preview->col('{right_title}');
    }

    /**
     * Build the repeatable form.
     *
     * @param  RepeatableForm $form
     * @return void
     */
    public function form(RepeatableForm $form): void
    {
        $form->textarea('left_title')->title('Lewa Kolumna: Tytuł')->placeholder('Tytuł')->hint('Lewa Kolumna: Tytuł.');
        $form->wysiwyg('left_text')->title('Lewa Kolumna: Tekst')->hint('Lewa Kolumna: Treść');

        $form->textarea('right_title')->title('Prawa Kolumna: Tytuł')->placeholder('Tytuł')->hint('Prawa Kolumna: Tytuł.');
        $form->wysiwyg('right_text')->title('Prawa Kolumna: Tekst')->hint('Prawa Kolumna: Treść');
    }
}

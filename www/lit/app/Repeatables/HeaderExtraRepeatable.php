<?php

namespace Lit\Repeatables;

use Ignite\Crud\Fields\Block\Repeatable;
use Ignite\Crud\Fields\Block\RepeatableForm;
use Ignite\Page\Table\ColumnBuilder;

class HeaderExtraRepeatable extends Repeatable
{
    /**
     * Repeatable type.
     *
     * @var string
     */
    protected $type = 'header_extra';

    /**
     * The represantive view of the repeatable.
     *
     * @var string
     */
    protected $view = 'rep.header_extra';

    /**
     * Build the repeatable preview.
     *
     * @param  ColumnBuilder $preview
     * @return void
     */
    public function preview(ColumnBuilder $preview): void
    {
        $preview->col('{header_extra_name}');
    }

    /**
     * Build the repeatable form.
     *
     * @param  RepeatableForm $form
     * @return void
     */
    public function form(RepeatableForm $form): void
    {
        $form->input('header_extra_name')->title('Nazwa bloku')->hint('Wpisz orientacyjną nazwę bloku.');
        $form->textarea('header_extra_body')->title('Header Extra')->hint('Wklej kod.');
        $form->input('header_extra_domain')->title('Domena')->hint('Sprawdza domenę przed wyświetleniem.');
    }
}

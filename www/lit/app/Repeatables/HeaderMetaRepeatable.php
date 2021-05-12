<?php

namespace Lit\Repeatables;

use Ignite\Crud\Fields\Block\Repeatable;
use Ignite\Crud\Fields\Block\RepeatableForm;
use Ignite\Page\Table\ColumnBuilder;

class HeaderMetaRepeatable extends Repeatable
{
    /**
     * Repeatable type.
     *
     * @var string
     */
    protected $type = 'header_meta';

    /**
     * The represantive view of the repeatable.
     *
     * @var string
     */
    protected $view = 'rep.header_meta';

    /**
     * Build the repeatable preview.
     *
     * @param  ColumnBuilder $preview
     * @return void
     */
    public function preview(ColumnBuilder $preview): void
    {
        $preview->col('{header_meta_name}');
        $preview->col('{header_meta_content}');
    }

    /**
     * Build the repeatable form.
     *
     * @param  RepeatableForm $form
     * @return void
     */
    public function form(RepeatableForm $form): void
    {
        $form->select('header_meta_type')->title('Typ')->options(
            [
                'name' => 'name',
                'property' => 'property',
                'itemprop' => 'itemprop',
            ]
        );
        $form->input('header_meta_name')->title('Nazwa')->hint('Wpisz nazwę.');
        $form->input('header_meta_content')->title('Wartość')->hint('Wpisz wartość.');
    }
}

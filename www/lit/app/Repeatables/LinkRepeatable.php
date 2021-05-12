<?php

namespace Lit\Repeatables;

use Ignite\Crud\Fields\Block\Repeatable;
use Ignite\Crud\Fields\Block\RepeatableForm;
use Ignite\Page\Table\ColumnBuilder;

class LinkRepeatable extends Repeatable
{
    /**
     * Repeatable type.
     *
     * @var string
     */
    protected $type = 'link';

    /**
     * The represantive view of the repeatable.
     *
     * @var string
     */
    protected $view = 'rep.link';

    /**
     * Build the repeatable preview.
     *
     * @param  ColumnBuilder $preview
     * @return void
     */
    public function preview(ColumnBuilder $preview): void
    {
        $preview->col('{name}');
        $preview->col('{class}');
        $preview->col('{label}');
        $preview->col('{url}');
    }

    /**
     * Build the repeatable form.
     *
     * @param  RepeatableForm $form
     * @return void
     */
    public function form(RepeatableForm $form): void
    {
        $form->input('name')->title('Nazwa')->hint('Prosta nazwa (bez spacji).');
        $form->input('class')->title('Klasa')->hint('Klasa ikony font awesome (zawartość atrybutu class). <a target="_blank" href="https://fontawesome.com/icons?d=gallery&m=free">[fontawesome]</a>');
        $form->input('label')->title('Etykieta');
        $form->input('url')->title('Url');
        $form->boolean('active')->title('Aktywny');
    }
}

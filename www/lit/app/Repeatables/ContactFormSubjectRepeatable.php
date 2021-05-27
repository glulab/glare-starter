<?php

namespace Lit\Repeatables;

use Ignite\Page\Table\ColumnBuilder;
use Ignite\Crud\Fields\Block\Repeatable;
use Ignite\Crud\Fields\Block\RepeatableForm;

class ContactFormSubjectRepeatable extends Repeatable
{
    /**
     * Repeatable type.
     *
     * @var string
     */
    protected $type = 'contact_form_subject';

    /**
     * The represantive view of the repeatable.
     *
     * @var string
     */
    protected $view = 'rep.contact_form_subject';

    /**
     * Build the repeatable preview.
     *
     * @param  ColumnBuilder $preview
     * @return void
     */
    public function preview(ColumnBuilder $preview): void
    {
        $preview->col('{email}');
        $preview->col('{subject}');
    }

    /**
     * Build the repeatable form.
     *
     * @param  RepeatableForm $form
     * @return void
     */
    public function form(RepeatableForm $form): void
    {
        $form->input('email')->title('E-mail')->hint('Adres e-mail.')->width(12);
        $form->input('subject')->title('Temat')->hint('Temat wiadomości.')->width(12);
    }
}

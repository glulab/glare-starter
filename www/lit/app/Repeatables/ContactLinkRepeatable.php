<?php

namespace Lit\Repeatables;

use Ignite\Page\Table\ColumnBuilder;
use Ignite\Crud\Fields\Block\Repeatable;
use Facades\Lit\Support\Helpers\LitHelper;
use Ignite\Crud\Fields\Block\RepeatableForm;

class ContactLinkRepeatable extends Repeatable
{
    /**
     * Repeatable type.
     *
     * @var string
     */
    protected $type = 'contact_link';

    /**
     * The represantive view of the repeatable.
     *
     * @var string
     */
    protected $view = 'rep.contact_link';

    /**
     * Build the repeatable preview.
     *
     * @param  ColumnBuilder $preview
     * @return void
     */
    public function preview(ColumnBuilder $preview): void
    {
        $preview->col('{name}');
        if (config('site.options.contact-link-has-faclass')) {
            $preview->col('{faclass}');
        }
        if (config('site.options.contact-link-has-filename')) {
            $preview->col('{filename}');
        }
        $preview->col('{text}');
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
        $form->boolean('active')->title('Aktywny');
        $form->input('name')->title('Nazwa')->hint('Nazwa linku.')->width(1/2);
        $form->select('itemprop')->title('Funkcja')->options(LitHelper::itempropContactLinkSelectOptions())->hint('Funkcja (opcjonalnie).')->width(1/2);;
        if (config('site.options.contact-link-has-faclass')) {
            $form->input('faclass')->title('Klasa ikony')->hint('Klasa ikony font awesome (zawartość atrybutu class). <a target="_blank" href="https://fontawesome.com/icons?d=gallery&m=free">[fontawesome]</a>');
        }
        if (config('site.options.contact-link-has-filename')) {
            $form->select('filename')->title('Nazwa pliku ikony')->options(LitHelper::iconsSelectOptions('icons/contact'))->hint('Nazwa pliku ikony (jeżeli istnieje).');
        }

        $form->input('text')->title('Treść')->hint('Treść linku')->width(1/2);;
        $form->input('url')->title('Url')->hint('Adres URL linku.')->width(1/2);;

    }
}

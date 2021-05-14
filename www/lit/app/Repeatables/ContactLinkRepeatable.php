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
        if (config('site.options.contact-link-has-class')) {
            $preview->col('{class}');
        }
        if (config('site.options.contact-link-has-filename')) {
            $preview->col('{filename}');
        }
        if (config('site.options.contact-link-has-icon')) {
            $preview->col('{icon}');
        }
        $preview->col('{text}');
        // $preview->col('{url}');
    }

    /**
     * Build the repeatable form.
     *
     * @param  RepeatableForm $form
     * @return void
     */
    public function form(RepeatableForm $form): void
    {
        $hasClass = config('site.options.contact-link-has-class');
        $hasIcon = config('site.options.contact-link-has-icon');
        $hasFilename = config('site.options.contact-link-has-filename');
        $hasItemprop = config('site.options.contact-link-has-itemprop');
        $form->boolean('active')->title('Aktywny');
        $form->input('name')->title('Nazwa')->hint('Nazwa linku.')->width($hasClass ? 6 : 12);
        if ($hasClass) {
            $form->input('class')->title('Klasa ikony')->hint('Klasa ikony (opcjonalnie).')->width(6);
        }
        if ($hasItemprop) {
            $form->select('itemprop')->title('Funkcja')->options(LitHelper::itempropContactLinkSelectOptions())->hint('Funkcja (opcjonalnie).')->width(6);
        }
        if ($hasIcon) {
            $form->icon('icon')->title('Ikona')->hint('Ikona (opcjonalnie).')->width(6);
        }
        if ($hasFilename) {
            $form->select('filename')->title('Nazwa pliku ikony')->options(LitHelper::iconsSelectOptions('icons/contact'))->hint('Nazwa pliku ikony (jeżeli istnieje).')->width(6);
        }

        $form->input('text')->title('Treść')->hint('Treść linku')->width(6);
        $form->input('url')->title('Url')->hint('Adres URL linku.')->width(6);
    }
}

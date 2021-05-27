<?php

namespace Lit\Repeatables;

use Ignite\Crud\Fields\Block\Repeatable;
use Ignite\Crud\Fields\Block\RepeatableForm;
use Ignite\Page\Table\ColumnBuilder;

class PhotoLinkRepeatable extends Repeatable
{
    /**
     * Repeatable type.
     *
     * @var string
     */
    protected $type = 'photo_link';

    /**
     * The represantive view of the repeatable.
     *
     * @var string
     */
    protected $view = 'rep.photo_link';

    /**
     * Build the repeatable preview.
     *
     * @param  ColumnBuilder $preview
     * @return void
     */
    public function preview(ColumnBuilder $preview): void
    {
        $preview->col('{label}');
        $preview->col('<img src="{image.conversion_urls.thumb}">');
        $preview->view('lit::columns.is-active');
    }

    /**
     * Build the repeatable form.
     *
     * @param  RepeatableForm $form
     * @return void
     */
    public function form(RepeatableForm $form): void
    {
        $form->boolean('active')->title('Aktywny')->hint('Aktywny')->width(1/3);

        if (config('site.options.photo-link-has-image')) {
            $form->image('image')->title('Obraz')->crop(config('site.config.ratios.photo-link'))->hint('Obraz.')->maxFiles(1);
        }
        if (config('site.options.photo-link-has-title')) {
            $form->textarea('title')->title('Tytuł')->placeholder('Tytuł')->hint('Tytuł.');
        }

        if (config('site.options.photo-link-has-text')) {
            $form->textarea('text')->title('Tekst')->placeholder('Treść')->hint('Treść');
        }

        if (config('site.options.photo-link-has-button')) {
            $form->textarea('label')->title('Przycisk')->placeholder('Tekst na przycisku')->hint('Tekst na przycisku.');
            $form->route('route')->collection('site-routes')->title('Wybierz stronę')->hint('wybierz stronę w systemie')->width(6);
            $form->input('url')->type('text')->title('Adres URL')->placeholder('Adres url')->hint('lub wpisz adres url')->prepend('<i class="fas fa-link"></i>')->append('link')->width(6);
        }
    }
}

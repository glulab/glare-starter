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
        $form->boolean('active')->title('AKTYWNY')->hint('Aktywny')->width(1/3);
        // $form->input('title')->title('TYTUŁ')->placeholder('Tytuł')->hint('Tytuł');
        // $form->textarea('text')->title('TEKST')->placeholder('Treść')->hint('Treść');
        $form->image('image')->title('OBRAZ')/*->crop(1612 / 600)*/->hint('Obraz.')->maxFiles(1)/*->expand()*/;
        $form->input('label')->title('PRZYCISK')->type('text')->placeholder('Tekst na przycisku: Pierwsza liniea | druga linia.')->hint('Tekst na przycisku. Znak | powoduje rozdzielenie linii.');
        $form->route('route')->collection('site-routes')->title('WYBIERZ STRONĘ')->hint('wybierz stronę w systemie');
        $form->input('url')->title('URL')->type('text')->placeholder('Adres url')->hint('lub wprowadź adres url')->prepend('<i class="fas fa-link"></i>')->append('link')->width(12);
    }
}

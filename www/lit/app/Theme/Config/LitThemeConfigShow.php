<?php

namespace Lit\Theme\Config;

use Ignite\Crud\CrudShow;
use Lit\Repeatables\ContentBlockImageRepeatable;
use Lit\Repeatables\ContentBlockColumnsTwoRepeatable;

class LitThemeConfigShow
{
    public function pageContentBlocks($form)
    {
        $form->block('content_blocks')
            ->title('Bloki Treści')
            ->repeatables(
                function ($repeatables) {
                    $repeatables->add(ContentBlockColumnsTwoRepeatable::class)->button(__('Add') . ' ' . __lit('forms.content_block_columns_two'));
                    $repeatables->add(ContentBlockImageRepeatable::class)->button(__('Add') . ' ' . __lit('forms.content_block_image'));
                }
            );
    }

    public function relationGroups(CrudShow $page, $type)
    {
        // $page->card(function($form) {

        //     $form->relation('groups')
        //         ->title('Grupy')
        //         ->query(function($query) {
        //             $query->with('products');
        //         })
        //         ->filter(function($query) {
        //             $query->where(function ($q) {
        //                 $q->where('id_parent', 1);
        //                 $q->orWhere('id_parent', 2);
        //             });
        //         })
        //         ->preview(function ($table) {
        //             $table->col('{id}');
        //             $table->image()->src('{products.0.pictures.0.conversion_urls.thumb}')->maxWidth('50px')->maxHeight('50px');
        //             $table->col('{name}');
        //         })
        //     ;

        // })->title('Relacje: Grupy Ofertowe');
    }
}

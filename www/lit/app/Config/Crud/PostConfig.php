<?php

namespace Lit\Config\Crud;

use App\Models\Post;
use Ignite\Crud\CrudShow;
use Ignite\Crud\CrudIndex;
use Illuminate\Support\Str;
use Ignite\Crud\Config\CrudConfig;
use Lit\Http\Controllers\Crud\PostController;
use Facades\Lit\Support\Config\LitConfigShow;
use Facades\Lit\Support\Config\LitConfigIndexTable;

class PostConfig extends CrudConfig
{
    /**
     * Model class.
     *
     * @var string
     */
    public $model = Post::class;

    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = PostController::class;

    /**
     * Model singular and plural name.
     *
     * @param Post|null post
     * @return array
     */
    public function names(Post $post = null)
    {
        return [
            'singular' => ucfirst(__lit('models.post')),
            'plural' => ucfirst(__lit('models.posts')),
        ];
    }

    /**
     * Get crud route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'posts';
    }

    /**
     * Build index page.
     *
     * @param \Ignite\Crud\CrudIndex $page
     * @return void
     */
    public function index(CrudIndex $page)
    {
        $page->expand();

        $page->title('Posty');

        $page->table(function ($table) {

            LitConfigIndexTable::pageBase($this, $table, '{images.0.conversion_urls.thumb}');

            LitConfigIndexTable::pageToggles($this, $table);

        })

        ->query(function($query) {
            //
        })

        ->sortByDefault('id.desc')

        ->sortBy([
            'id.desc' => __lit('crud.sort_new_to_old'),
            'id.asc' => __lit('crud.sort_old_to_new'),
        ])

        ->search('title')
        ;
    }

    /**
     * Setup show page.
     *
     * @param \Ignite\Crud\CrudShow $page
     * @return void
     */
    public function show(CrudShow $page)
    {
        $page->expand();

        $page
            ->info('Post')
            ->text('Edycja')
        ;

        $page->card(function($form) {


            $form->input('position')->title('Pozycja')->hint('Podczas tworzenia pozostaw puste')->width(1/3);
            $form->boolean('active')->title('Aktywna')->hint('Aktywna')->width(1/3);

        })->title('OPCJE');

        LitConfigShow::pageContent($page);

        LitConfigShow::images($page);

        LitConfigShow::blockPhotoLinks($page);

        LitConfigShow::relationGalleries($page);

        LitConfigShow::seo($page);

        LitConfigShow::sitemap($page);

        LitConfigShow::relationCategories($page, 'post');
    }
}

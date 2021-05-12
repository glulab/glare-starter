<?php

namespace Lit\Config\Crud;

use Ignite\Crud\CrudShow;
use Ignite\Crud\CrudIndex;
use Ignite\Crud\Config\CrudConfig;
use Illuminate\Support\Str;

use App\Models\Post;
use Lit\Http\Controllers\Crud\PostController;

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

            $table->col('ID')->value('{id}')->sortBy('id');
            $table->image('FOTO')->src('{images.0.conversion_urls.thumb}')->maxWidth('50px')->maxHeight('50px');
            $table->col('TYTUŁ')->value('{title}')->sortBy('title');
            $table->col('URL')->value('{slug}')->sortBy('slug');
            $table->toggle('active')->label('AKTYWNY')->routePrefix($this->routePrefix())->sortBy('active');

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

            $form->input('title')->title('TYTUŁ')->width(12);
            $form->input('slug')->title('URL')->width(12);

            $form->textarea('description')->title('OPIS')->width(12);
            $form->wysiwyg('text')->title('TREŚĆ')->width(12);

        })->title('Zawartość');

        $page->card(function($form) {

            $form->image('images')->title('FOTO')->firstBig()->maxFiles(150);

        })->title('Foto');

        $page->card(function($form) {

            $form->input('meta_title')->title('SEO TYTUŁ')->hint('Tytuł SEO pod wyszukiwarki.')->width(12);
            $form->textarea('meta_description')->title('SEO OPIS')->hint('Opis SEO pod wyszukiwarki.')->width(12);

        })->title('SEO');

        $page->card(function($form) {

            $form->relation('categories')
                ->title('Kategorie')
                ->filter(function($query) {
                    $query->where('type', 'post');
                })
                ->preview(function ($table) {
                    $table->col('{id}');
                    $table->col('{title}');
                })
            ;

        })->title('Relacje');

        $page->card(function($form) {

            $form->boolean('active')->title('Aktywna')->hint('Aktywna.')->width(12);

        })->title('Opcje');
    }
}

<?php

namespace Lit\Support\Config;

use Ignite\Crud\CrudShow;
use Lit\Repeatables\PhotoLinkRepeatable;
use Facades\Lit\Support\Helpers\LitHelper;
use Facades\Lit\Support\Helpers\LitPageHelper;
use Facades\Lit\Support\Helpers\LitSitemapHelper;
use Facades\Lit\Theme\Config\LitThemeConfigShow;

class LitConfigShow
{
    public function content(CrudShow $page, $options = [], $title = 'ZAWARTOŚĆ')
    {
        $page->card(function($form) use ($options) {

            if (in_array('name', $options)) {
                $form->input('name')->title('Nazwa')->width(12);
            }
            if (in_array('title', $options)) {
                $form->input('title')->title('Tytuł')->max(255)->width(12);
            }
            if (in_array('titlearea', $options)) {
                $form->textarea('title')->title('Tytuł')->hint('Max: 255 znaków.')->width(12);
            }
            if (in_array('slug', $options)) {
                $form->input('slug')->title('Adres url')->width(12);
            }
            if (in_array('description', $options)) {
                $form->textarea('description')->title('Opis')->width(12);
            }
            if (in_array('text', $options)) {
                $form->wysiwyg('text')->title('Treść')->width(12)->hint('Treść');
                $form->view('lit::forms.collapse', LitPageHelper::textHint());
            }

            if (in_array('content_blocks', $options)) {
                LitThemeConfigShow::pageContentBlocks($form);
            }

        })->title($title);
    }

    public function sectionContent(CrudShow $page)
    {
        $this->content($page, ['titlearea'], 'TYYUŁ');
        $this->content($page, ['text'], 'TREŚĆ');
    }

    public function pageDescription(CrudShow $page)
    {
        $this->content($page, ['title', 'slug', 'description'], 'TYTUŁ I OPIS');
    }

    public function pageContent(CrudShow $page)
    {
        $this->content($page, ['text', 'content_blocks'], 'TREŚĆ');
    }

    public function banners(CrudShow $page, $name = 'banners', $maxFiles = 1, $ratio = null, $hint = false)
    {
        $ratio = $ratio ?? config('site.config.ratios.page-banner');
        $page->card(function($form) use ($name, $maxFiles, $ratio, $hint) {

            $form->image($name)->title('Banner')->maxFiles($maxFiles)->crop($ratio)->expand()->hint($hint ?? 'Banner');

        })->title('BANNER');
    }

    public function images(CrudShow $page, $name = 'images', $maxFiles = 150, $ratio = 0, $hint = null)
    {
        $page->card(function($form) use ($name, $maxFiles, $ratio, $hint) {

            $form->image($name)->title('Zdjęcia')->maxFiles($maxFiles)->crop($ratio)->hint($hint ?? 'Zdjęcia'); // /*->expand()*//*->firstBig()*/
            $form->view('lit::forms.collapse', LitPageHelper::imagesHint());

        })->title('ZDJĘCIA');
    }

    public function galleryImages(CrudShow $page, $name = 'images', $maxFiles = 150, $ratio = 0, $hint = false)
    {
        $this->images($page, $name, $maxFiles, $ratio, $hint);
    }

    public function blockPhotoLinks(CrudShow $page)
    {
        $page->card(function ($form) {

            $form->block('photo_links')
                ->title('Przyciski')
                ->repeatables(
                    function ($repeatables) {
                        $repeatables->add(PhotoLinkRepeatable::class)->button(__('Add'));
                    }
                );
            $form->view('lit::forms.collapse', LitPageHelper::photoLinksHint());

        })->title('PRZYCISKI');
    }

    public function relationGalleries(CrudShow $page)
    {
        $page->card(function($form) {

            $form->relation('galleries')
                ->title('Galerie')
                // ->type('tags')
                // ->tagValue('{title}<br><img style="padding-bottom: 20px;padding-left: 14px; width: 100px; height: 100px;" src="{images.0.conversion_urls.thumb}"/>')
                ->preview(function ($table) {
                    $table->col('{id}');
                    $table->image()->src('{images.0.conversion_urls.thumb}')->maxWidth('50px')->maxHeight('50px');
                    $table->col('{title}');
                    $table->col('{pivot.position}');
                })
                ->sortable();
            ;
            $form->view('lit::forms.collapse', LitPageHelper::galleriesHint());
        })->title('GALERIE');
    }

    public function seo(CrudShow $page)
    {
        $page->card(function($form) {

            $form->input('meta_title')->title('SEO Tytuł')->hint('Tytuł SEO pod wyszukiwarki.')->width(12);
            $form->textarea('meta_description')->title('SEO Opis')->hint('Opis SEO pod wyszukiwarki.')->width(12);

        })->title('SEO');
    }

    public function sitemap(CrudShow $page)
    {
        $page->card(function($form) {

            $form->boolean('sitemap')->title('Sitemap')->hint('Sitemap')->width(1/5);
            $form->select('sitemap_changefreq')->title('Częstotliwość')->options(LitSitemapHelper::changefreq())->hint('Wybierz częstotliwość modyfikacji')->width(2/5);
            $form->select('sitemap_priority')->title('Priorytet')->options(LitSitemapHelper::priority())->hint('Wybierz priorytet')->width(2/5);

        })->title('SITEMAP');
    }

    public function relationCategories(CrudShow $page, $type)
    {
        $page->card(function($form) {

            $form->relation('categories')
                ->title('Kategorie')
                ->filter(function($query) {
                    $query->where('type', $type);
                })
                ->preview(function ($table) {
                    $table->col('{id}');
                    $table->col('{title}');
                })
            ;

        })->title('Relacje: Kategorie');
    }

    public function preview(CrudShow $page, $class = 'btn btn-light', $style = 'position: absolute; top: 0; right: 15px; z-index: 1;')
    {
        $url = LitHelper::showPreview();
        $page->view('lit::forms.preview', ['url' => $url, 'class' => $class, 'style' => $style]);
    }
}

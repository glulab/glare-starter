<?php

namespace Lit\Support\Config;

use Ignite\Crud\CrudShow;
use Facades\Lit\Support\Helpers\LitHelper;
use Facades\Lit\Support\Helpers\LitPageHelper;

class LitConfigIndexTable
{
    public function base($config, $table, $imgSrc = '', $options = [])
    {
        if (in_array('id', $options)) {
            $table->col('ID')->value('{id}')->sortBy('id')->right()->small();
        }
        if (!empty($imgSrc)) {
            $table->image('FOTO')->src($imgSrc)->maxWidth('50px')->maxHeight('50px');
        }
        if (in_array('name', $options)) {
            $table->col('NAZWA')->value('{name}')->sortBy('name')->center();
        }
        if (in_array('title', $options)) {
            $table->col('TYTUŁ')->value('{title}')->sortBy('title')->center();
        }
        if (in_array('slug', $options)) {
            $table->col('URL')->value('{slug}')->sortBy('slug')->center()->class('small text-secondary');
        }
    }

    public function toggles($config, $table, $options = ['active'])
    {
        if (in_array('sitemap', $options)) {
            $table->toggle('sitemap')->label('SITEMAP')->routePrefix($config->routePrefix())->sortBy('sitemap');
        }

        if (in_array('active', $options)) {
            $table->toggle('active')->label('AKTYWNY')->routePrefix($config->routePrefix())->sortBy('active');
        }
    }

    public function default($config, $table, $imgSrc = '', $options = ['id', 'title', 'slug', 'active'])
    {
        $this->base($config, $table, $imgSrc, $options);

        $this->toggles($config, $table, $options);
    }

    public function position($config, $table, $asForm = false)
    {
        if ($asForm) {
            $table->field('POZYCJA')->input('position');
        } else {
            $table->col('POZYCJA')->value('{position}')->sortBy('position')->center();
        }
    }

    public function pageBase($config, $table, $imgSrc = '', $options = ['id', 'title', 'slug'])
    {
        $this->base($config, $table, $imgSrc, $options);
    }

    public function pageToggles($config, $table, $options = ['sitemap', 'active'])
    {
        $this->toggles($config, $table, $options);
    }

    public function pageRoute($config, $table, $options = [])
    {
        $table->col('AKCJA')->value('action', LitPageHelper::actionSelectOptions('<span class="badge badge-secondary">{option}</span>'))->sortBy('action')->center()->class('small');
    }

    public function relationManyBadges($config, $table, $name, $value, $badgeClass = 'secondary', $iterate = 10)
    {
        $table->col($name)->value(LitHelper::badges($value, $badgeClass, $iterate))->center()->class('small');
    }

    public function relationGalleries($config, $table, $value = '{galleries.#.title}')
    {
        $this->relationManyBadges($config, $table, 'GALERIA', $value, 'light');
        // $table->col('GALERIA')->value(LitHelper::badges($value, 'light'))->center()->class('small');
    }

    public function relationCategories($config, $table, $value = '{categories.#.title}')
    {
        $this->relationManyBadges($config, $table, 'KATEGORIA', $value, 'light');
        // $table->col('KATEGORIA')->value(LitHelper::badges('{categories.#.title}', 'light'))/*->sortBy('categories_count')*/->center()->class('small');
    }

    public function relationGroups($config, $table, $value = '{groups.#.name}')
    {
        $this->relationManyBadges($config, $table, 'GRUPA', $value, 'light');
        // $table->col('GRUPA')->value(LitHelper::badges('{groups.#.name}', 'light'))/*->sortBy('groups_count')*/->center()->class('small'); // $table->col('GRUPY')->value('{groups_count}')->sortBy('groups_count')->center(); // $table->col('GRUPY')->value('{groups_count}')->sortBy('groups_count')->center(); // $table->col('GRUPA')->value('{groups.0.name}'); // $table->relation('groups.0', GroupConfig::class)->value('{groups.0.name}')->sortBy('groups.0.name');
    }

    public function pagePositionActions()
    {
        return [
            '↑ PIERWSZY' => \Lit\Actions\Page\MoveUpFirst::class,
            '↑ 10' => \Lit\Actions\Page\MoveUpTen::class,
            '↑' => \Lit\Actions\Page\MoveUpOne::class,
            '↓' => \Lit\Actions\Page\MoveDownOne::class,
            '↓ 10' => \Lit\Actions\Page\MoveDownTen::class,
            '↓ OSTATNI' => \Lit\Actions\Page\MoveDownLast::class,
        ];
    }

    public function sectionPositionActions()
    {
        return [
           '↑ PIERWSZY' => \Lit\Actions\Section\MoveUpFirst::class,
           '↑ 10' => \Lit\Actions\Section\MoveUpTen::class,
           '↑' => \Lit\Actions\Section\MoveUpOne::class,
           '↓' => \Lit\Actions\Section\MoveDownOne::class,
           '↓ 10' => \Lit\Actions\Section\MoveDownTen::class,
           '↓ OSTATNI' => \Lit\Actions\Section\MoveDownLast::class,
       ];
    }
}

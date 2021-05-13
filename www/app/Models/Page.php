<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Ignite\Crud\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Ignite\Crud\Models\Traits\Sluggable;
use Spatie\MediaLibrary\HasMedia as HasMediaContract;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class Page extends Model implements HasMediaContract
{
    use HasMedia, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'sitemap' => 'boolean',
        'options' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image', 'images', 'url'];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['media'];

    /**
     * [$attributes description]
     *
     * @var array
     */
    protected $attributes = [
        'sitemap' => false,
        'sitemap_changefreq' => 'weekly',
        'sitemap_priority' => '0.5',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Image attribute.
     *
     * @return \Lit\Crud\Models\Media
     */
    public function getImageAttribute()
    {
        return $this->getMedia('images')->first();
    }

    /**
     * Images attribute.
     *
     * @return \Lit\Crud\Models\Media
     */
    public function getImagesAttribute()
    {
        return $this->getMedia('images')/*->all()*/;
    }

    /**
     * [getUrlAttribute description]
     *
     * @return [type] [description]
     */
    public function getUrlAttribute()
    {
        return $this->getUrlByTypeAttribute(); // return url($this->slug . '.html');
    }

    /**
     * [getUrlAttribute description]
     *
     * @return [type] [description]
     */
    public function getUrlByTypeAttribute()
    {
        $translationKey = 'site/models/page.route_prefix_by_type';

        $typePrefixLang = __($translationKey . '.' . $this->type);

        // check if there is a route prefix translation
        if (strpos($typePrefixLang, $translationKey) !== false) {
            $typePrefixLang = '';
        }

        return url($typePrefixLang . $this->slug . '.html');
    }

    /**
     * [getDontUsePositionsAttribute description]
     *
     * @return [type] [description]
     */
    public function getDontUsePositionsAttribute()
    {
        switch ($this->type) {
            case 'offer':
            case 'post':
                return false;
                break;

            default:
                return true;
                break;
        }
    }

    /**
     * [registerMediaCollections description]
     *
     * @return [type] [description]
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->withResponsiveImages()
            ->registerMediaConversions(function (SpatieMedia $media) {
                $this->setConversionsKey('none'); // override default lit conversions
                // $this->addMediaConversion('main')->width(1280)->height(720)->queued()/*->withResponsiveImages()*/;
                $this->addMediaConversion('miniature')->fit(Manipulations::FIT_CROP, config('lit.mediaconversions.default.miniature.0'), config('lit.mediaconversions.default.miniature.1'))->nonQueued();
                $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, config('lit.mediaconversions.default.thumb.0'), config('lit.mediaconversions.default.thumb.1'))->nonQueued();
            })
        ;
    }

    /**
     * [photo_links description]
     *
     * @return [type] [description]
     */
    public function photo_links()
    {
        return $this->repeatables('photo_links');
    }

    /**
     * [groups description]
     *
     * @return [type] [description]
     */
    public function groups()
    {
        return $this->belongsToMany(
            $related = \App\Models\Group::class,        // $instance = $this->newRelatedInstance($related);
            $table = 'page_group',                      // $this->joiningTable($related, $instance)
            $foreignPivotKey = 'page_id',               // $this->getForeignKey() tablename_primarykey
            $relatedPivotKey = 'group_id',              // $instance->getForeignKey() tablename_primarykey
            $parentKey = 'id',                          // $this->getKeyName()
            $relatedKey = 'id',                         // $instance->getKeyName()
            $relation = 'groups'                        // no need for debug_backtrace to guess relation name
        );
    }

    /**
     * [categories description]
     *
     * @return [type] [description]
     */
    public function categories()
    {
        return $this->morphToMany(
            $related = \App\Models\Category::class,
            $name = 'categorized',
            $table = 'categorized',
            $foreignPivotKey = 'categorized_id', // $name + _id
            $relatedPivotKey = 'category_id', // $instance->getForeignKey() // $instance = $this->newRelatedInstance($related);
            $parentKey = 'id', // $this->getKeyName()
            $relatedKey = 'id', // $instance->getKeyName()
            $inverse = false
        );
    }

    /**
     * [positionChangeConditions description]
     *
     * @param [type] $query [description]
     *
     * @return [type] [description]
     */
    public function positionChangeConditions($query)
    {
        $query->whereType($this->type);
        return $query;
    }
}

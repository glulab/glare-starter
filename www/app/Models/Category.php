<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia as HasMediaContract;
use Ignite\Crud\Models\Traits\HasMedia;
use Ignite\Crud\Models\Traits\Sluggable;

class Category extends Model implements HasMediaContract
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
       'type' => 'post',
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
        return url($this->slug . '.html');
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

    // /**
    //  * Get all of the posts that are assigned this tag.
    //  */
    // public function posts()
    // {
    //     return $this->morphedByMany(
    //         $related = \App\Models\Post::class,
    //         $name = 'categorized',
    //         $table = 'categorized',
    //         $foreignPivotKey = 'category_id',
    //         $relatedPivotKey = 'categorized_id',
    //         $parentKey = 'id',
    //         $relatedKey = 'id'
    //     );
    // }

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function pages()
    {
        return $this->morphedByMany(
            $related = \App\Models\Page::class,
            $name = 'categorized',
            $table = 'categorized',
            $foreignPivotKey = 'category_id',
            $relatedPivotKey = 'categorized_id',
            $parentKey = 'id',
            $relatedKey = 'id'
        );
    }
}

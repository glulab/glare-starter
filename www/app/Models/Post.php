<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Ignite\Crud\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Ignite\Crud\Models\Traits\Sluggable;
use Spatie\MediaLibrary\HasMedia as HasMediaContract;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class Post extends Model implements HasMediaContract
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
            // ->withResponsiveImages()
            // ->registerMediaConversions(function (SpatieMedia $media) {
            //     $this->setConversionsKey('none'); // override default lit conversions
            //     // $this->addMediaConversion('main')->width(1280)->height(720)->queued()/*->withResponsiveImages()*/;
            //     $this->addMediaConversion('miniature')->fit(Manipulations::FIT_CROP, config('lit.mediaconversions.default.miniature.0'), config('lit.mediaconversions.default.miniature.1'))->nonQueued();
            //     $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, config('lit.mediaconversions.default.thumb.0'), config('lit.mediaconversions.default.thumb.1'))->nonQueued();
            // })
        ;
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

}

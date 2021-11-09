<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Ignite\Crud\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Ignite\Crud\Models\Traits\Sluggable;
use Spatie\MediaLibrary\HasMedia as HasMediaContract;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class Section extends Model implements HasMediaContract
{
    use HasMedia;

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
    protected $appends = ['image', 'images'];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['media'];


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
        return $this->getMedia('images');
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
     * [positionChangeConditions description]
     *
     * @param [type] $query [description]
     *
     * @return [type] [description]
     */
    public function positionChangeConditions($query)
    {
        $query->whereType($this->type);
        $query->whereLocation($this->location);
        return $query;
    }
}

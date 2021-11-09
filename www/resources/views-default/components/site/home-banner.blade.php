<div class="home-banner">
    @if($homeBanner->hasMedia('image'))
        @php
            $image = $homeBanner->getFirstMedia('image');
            $attrs = [];
            $attrs['class'] = 'home-banner-image w-100';
            $attrs['alt'] = $image->getCustomProperty('alt') ?? '';
            $attrs['title'] = $image->getCustomProperty('title') ?? $attrs['alt'];
            if ($image->hasCustomProperty('crop.width')) {
                $attrs['width'] = $image->getCustomProperty('crop.width');
            } elseif ($image->hasCustomProperty('original_dimensions.width')) {
                $attrs['width'] = $image->getCustomProperty('original_dimensions.width');
            }
            if ($image->hasCustomProperty('crop.height')) {
                $attrs['height'] = $image->getCustomProperty('crop.height');
            } elseif ($image->hasCustomProperty('original_dimensions.height')) {
                $attrs['height'] = $image->getCustomProperty('original_dimensions.height');
            }
        @endphp
        {!! $image()->attributes($attrs)->lazy() !!}
    @else
        <img class="empty-img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="">
    @endif

    <div class="home-banner-body">
        <div class="container">
            <div class="home-banner-inner">
                @if(config('site.options.home-banner-has-title') && !empty($homeBanner->title))
                    <div class="home-banner-title">{{ $homeBanner->title }}</div>
                @endif

                <x-site.line-splitter :text="$homeBanner->text ?? ''" class="home-banner-text"/>

                @if (config('site.options.home-banner-has-button') && !empty($homeBanner->label))
                    <a class="btn btn-custom home-banner-button" href="{!! $homeBanner->href !!}">{!! $homeBanner->label !!}</a>
                @endif

            </div>
        </div>
    </div>
</div>

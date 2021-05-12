<div class="home-banner">
    {{-- <img class="home-banner-image" src="{!! $homeBanner->image->url !!}" alt="{!! $homeBanner->title !!}"> --}}

    @if($homeBanner->hasMedia('image'))
        {!! $homeBanner->getFirstMedia('image')()->attributes(['class' => 'home-banner-image w-100'])->lazy() !!}
    @else
        <img class="product-img empty-img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="">
    @endif

    <div class="home-banner-body">
        <div class="container">
            <div class="home-banner-inner">
                @if (isset($homeBanner->lines))
                    <div class="home-banner-lines">
                        @foreach($homeBanner->lines as $key => $line)
                            <div class="home-banner-line is-{!! $key + 1 !!}">{!! $line !!}</div>
                        @endforeach
                    </div>
                @else
                    <div class="home-banner-text">{{ $homeBanner->text }}</div>
                @endif

                {{-- <div class="home-banner-text">{{ $homeBanner->text }}</div> --}}
                {{-- <a class="btn btn-primary banner-button" href="{!! $homeBanner->text !!}" class="btn btn-primary">{!! $homeBanner->label !!}</a> --}}

            </div>
        </div>
    </div>
</div>

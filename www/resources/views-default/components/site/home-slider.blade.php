@if($homeSlider->slider->count() > 0)
<div class="home-slider {!! $class !!}">

    <div id="home-slider" class="carousel carousel-fade slide" data-ride="carousel" data-interval="5000">
        <ol class="carousel-indicators">
        @foreach ($homeSlider->slider->all() as $key => $slide)
            @if (empty($slide->active) || !$slide->hasMedia('image'))
                @continue
            @endif
            <li data-target="#home-slider" data-slide-to="{!! $key !!}" class="{!! $key == 0 ? 'active' : '' !!}"></li>
        @endforeach
        </ol>
        <div class="carousel-inner">
        @foreach ($homeSlider->slider->all() as $key => $slide)
            @php
                if (empty($slide->active) || !$slide->hasMedia('image')) {
                    continue;
                }
                $image = $slide->getFirstMedia('image');
                $attrs = [];
                $attrs['class'] = 'd-block w-100';
                $attrs['alt'] = !empty($slide->title) ? $slide->title : ($slide->label ? $slide->label : '');
                if (!is_null($image->getCustomProperty('crop.width'))) {
                    $attrs['width'] = $image->getCustomProperty('crop.width');
                }
                if (!is_null($image->getCustomProperty('crop.height'))) {
                    $attrs['height'] = $image->getCustomProperty('crop.height');
                }
            @endphp
            <div class="carousel-item {!! $key == 0 ? 'active' : '' !!}">
                {!! $image()->attributes($attrs)->lazy() !!}
                <div class="carousel-caption d-block">
                    @if(!empty($slide->title))<div class="slide-title">{!! $slide->title !!}</div>@endif
                    @if(!empty($slide->text))<p class="slide-text">{!! $slide->text !!}</p>@endif
                    @if (config('site.options.home-slider-has-button') && !empty($slide->label))
                        <a class="btn btn-custom home-slider-button" href="{!! $slide->href !!}">{!! $slide->label !!}</a>
                    @endif
                </div>
            </div>
        @endforeach
        </div>
        <a class="carousel-control-prev" href="#home-slider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
            <span class="sr-only">{!! __('Previous') !!}</span>
        </a>
        <a class="carousel-control-next" href="#home-slider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
            <span class="sr-only">{!! __('Next') !!}</span>
        </a>
    </div>

</div>
@endif

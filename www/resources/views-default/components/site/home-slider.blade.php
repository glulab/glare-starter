@if($homeSlider->slider->count() > 0)
<div class="home-slider {!! $class !!}">

    <div id="home-slider" class="carousel carousel-fade slide" data-ride="carousel" data-interval="5000">
        <ol class="carousel-indicators">
        @foreach ($homeSlider->slider->all() as $key => $slide)
            <li data-target="#home-slider" data-slide-to="{!! $key !!}" class="{!! $key == 0 ? 'active' : '' !!}"></li>
        @endforeach
        </ol>
        <div class="carousel-inner">
        @foreach ($homeSlider->slider->all() as $key => $slide)
            <div class="carousel-item {!! $key == 0 ? 'active' : '' !!}">
                <img src="{!! $slide->image->getUrl('xl') !!}" class="d-block w-100" alt="{!! $slide->title !!}">
                <div class="carousel-caption d-block">
                    {{-- <h5>{!! $slide->title !!}</h5> --}}
                    <p>{!! $slide->text !!}</p>
                </div>
            </div>
        @endforeach
        </div>
        <a class="carousel-control-prev" href="#home-slider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
            <span class="sr-only">Poprzedni</span>
        </a>
        <a class="carousel-control-next" href="#home-slider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
            <span class="sr-only">Następny</span>
        </a>
    </div>

</div>
@endif

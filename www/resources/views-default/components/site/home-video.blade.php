<div class="home-video">

    @if($availableVideos['video']['url'] !== false)
        <video loop="" muted="" autoplay="" class="home-video-video" poster="{!! asset('images/video.jpg') !!}">
            <source src="{!! $availableVideos['video']['url'] !!}" type="{!! $availableVideos['video']['type'] !!}">
        </video>
    @endif

    @if(config('site.options.home-video-has-responsive-sources'))
        @if($availableVideos['video-mobile']['url'] !== false)
            <video loop="" muted="" autoplay="" class="home-video-video is-mobile d-xl-none" poster="{!! asset('images/video.jpg') !!}">
                <source src="{!! $availableVideos['video']['url'] !!}" type="{!! $availableVideos['video']['type'] !!}">
            </video>
        @endif
        @if($availableVideos['video-desktop']['url'] !== false)
            <video loop="" muted="" autoplay="" class="home-video-video is-desktop d-none d-xl-block" poster="{!! asset('images/video.jpg') !!}">
                <source src="{!! $availableVideos['video']['url'] !!}" type="{!! $availableVideos['video']['type'] !!}">
            </video>
        @endif
    @endif

    <div class="home-video-body">
        <div class="container">
            <div class="home-video-inner">
                @if(config('site.options.home-video-has-title') && !empty($homeVideo->title))
                    <div class="home-video-title">{{ $homeVideo->title }}</div>
                @endif

                <x-site.line-splitter :text="$homeVideo->text ?? ''" class="home-video-text"/>

                @if (config('site.options.home-video-has-button') && !empty($homeVideo->label))
                    <a class="btn btn-custom home-video-button" href="{!! $homeVideo->href !!}">{!! $homeVideo->label !!}</a>
                @endif

            </div>
        </div>
    </div>
</div>

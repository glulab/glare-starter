<div class="home-video">

    @if($homeVideo->hasMedia('video_mobile'))
    <video loop="" muted="" autoplay="" class="home-video-video is-mobile d-xl-none">
        <source src="{!! $homeVideo->getFirstMedia('video_mobile')->originalUrl !!}" type="{!! $homeVideo->getFirstMedia('video_mobile')->mime_type !!}">
    </video>
    @else
    <video loop="" muted="" autoplay="" class="home-video-video is-mobile d-xl-none">
        <source src="{!! asset('storage/video/video-mobile.mp4') !!}" type="video/mp4">
    </video>
    @endif

    @if($homeVideo->hasMedia('video_desktop'))
    <video loop="" muted="" autoplay="" class="home-video-video is-desktop d-none d-xl-block mr-0 ml-auto">
        <source src="{!! $homeVideo->getFirstMedia('video_desktop')->originalUrl !!}" type="{!! $homeVideo->getFirstMedia('video_desktop')->mime_type !!}">
    </video>
    @else
    <video loop="" muted="" autoplay="" class="home-video-video is-desktop d-none d-xl-block mr-0 ml-auto">
        <source src="{!! asset('storage/video/video-desktop.mp4') !!}" type="video/mp4">
    </video>
    @endif

    <div class="home-video-body">
        <div class="container">
            <div class="home-video-inner">
                @if (isset($homeVideo->lines))
                    <div class="home-video-lines">
                        @foreach($homeVideo->lines as $key => $line)
                            <div class="home-video-line is-{!! $key + 1 !!}">{!! $line !!}</div>
                        @endforeach
                    </div>
                @else
                    <div class="home-video-text">{{ $homeVideo->text }}</div>
                @endif

                {{-- <div class="home-video-text">{{ $homeVideo->text }}</div> --}}
                {{-- <a class="btn btn-primary video-button" href="{!! $homeVideo->text !!}" class="btn btn-primary">{!! $homeVideo->label !!}</a> --}}

            </div>
        </div>
    </div>
</div>

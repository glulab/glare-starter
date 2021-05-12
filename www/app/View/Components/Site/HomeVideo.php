<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;
use Ignite\Support\Facades\Form;

class HomeVideo extends Component
{
    public $homeVideo;
    public $availableVideos;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        if (!config('site.services.home-video')) {
            return '';
        }

        $this->homeVideo = Form::load('home', 'home_video');

        if (!config('site.services.home-video') || empty($this->homeVideo->active)) {
            return '';
        }

        $this->availableVideos = [
            'video' => [
                'url' => false,
                'type' => false,
            ],
            'video-desktop' => [
                'url' => false,
                'type' => false,
            ],
            'video-mobile' => [
                'url' => false,
                'type' => false,
            ],
        ];

        if (config('site.options.home-video-has-responsive-sources')) {
            if ($this->homeVideo->hasMedia('video_mobile')) {
                if (is_file($this->homeVideo->getFirstMedia('video_mobile')->getPath())) {
                    $this->availableVideos['video-mobile']['url'] = $this->homeVideo->getFirstMedia('video_mobile')->originalUrl;
                    $this->availableVideos['video-mobile']['type'] = $this->homeVideo->getFirstMedia('video-mobile')->mime_type;
                }
            } elseif (is_file(base_path('storage/video/video-mobile.mp4'))) {
                $this->availableVideos['video-mobile']['url'] = asset('storage/video/video-mobile.mp4');
                $this->availableVideos['video-mobile']['type'] = 'video/mp4';
            }

            if ($this->homeVideo->hasMedia('video_desktop')) {
                if (is_file($this->homeVideo->getFirstMedia('video_desktop')->getPath())) {
                    $this->availableVideos['video-desktop']['url'] = $this->homeVideo->getFirstMedia('video_desktop')->originalUrl;
                    $this->availableVideos['video-desktop']['type'] = $this->homeVideo->getFirstMedia('video-desktop')->mime_type;
                }
            } elseif (is_file(base_path('storage/video/video-desktop.mp4'))) {
                $this->availableVideos['video-desktop']['url'] = asset('storage/video/video-desktop.mp4');
                $this->availableVideos['video-desktop']['type'] = 'video/mp4';
            }
        } else {
            if ($this->homeVideo->hasMedia('video')) {
                if (is_file($this->homeVideo->getFirstMedia('video')->getPath())) {
                    $this->availableVideos['video']['url'] = $this->homeVideo->getFirstMedia('video')->originalUrl;
                    $this->availableVideos['video']['type'] = $this->homeVideo->getFirstMedia('video')->mime_type;
                }
            } elseif (is_file(base_path('storage/video/video.mp4'))) {
                $this->availableVideos['video']['url'] = asset('storage/video/video.mp4');
                $this->availableVideos['video']['type'] = 'video/mp4';
            }
        }

        if (!empty($this->homeVideo->url)) {
            $this->homeVideo->href = $this->homeVideo->url;
        } elseif(!empty($this->homeVideo->route)) {
            $this->homeVideo->href = $this->homeVideo->route->resolve();
        }

        return view('components.site.home-video')
            ->with('availableVideos', $this->availableVideos)
        ;
    }
}

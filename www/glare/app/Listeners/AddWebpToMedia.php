<?php

namespace Glare\Listeners;

use Logger;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAdded;

class AddWebpToMedia implements ShouldQueue
{
    use CreateWebp;

    public function handle(MediaHasBeenAdded $event)
    {
        Logger::setPrefix('AddWebpToMedia Listener: ');
        Logger::logStart('AddWebpToMedia');

        $mediaPath = storage_path("app/public/media/{$event->media->id}");

        $mFilePath = $mediaPath;
        $mFileName = $event->media->file_name;
        $mFile = $mFilePath . '/' . $mFileName;

        Logger::log('AddWebpToMedia Create webp for media file: ' . $mFile);
        $this->createWebp($mFile, $mFilePath);

        Logger::logEnd('AddWebpToMedia End');
        return true;
    }
}

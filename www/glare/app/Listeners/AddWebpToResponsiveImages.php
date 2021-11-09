<?php

namespace Glare\Listeners;

use Logger;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\MediaLibrary\ResponsiveImages\Events\ResponsiveImagesGenerated;

class AddWebpToResponsiveImages /* implements ShouldQueue */
{
    use CreateWebp;

    public function handle(ResponsiveImagesGenerated $event)
    {
        Logger::setPrefix('AddWebpToResponsiveImages Listener: ');
        Logger::logStart('AddWebpToResponsiveImages');

        $mediaPath = storage_path("app/public/media/{$event->media->id}");

        $rspFilePath = $mediaPath.'/responsive-images';
        // dont have a conversion name here so we don't know what file dd($event->media);
        // $rspFileName = $event->conversion->getConversionFile($event->media);
        $rspFile = $rspFilePath . '/' . $rspFileName;

        Logger::logEnd('AddWebpToResponsiveImages Create webp for conversion file: ' . $rspFile);
        $this->createWebp($rspFile, $rspFilePath);

        Logger::logEnd('AddWebpToResponsiveImages End');
        return true;
    }
}

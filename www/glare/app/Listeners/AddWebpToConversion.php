<?php

namespace Glare\Listeners;

use Logger;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\MediaLibrary\Conversions\Events\ConversionHasBeenCompleted;

class AddWebpToConversion implements ShouldQueue
{
    use CreateWebp;

    public function handle(ConversionHasBeenCompleted $event)
    {
        Logger::setPrefix('AddWebpToConversion Listener: ');
        Logger::logStart('AddWebpToConversion');

        $mediaPath = storage_path("app/public/media/{$event->media->id}");

        $cnvFilePath = $mediaPath.'/conversions';
        $cnvFileName = $event->conversion->getConversionFile($event->media);
        $cnvFile = $cnvFilePath . '/' . $cnvFileName;

        Logger::logEnd('AddWebpToConversion Create webp for conversion file: ' . $cnvFile);
        $this->createWebp($cnvFile, $cnvFilePath);


        // $cnvName = $event->conversion->getName();
        $respFiles = $event->media->responsive_images ?? []; // getResponsiveImageUrls($cnvName)

        $rspFilePath = $mediaPath.'/responsive-images';

        if (!empty($respFiles)) {
            foreach ($respFiles as $rspKey => $rspFormat) {
                if (!empty($rspFormat['urls'])) {
                    foreach ($rspFormat['urls'] as $rspFileName) {
                        $rspFile = $rspFilePath . '/' . $rspFileName;
                        // Logger::logEnd('AddWebpToConversion Create webp for responsive file: ' . $rspFile);
                        $this->createWebp($rspFile, $rspFilePath);
                    }
                }
            }
        }

        Logger::logEnd('AddWebpToConversion End');
        return true;
    }
}

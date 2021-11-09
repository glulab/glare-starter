<?php

namespace Glare\Listeners;

use Logger;
use Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAdded;

class SetMaxMediaDimensions
{
    // use CreateWebp;

    public function handle(MediaHasBeenAdded $event)
    {
        Logger::setPrefix('SetMaxMediaDimensions Listener: ');
        Logger::logStart('SetMaxMediaDimensions');

        $mediaPath = storage_path("app/public/media/{$event->media->id}");

        $mFilePath = $mediaPath;
        $mFileName = $event->media->file_name;
        $mFile = $mFilePath . '/' . $mFileName;

        // $dim = getimagesize($mFile);
        // if ($dim[0] <= 1920 && $dim[1] <= 1080) {
        //     Logger::log('SetMaxMediaDimensions Dimensions OK: ' . $mFile . ': ' . $dim[0] . 'x' . $dim[1]);
        //     return true;
        // }
        Logger::log('SetMaxMediaDimensions Limit Dimensions for: ' . $mFile);
        
        $this->limitMedia($mFile, $mFilePath);

        Logger::logEnd('SetMaxMediaDimensions End');
        return true;
    }

    public function limitMedia($sFile, $sFilePath)
    {
        if (!is_file($sFile)) {
            return true;
        }

        $dFileExt = pathinfo($sFile, PATHINFO_EXTENSION);
        $dFileName = pathinfo($sFile, PATHINFO_FILENAME) . '.' . $dFileExt;
        $dFile = $sFilePath . '/' . $dFileName;

        if (class_exists(\Image::class)) {
            \Logger::log('Create limited media using Intervention Image');
            $ii = \Image::make($sFile);
            $ii->resize(4096, 2160, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $ii->save($dFile, 90, $dFileExt);
        } else {
            // $this->createWebpPph($sFile, $dFile, $quality = 70);
        }
        return true;
    }
}

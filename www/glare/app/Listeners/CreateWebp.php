<?php

namespace Glare\Listeners;

trait CreateWebp
{
    public function createWebp($sFile, $sFilePath, $quality = 70)
    {
        if (!is_file($sFile)) {
            return true;
        }

        $dFileName = pathinfo($sFile, PATHINFO_FILENAME) . '.webp';
        $dFile = $sFilePath . '/' . $dFileName;

        if (class_exists(\Image::class)) {
            \Logger::log('Create Webp using Intervention Image: ' . $dFile);
            \Image::make($sFile)/* ->encode('webp', 70) */->save($dFile, 70, 'webp');
        } else {
            $this->createWebpPph($sFile, $dFile, $quality = 70);
        }
    }

    public function createWebpPph($sFile, $dFile, $quality = 70)
    {
        \Logger::log('Create Webp using PHP: ' . $dFile);

        $sExt = strtolower(pathinfo($sFile, PATHINFO_EXTENSION));

        if ($sExt == 'jpg' || $sExt == 'jpeg') {
            $gdImage = imagecreatefromjpeg($sFile);
        }

        if ($sExt == 'png') {
            $gdImage = imagecreatefrompng($sFile);
        }

        if (empty($gdImage)) {
            return true;
        }

        imagepalettetotruecolor($gdImage);
        imagealphablending($gdImage, true);
        imagesavealpha($gdImage, true);

        imagewebp($gdImage, $dFile, $quality);

        imagedestroy($gdImage);
    }
}

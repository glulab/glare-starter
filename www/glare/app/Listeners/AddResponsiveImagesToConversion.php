<?php

namespace Glare\Listeners;

use Logger;
use Spatie\Image\Manipulations;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\MediaLibrary\Conversions\Events\ConversionWillStart;

class AddResponsiveImagesToConversion /* implements ShouldQueue */ // if queued wont create responsives to conversions
{
    public function __construct()
    {
        //
    }

    public function handle(ConversionWillStart $event)
    {
        // set_time_limit(-1);

        // Logger::setPrefix('AddResponsiveImagesToConversion Listener: ');
        // Logger::logStart('AddResponsiveImagesToConversion');

        $models = [
            'Ignite\Crud\Models\Repeatable',
            'Ignite\Crud\Models\Form',
        ];

        if (true /* in_array($event->media->model_type, $models) */ && $event->conversion->getName() !== 'preview') {
            $event->conversion->withResponsiveImages();
        }

        // // doesnt work with keepOriginalImageFormat
        // $manipulations = new Manipulations([['filter' => 'sepia', 'format' => 'webp']]);
        // $event->conversion->setManipulations($manipulations);

        // Logger::logEnd('AddResponsiveImagesToConversion End');
        return true;
    }
}

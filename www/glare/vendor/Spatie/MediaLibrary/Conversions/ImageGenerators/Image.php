<?php

namespace Glare\Vendor\Spatie\MediaLibrary\Conversions\ImageGenerators;

use Illuminate\Support\Collection;
use Spatie\MediaLibrary\Conversions\Conversion;

class Image extends \Spatie\MediaLibrary\Conversions\ImageGenerators\ImageGenerator
{
    public function convert(string $path, Conversion $conversion = null): string
    {
        return $path;
    }

    public function requirementsAreInstalled(): bool
    {
        return true;
    }

    public function supportedExtensions(): Collection
    {
        return collect(['png', 'jpg', 'jpeg', 'gif', 'webp']); // ::: glare hack : do not remove :::
    }

    public function supportedMimeTypes(): Collection
    {
        return collect(['image/jpeg', 'image/gif', 'image/png', 'image/webp']); // ::: glare hack : do not remove :::
    }
}

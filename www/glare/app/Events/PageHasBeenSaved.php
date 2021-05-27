<?php

namespace Glare\Events;

use App\Models\Page;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PageHasBeenSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $page;

    public function __construct($page)
    {
        $this->page = $page;
    }
}

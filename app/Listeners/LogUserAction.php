<?php

namespace App\Listeners;

use App\Events\ActionExecuted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogUserAction
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(ActionExecuted $event)
    {
        Log::info($event->actionMessage);
    }
}
<?php

namespace App\Listeners;

use App\Events\MessageReceived;
use Illuminate\Support\Facades\Log;

class BroadcastMessage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageReceived $event): void
    {
        // sleep(5);
        Log::info(sprintf('[x] The message "%s" is broadcasted', $event->getMessage()));
    }
}

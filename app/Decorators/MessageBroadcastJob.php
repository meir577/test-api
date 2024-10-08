<?php

declare(strict_types= 1);

namespace App\Decorators;

use App\Events\MessageReceived;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MessageBroadcastJob extends JobDecorator implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        // sleep(5);
        $this->finished();
    }

    public function finished(): void
    {
        // $this->cjob->finished();
        event(new MessageReceived($this->getMessage()));
    }
}

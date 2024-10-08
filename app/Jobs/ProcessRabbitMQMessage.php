<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Decorators\Interfaces\JobDecoratorInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessRabbitMQMessage implements ShouldQueue, JobDecoratorInterface
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $message;

    /**
     * Create a new job instance.
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // sleep(5);
        $this->finished();
    }

    public function finished(): void
    {
        Log::info(' [x] Done processing the message "' . $this->message . '" ');
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}

<?php

declare(strict_types= 1);

namespace App\Decorators;

use App\Decorators\Interfaces\JobDecoratorInterface;

class JobDecorator implements JobDecoratorInterface
{
    protected JobDecoratorInterface $cjob;

    public function __construct(
        JobDecoratorInterface $job
    ) {  
        $this->cjob = $job;
    }

    public function finished(): void
    {
        $this->cjob->finished();
    }

    public function getMessage(): string
    {
        return $this->cjob->getMessage();
    }
}

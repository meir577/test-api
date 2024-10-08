<?php

declare(strict_types= 1);

namespace App\Decorators\Interfaces;

interface JobDecoratorInterface
{
    public function finished(): void;

    public function getMessage(): string;
}

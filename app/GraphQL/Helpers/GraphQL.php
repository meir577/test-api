<?php

declare(strict_types= 1);

namespace App\GraphQL\Helpers;

use GraphQL\Error\Error;

final class GraphQL
{
    public static function formatError(Error $e): array
    {
        return $e->getPrevious()->errors();
    }

    public static function handleErrors(array $errors): array
    {
        return [];
    }
}
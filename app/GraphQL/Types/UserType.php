<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'User type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'ID of the user',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Name of the user',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'Email of the user',
            ],
            // 'password' => [
            //     'type' => Type::string(),
            //     'description' => 'Password of the user',
            // ],
        ];
    }
}

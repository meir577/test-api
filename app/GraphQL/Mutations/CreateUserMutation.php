<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createUser',
        'description' => 'Mutation for user creation'
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type'=> Type::string(),
            ],
            'email' => [
                'email' => 'email',
                'type'=> Type::string(),
            ],
            'password' => [
                'password' => 'password',
                'type'=> Type::string(),
            ]
        ];
    }

    public function resolve($root, $args): User
    {
        $validation = Validator::make($args, [
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:100',
        ]);

        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        return User::create($args);
    }
}

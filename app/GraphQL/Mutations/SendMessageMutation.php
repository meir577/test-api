<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Decorators\MessageBroadcastJob;
use App\Jobs\ProcessRabbitMQMessage;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class SendMessageMutation extends Mutation
{
    protected $attributes = [
        'name' => 'sendMessage',
        'description' => 'Mutation for sending a message'
    ];

    public function type(): ObjectType
    {
        return new ObjectType([
            'name'=> 'Message Object',
            'fields' => [
                'message' => [
                    'type' => Type::string(),
                ],
                'sent' => [
                    'type' => Type::boolean(),
                ]
            ]
        ]);
    }

    public function args(): array
    {
        return [
            'message' => [
                'name' => 'message',
                'type' => Type::string(),
            ]
        ];
    }

    public function resolve($root, array $args)
    {
        $job = new ProcessRabbitMQMessage($args['message']);
        dispatch($job); // w/o decorator

        $decoratedJob = new MessageBroadcastJob($job);
        dispatch($decoratedJob); // with decorator

        return [
            'message'=> $args['message'],
            'sent' => true,
        ];
    }
}

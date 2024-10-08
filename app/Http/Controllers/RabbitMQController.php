<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessRabbitMQMessage;
use App\Services\RabbitMQService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RabbitMQController extends Controller
{
    public function sendMessage(Request $request): JsonResponse
    {
        // for ($i = 0; $i < 5; $i++) {
            ProcessRabbitMQMessage::dispatch($request->message);
        // }

        return response()->json(['message' => 'Message sent!']);
    }
}

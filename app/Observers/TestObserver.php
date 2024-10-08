<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class TestObserver
{
    public function created(User $user): void
    {
        Log::info('New user joined '. $user->toJson());
    }
}

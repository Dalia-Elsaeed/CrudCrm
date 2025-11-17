<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends AppServiceProvider
{
    public function boot(): void
    {
        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}

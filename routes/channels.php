<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('default', function ($user) {
    return true;
});

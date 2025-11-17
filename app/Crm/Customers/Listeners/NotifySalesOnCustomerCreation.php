<?php

namespace Crm\Customers\Listeners;

use Crm\Customers\Events\CustomerCreation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class NotifySalesOnCustomerCreation
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CustomerCreation $event): void
    {
        $customer = $event->getCustomer();
        
        Log::info("New customer created: " . $customer->name);
    }
}
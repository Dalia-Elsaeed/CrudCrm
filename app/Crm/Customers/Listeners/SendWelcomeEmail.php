<?php

namespace Crm\Customers\Listeners;

use Crm\Customers\Events\CustomerCreation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
{
    public function __construct()
    {
    }

    public function handle(CustomerCreation $event): void
    {
        $customer = $event->getCustomer();

        // إرسال بريد ترحيبي
        Log::info("Sending welcome email to: " . $customer->email);

        // يمكنك هنا إضافة كود إرسال البريد الإلكتروني
    }
}

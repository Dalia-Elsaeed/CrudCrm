<?php

namespace Crm\Customers\Events;  // ✅ إصلاح الـ namespace

use Crm\Customers\Models\Customer;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerCreation
{
    use Dispatchable, SerializesModels;

    public Customer $customer;  // ✅ خليها public

    /**
     * Create a new event instance.
     */
    public function __construct(Customer $customer) 
    {
        $this->customer = $customer; 
    }

    /**
     * Get customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }
}
<?php

namespace Crm\Customers\Repositories;

use Crm\Base\Repositories\Repository;
use Crm\Customers\Models\Customer;

class CustomerRepository extends Repository
{
    public function __construct(Customer $customer)
    {
        $this->setModel($customer);
    }
    // public function all()
    // {
    //     return $this->model->all();
    // }
}

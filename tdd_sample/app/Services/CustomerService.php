<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    public function getCustomers()
    {
        return Customer::query()->select(['id', 'name'])->get();
    }

    public function addCustomer($name)
    {
        $customer = new Customer();
        $customer->name = $name;
        $customer->save();
    }
}

<?php


namespace App\Http\Traits;


use App\Models\Customer;

trait CustomerTrait
{
    public $customer_id, $name, $email, $phone_no, $type;

    public function setCustomerData(Customer $customer)
    {
        $this->customer_id = $customer->id;
        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->phone_no = $customer->phone_no;
        $this->type = $customer->type;
    }
}

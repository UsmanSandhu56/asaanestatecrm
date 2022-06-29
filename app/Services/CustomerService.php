<?php


namespace App\Services;


use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerService
{
    public static function searchCustomer($search)
    {
        if (strlen($search) >= 5) {
            return Customer::userAgency()->phone($search)->get();
        }
        return collect();
    }

    public static function searchCustomerWithRequirements($search)
    {
        $customerPropertyRequirements = Customer::has('propertyRequirements')->with(['propertyRequirements' => function ($q) {
            $q->where('status_id', null);
        }]);
        if (strlen($search) >= 5) {
            return $customerPropertyRequirements->userAgency()->phone($search)->get();
        }
        return collect();
    }

    public static function searchCustomerWithProperties($search)
    {
        $customerProperty = Customer::has('properties')->with(['properties' => function ($q) {
            $q->where('status_id', null);
        }]);
        if (strlen($search) >= 5) {
            return $customerProperty->userAgency()->phone($search)->get();
        }
        return collect();
    }

    public static function checkPermission()
    {
        $customer = Customer::with(['agency', 'user']);
        if (auth()->user()->can('customer-all-list')) {
            return $customer->userAgency();
        }
        if (auth()->user()->can('customer-list')) {
            return $customer->userAgency()->where(['user_id' => auth()->id()]);
        }
        return abort(403);
    }

    public static function validation($data, $customer = null)
    {
        return Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['nullable', 'string', 'email', Rule::unique('customers')->ignore($customer)],
                'phone_no' => ['required', 'starts_with:03','max:11', 'min:11', Rule::unique('customers')->ignore($customer)],
                'type' => ['required'],
            ],
            ['phone_no.starts_with' => 'The :attribute must start with 03.']
        )->validate();
    }
}

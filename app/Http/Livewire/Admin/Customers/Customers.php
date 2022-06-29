<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Http\Traits\LoadMoreTrait;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Customers extends Component
{
    use AuthorizesRequests, LoadMoreTrait;

    public $data = [], $customerIdBeingRemoved = null, $showEditModal = false, $customer, $totalRecords;


    public function render()
    {
        $this->authorize('customer-list');
        $customers = CustomerService::checkPermission()->paginate($this->perPage);
        $this->totalRecords  = $customers->total();
        return view('livewire.admin.customers.customers', ['customers' => $customers]);
    }

    public function create()
    {
        $this->authorize('customer-create');
        $this->reset();
        $this->data['type'] = false;
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function store(CustomerService $customerService)
    {
        $this->authorize('customer-create');
        $validatedData = $customerService->validation($this->data);
        Customer::create($validatedData + ['user_id' => auth()->id(), 'agency_id' => session('agency_id')]);
        $this->dispatchBrowserEvent('hide-form', ['success' => 'Customer added successfully!']);
    }

    public function edit(Customer $customer)
    {
        $this->authorize('customer-edit');
        $this->reset();
        $this->showEditModal = true;
        $this->customer = $customer;
        $this->data = $customer->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function update(CustomerService $customerService)
    {
        $this->authorize('customer-edit');
        $validatedData = $customerService->validation($this->data, $this->customer);
        $this->customer->update($validatedData);
        $this->dispatchBrowserEvent('hide-form', ['success' => 'Customer updated successfully!']);
    }

    public function confirmCustomerRemoval(Customer $customer)
    {
        $this->customerIdBeingRemoved = $customer;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function destroy()
    {
        $this->authorize('customer-delete');
        DB::transaction(function () {
            $this->customerIdBeingRemoved->properties()->delete();
            $this->customerIdBeingRemoved->propertyRequirements()->delete();
            $this->customerIdBeingRemoved->delete();
        });
        $this->dispatchBrowserEvent('hide-delete-modal', ['success' => 'Customer deleted successfully!']);
    }
}

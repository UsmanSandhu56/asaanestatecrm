<?php

namespace App\Http\Livewire\Admin\Properties;

use App\Http\Livewire\Admin\Parents\DealsParent;
use App\Models\Property;
use App\Services\CustomerService;

class CloseDeal extends DealsParent
{
    public function render()
    {
        $this->authorize('closed-deal-create');
        $searchResults = CustomerService::searchCustomerWithRequirements($this->requirementSearch);
        return view('livewire.admin.properties.close-deal', ['searchResults' => $searchResults]);
    }

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->propertyPurpose = ($property->purpose === 0) ? 1 : 2;
    }
}

<?php

namespace App\Http\Livewire\Admin\PropertyRequirements;

use App\Http\Livewire\Admin\Parents\DealsParent;
use App\Models\PropertyRequirement;
use App\Services\CustomerService;

class CloseDeal extends DealsParent
{
    public function render()
    {
        $this->authorize('closed-deal-create');
        $searchResults = CustomerService::searchCustomerWithProperties($this->propertySearch);
        return view('livewire.admin.property-requirements.close-deal', ['searchResults' => $searchResults]);
    }

    public function mount(PropertyRequirement $propertyRequirement)
    {
        $this->propertyRequirement = $propertyRequirement;
        $this->propertyRequirementPurpose = ($propertyRequirement->purpose === 0) ? 3 : 4;
    }
}

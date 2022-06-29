<?php

namespace App\Http\Livewire\Admin\Deals;

use App\Http\Livewire\Admin\Parents\DealsParent;
use App\Services\CustomerService;

class Deals extends DealsParent
{
    public function render()
    {
        $this->authorize('closed-deal-create');
        $propertySearchResults = CustomerService::searchCustomerWithProperties($this->propertySearch);
        $requirementSearchResults = CustomerService::searchCustomerWithRequirements($this->requirementSearch);
        return view('livewire.admin.deals.deals', ['propertySearchResults' => $propertySearchResults, 'requirementSearchResults' => $requirementSearchResults]);
    }
}

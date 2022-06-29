<?php

namespace App\Http\Livewire\Admin\Deals;

use App\Models\PropertyDeal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ConfirmDeal extends Component
{
    use AuthorizesRequests;

    public $propertyDeal, $propertyPurpose, $propertyRequirementPurpose;

    public function render()
    {
        $this->authorize('closed-deal-create');
        return view('livewire.admin.deals.confirm-deal');
    }

    public function mount(PropertyDeal $propertyDeal)
    {
        $this->propertyDeal = $propertyDeal;
        $this->propertyPurpose = ($propertyDeal->property->purpose === 0) ? 1 : 2;
        $this->propertyRequirementPurpose = ($propertyDeal->propertyRequirement->purpose === 0) ? 3 : 4;
    }

    public function store()
    {
        $this->authorize('closed-deal-create');
        $this->propertyDeal->update(['is_confirmed' => true]);
        $this->propertyDeal->property()->update(['status_id' => $this->propertyPurpose]);
        $this->propertyDeal->propertyRequirement()->update(['status_id' => $this->propertyRequirementPurpose]);
        sleep(3);
        return redirect()->route('deals');
    }
}

<?php

namespace App\Http\Livewire\Admin\Parents;

use App\Models\Property;
use App\Models\PropertyRequirement;
use App\Services\DealsService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class DealsParent extends Component
{
    use AuthorizesRequests;

    public $propertyRequirement = null, $requirementSearch = '', $property = null, $propertySearch = '',
        $agent_commission, $amount, $agency_commission, $commission = null;

    public function store()
    {
        $this->authorize('closed-deal-create');
        $validatedData = $this->validate();
        $propertyDeal = DealsService::deals($validatedData);
        return redirect()->route('confirm-deal', ['propertyDeal' => $propertyDeal]);
    }

    public function updatedCommission()
    {
        $this->agent_commission = DealsService::agentCommissions($this->commission);
    }

    public function setProperty(Property $property)
    {
        $this->property = $property;
        $this->propertySearch = '';
    }

    public function setPropertyRequirement(PropertyRequirement $propertyRequirement)
    {
        $this->propertyRequirement = $propertyRequirement;
        $this->requirementSearch = '';
    }

    protected function rules()
    {
        return DealsService::validation();
    }

    protected $messages = [
        'propertyRequirement.required' => 'Please select a property requirement.',
        'property.required' => 'Please select a property.',
    ];
}

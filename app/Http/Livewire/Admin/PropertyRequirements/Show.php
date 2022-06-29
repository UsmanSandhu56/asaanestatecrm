<?php

namespace App\Http\Livewire\Admin\PropertyRequirements;

use App\Models\PropertyRequirement;
use Livewire\Component;

class Show extends Component
{
    public $propertyRequirement;

    public function render()
    {
        return view('livewire.admin.property-requirements.show');
    }

    public function mount(PropertyRequirement $propertyRequirement)
    {
        $this->propertyRequirement = $propertyRequirement;
    }
}

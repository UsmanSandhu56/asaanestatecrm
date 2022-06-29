<?php

namespace App\Http\Livewire\Admin\Properties;

use App\Models\Property;
use Livewire\Component;

class Show extends Component
{
    public $property;

    public function render()
    {
        return view('livewire.admin.properties.show');
    }

    public function mount(Property $property)
    {
        $this->property = $property;
    }
}

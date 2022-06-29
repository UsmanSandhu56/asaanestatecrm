<?php

namespace App\Http\Livewire\Admin\Parents;

use App\Http\Traits\CustomerTrait;
use App\Http\Traits\StepTrait;
use App\Http\Traits\SubCategoryTrait;
use App\Services\AreaUnitService;
use App\Services\PropertyService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class PropertyParent extends Component
{
    use WithFileUploads, StepTrait, SubCategoryTrait, CustomerTrait, AuthorizesRequests;

    public $property, $categories, $urgency, $category, $city, $location, $street_address, $latitude, $longitude, $sublocality_level_1, $sublocality_level_2, $sublocality_level_3, $search = '',
        $amenities = [], $amenity_id = [], $statuses,
        $title, $description, $price, $area, $unit_id, $rooms, $bathrooms, $parking_space, $year_build,
        $show = true, $units, $areaUnit,
        $photos = [], $videos = [], $documents = [];


    public function updatedAreaUnit($areaUnit)
    {
        $this->unit_id = $areaUnit;
        $this->areaUnit = AreaUnitService::setAreaUnit($areaUnit);
    }

    protected function rules()
    {
        return PropertyService::validation($this->customer_id, $this->category_id, $this->currentStep);
    }

    protected $messages = [
        'customer_id.required' => 'The customer field is required.',
        'category_id.required' => 'The Property Type is required.',
        'sub_category_id.required' => 'The Plot Details field is required.',
        'phone_no.starts_with' => ' The :attribute must start with 03.',
    ];
}

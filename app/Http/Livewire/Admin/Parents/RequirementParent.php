<?php

namespace App\Http\Livewire\Admin\Parents;

use App\Http\Traits\AreaTrait;
use App\Http\Traits\CustomerTrait;
use App\Http\Traits\PriceTrait;
use App\Http\Traits\StepTrait;
use App\Http\Traits\SubCategoryTrait;
use App\Services\PropertyRequirementService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class RequirementParent extends Component
{
    use PriceTrait, AreaTrait, StepTrait, SubCategoryTrait, CustomerTrait, AuthorizesRequests;

    public $propertyRequirement, $categories, $urgency, $category, $is_serious = false, $city, $location, $latitude, $longitude, $sublocality_level_1, $sublocality_level_2, $sublocality_level_3, $search = '',
        $amenities = [], $amenity_id = [], $statuses,
        $title, $description, $min_price, $max_price, $min_area, $max_area, $unit_id, $min_rooms, $max_rooms, $min_bathrooms, $max_bathrooms, $parking_space, $year_build,
        $show = true, $units, $areaUnit;

    protected function rules()
    {
        return PropertyRequirementService::validation($this->category_id, $this->customer_id, $this->currentStep);
    }

    protected $messages = [
        'customer_id.required' => 'The customer field is required.',
        'category_id.required' => 'The Property Type is required.',
        'sub_category_id.required' => 'The Plot Details field is required.',
        'phone_no.starts_with' => 'The :attribute must start with 03.'
    ];
}

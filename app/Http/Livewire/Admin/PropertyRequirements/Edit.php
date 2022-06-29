<?php

namespace App\Http\Livewire\Admin\PropertyRequirements;

use App\Http\Livewire\Admin\Parents\RequirementParent;
use App\Models\Amenity;
use App\Models\AreaUnit;
use App\Models\Category;
use App\Models\PropertyRequirement;
use App\Models\Status;
use App\Services\AreaUnitService;
use App\Services\CustomerService;
use App\Services\PropertyRequirementService;

class Edit extends RequirementParent
{
    public function render()
    {
        $this->authorize('property-requirement-edit');
        // dd($this->search);

        $searchResults = CustomerService::searchCustomer($this->search);
        return view('livewire.admin.property-requirements.edit', ['searchResults' => $searchResults]);
    }

    public function mount(PropertyRequirement $propertyRequirement)
    {
        $this->currentStep = 1;
        $this->totalSteps = 4;
        $this->categories = Category::all();
        $this->units = AreaUnit::all();
        $this->statuses = Status::whereIn('id', [5, 6])->get();
        $this->amenities = Amenity::all();
        $this->unit_id = $propertyRequirement->unit_id;
        $this->areaUnit = 'Marla';
        $this->propertyRequirement = $propertyRequirement;
        ($propertyRequirement->category_id !== 1) ? $this->show = false : $this->show = true;
        $this->purpose = $propertyRequirement->purpose;
        $this->title = $propertyRequirement->title;
        $this->min_price = $propertyRequirement->min_price;
        $this->max_price = $propertyRequirement->max_price;
        $this->is_serious = $propertyRequirement->is_serious;
        $this->description = $propertyRequirement->description;
        $this->urgency = $propertyRequirement->urgency;
        $this->category_id = $propertyRequirement->category_id;
        $this->getSubcategories($this->category_id);
        $this->min_rooms = $propertyRequirement->propertyRequirementDetail->min_rooms;
        $this->max_rooms = $propertyRequirement->propertyRequirementDetail->max_rooms;
        $this->min_bathrooms = $propertyRequirement->propertyRequirementDetail->min_bathrooms;
        $this->max_bathrooms = $propertyRequirement->propertyRequirementDetail->max_bathrooms;
        $this->parking_space = $propertyRequirement->propertyRequirementDetail->parking_space;
        $this->year_build = $propertyRequirement->propertyRequirementDetail->year_build;
        $this->city = $propertyRequirement->propertyRequirementDetail->city;
        $this->location = $propertyRequirement->propertyRequirementDetail->location;
        $this->latitude = $propertyRequirement->propertyRequirementDetail->latitude;
        $this->longitude = $propertyRequirement->propertyRequirementDetail->longitude;
        $this->sublocality_level_1 = $propertyRequirement->propertyRequirementDetail->sublocality_level_1;
        $this->sublocality_level_2 = $propertyRequirement->propertyRequirementDetail->sublocality_level_2;
        $this->sublocality_level_3 = $propertyRequirement->propertyRequirementDetail->sublocality_level_3;
        $this->amenity_id = array_map('strval', $propertyRequirement->amenities->pluck('id')->all());
        $this->name = $propertyRequirement->customer->name;
        $this->type = $propertyRequirement->customer->type;
        $this->email = $propertyRequirement->customer->email;
        $this->phone_no = $propertyRequirement->customer->phone_no;
        $this->customer_id = $propertyRequirement->customer->id;

        $this->updatedAreaUnit($propertyRequirement->unit_id ?? '1');
        $area = ['min_area' => $propertyRequirement->min_area, 'max_area' => $propertyRequirement->max_area, 'unit_id' => $propertyRequirement->unit_id];
        $area = AreaUnitService::editPropertyRequirementAreaUnitConversation($area);

        $this->min_area = $area['min_area'] ? number_format($area['min_area'],2): $area['min_area'];
        $this->min_area = str_replace( ',', '', $this->min_area );
        
        $this->max_area = $area['max_area'] ? number_format($area['max_area'],2): $area['max_area'];
        $this->max_area = str_replace( ',', '', $this->max_area );

       
        $this->setPrices();
    }

    public function update()
    {
        $this->authorize('property-requirement-edit');
        $this->validate();
        PropertyRequirementService::update($this->propertyRequirement, $this->min_area, $this->max_area, $this->is_serious, $this->unit_id,
            $this->customer_id, $this->name, $this->email, $this->phone_no, $this->type, $this->max_rooms, $this->min_rooms,
            $this->parking_space, $this->year_build, $this->max_bathrooms, $this->min_bathrooms, $this->location, $this->city,
            $this->sublocality_level_1, $this->sublocality_level_2, $this->sublocality_level_3, $this->latitude, $this->longitude,
            $this->title, $this->description, $this->urgency, $this->purpose, $this->max_price, $this->min_price, $this->category_id,
            $this->sub_category_id, $this->amenity_id);
        return redirect()->route('property-requirements')->with('success', 'Property Requirement updated successfully!');
    }
}

<?php

namespace App\Http\Livewire\Admin\Properties;

use App\Http\Livewire\Admin\Parents\PropertyParent;
use App\Models\Amenity;
use App\Models\AreaUnit;
use App\Models\Category;
use App\Models\Property;
use App\Models\Status;
use App\Services\AreaUnitService;
use App\Services\CustomerService;
use App\Services\PropertyService;

class Edit extends PropertyParent
{
    public function render()
    {
        
        $this->authorize('property-edit');
        $searchResults = CustomerService::searchCustomer($this->search);

        return view('livewire.admin.properties.edit', ['searchResults' => $searchResults]);
    }

    public function mount(Property $property )
    {
        $this->currentStep = 1;
        $this->totalSteps = 6;
        $this->categories = Category::all();
        $this->units = AreaUnit::all();
        $this->statuses = Status::whereIn('id', [1, 2])->get();
        $this->amenities = Amenity::all();
        $this->property = $property;
        ($property->category_id !== 1) ? $this->show = false : $this->show = true;
        $this->purpose = $property->purpose;
        $this->title = $property->title;
        $this->video_url = $property->video_url;
        $this->price = $property->price;
        $this->description = $property->description;
        $this->urgency = $property->urgency;
        $this->category_id = $property->category_id;
        $this->getSubcategories($this->category_id);
        $this->rooms = isset($property->propertyDetail) ? $property->propertyDetail->rooms : '';
        $this->bathrooms = isset($property->propertyDetail) ? $property->propertyDetail->bathrooms : '';
        $this->parking_space = isset($property->propertyDetail) ? $property->propertyDetail->parking_space : '';
        $this->year_build = isset($property->propertyDetail) ? $property->propertyDetail->year_build : '';
        $this->city = $property->address->city;
        $this->location = $property->address->location;
        $this->street_address = $property->address->street_address;
        $this->latitude = $property->address->latitude;
        $this->longitude = $property->address->longitude;
        $this->sublocality_level_1 = $property->address->sublocality_level_1;
        $this->sublocality_level_2 = $property->address->sublocality_level_2;
        $this->sublocality_level_3 = $property->address->sublocality_level_3;
        $this->amenity_id = array_map('strval', $property->amenities->pluck('id')->all());
        $this->name = $property->customer->name;
        $this->type = $property->customer->type;
        $this->email = $property->customer->email;
        $this->phone_no = $property->customer->phone_no;
        $this->customer_id = $property->customer->id;
        $this->updatedAreaUnit($property->unit_id);
        $data = ['area' => $property->area, 'unit_id' => $property->unit_id];
        $area = AreaUnitService::editPropertyAreaUnitConversation($data);
      

        $this->area = $area ? number_format($area,2): $area;
        $this->area = str_replace( ',', '', $area );

    }

    public function update()
    {
        $this->authorize('property-edit');
        $this->validate();
        PropertyService::update($this->property, $this->area, $this->unit_id,
            $this->customer_id, $this->name, $this->email, $this->phone_no, $this->type, $this->street_address, $this->location,
            $this->city, $this->sublocality_level_1, $this->sublocality_level_2, $this->sublocality_level_3, $this->latitude, $this->longitude,
            $this->category_id, $this->rooms, $this->bathrooms, $this->parking_space, $this->year_build, $this->title, $this->description, $this->urgency, $this->purpose, $this->price, $this->sub_category_id,
            $this->amenity_id, $this->photos, $this->video_url, $this->documents);
        return redirect()->route('properties')->with('success', 'Property updated successfully!');
    }
}


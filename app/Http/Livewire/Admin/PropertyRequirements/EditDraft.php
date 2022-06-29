<?php

namespace App\Http\Livewire\Admin\PropertyRequirements;

use App\Models\Status;
use App\Models\Amenity;
use Livewire\Component;
use App\Models\AreaUnit;
use App\Models\Category;
use App\Services\AreaUnitService;
use App\Services\CustomerService;
use App\Models\PropertyRequirementDraft;
use App\Services\PropertyRequirementService;
use App\Models\PropertyRequirementDetailDraft;
use App\Http\Livewire\Admin\Parents\RequirementParent;

class EditDraft extends RequirementParent
{
    public function render()
    {
        $this->authorize('property-requirement-edit');
        $searchResults = CustomerService::searchCustomer($this->search);
        return view('livewire.admin.property-requirements.edit-draft', ['searchResults' => $searchResults]);
    }

    public function mount(PropertyRequirementDraft $propertyRequirement)
    {
        $this->currentStep = 1;
        $this->totalSteps = 4;
        $this->categories = Category::all();
        $this->units = AreaUnit::all();
        $this->type = false;
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
        if($propertyRequirement->propertyRequirementDetaildraft)
        {
        $this->min_rooms = $propertyRequirement->propertyRequirementDetaildraft->min_rooms;
        $this->max_rooms = $propertyRequirement->propertyRequirementDetaildraft->max_rooms;
        $this->min_bathrooms = $propertyRequirement->propertyRequirementDetaildraft->min_bathrooms;
        $this->max_bathrooms = $propertyRequirement->propertyRequirementDetaildraft->max_bathrooms;
        $this->parking_space = $propertyRequirement->propertyRequirementDetaildraft->parking_space;
        $this->year_build = $propertyRequirement->propertyRequirementDetaildraft->year_build;
        $this->city = $propertyRequirement->propertyRequirementDetaildraft->city;
        $this->location = $propertyRequirement->propertyRequirementDetaildraft->location;
        $this->latitude = $propertyRequirement->propertyRequirementDetaildraft->latitude;
        $this->longitude = $propertyRequirement->propertyRequirementDetaildraft->longitude;
        $this->sublocality_level_1 = $propertyRequirement->propertyRequirementDetaildraft->sublocality_level_1;
        $this->sublocality_level_2 = $propertyRequirement->propertyRequirementDetaildraft->sublocality_level_2;
        $this->sublocality_level_3 = $propertyRequirement->propertyRequirementDetaildraft->sublocality_level_3;
        }
        if($propertyRequirement->customer)
        {
        $this->name = $propertyRequirement->customer->name;
        $this->type = $propertyRequirement->customer->type;
        $this->email = $propertyRequirement->customer->email;
        $this->phone_no = $propertyRequirement->customer->phone_no;
        $this->customer_id = $propertyRequirement->customer->id;
        }
        $this->updatedAreaUnit($propertyRequirement->unit_id ?? '1');
        $area = ['min_area' => $propertyRequirement->min_area, 'max_area' => $propertyRequirement->max_area, 'unit_id' => $propertyRequirement->unit_id];
        $area = AreaUnitService::editPropertyRequirementAreaUnitConversation($area);

        $this->min_area = $area['min_area'] ? number_format($area['min_area'],2): $area['min_area'];
        $this->min_area = str_replace( ',', '', $this->min_area );
        
        $this->max_area = $area['max_area'] ? number_format($area['max_area'],2): $area['max_area'];
        $this->max_area = str_replace( ',', '', $this->max_area );
        
        $this->setPrices();
    }

    public function editpropertyreqdraft($currentStep, $id)
    {
        
        $this->authorize('property-create');
        $this->validate();
        $this->resetErrorBag();
        
        $this->currentStep++;
        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
        
        $editpropertydraft = PropertyRequirementDraft::find($id);
        if(isset($this->purpose))
        {
            $editpropertydraft->purpose = $this->purpose;
        }
        if(isset($this->unit_id))
        {
            $editpropertydraft->unit_id = $this->unit_id;
        }
        
        if(isset($this->category_id))
        {
            $editpropertydraft->category_id = $this->category_id;
        }
        if(isset($this->sub_category_id))
        {
            $editpropertydraft->sub_category_id = $this->sub_category_id;
        }
        if(isset($this->urgency))
        {
            $editpropertydraft->urgency = $this->urgency;
        }
        if(isset($this->is_serious))
        {
            $editpropertydraft->is_serious = $this->is_serious;
        }

        if(isset($this->location))
        {
         
            $findaddress =  PropertyRequirementDetailDraft::find($editpropertydraft->property_requirement_detail_id);

           if($findaddress== null)
           {
            $findaddress = new PropertyRequirementDetailDraft;
            $findaddress->location = $this->location;

            if(isset($this->city))
            {
            $findaddress->city = $this->city;
            }
            if(isset($this->min_rooms))
            {
            $findaddress->min_rooms = $this->min_rooms;
            }
            if(isset($this->max_rooms))
            {
            $findaddress->max_rooms = $this->max_rooms;
            }
            if(isset($this->min_bathrooms))
            {
            $findaddress->min_bathrooms = $this->min_bathrooms;
            }
            if(isset($this->max_bathrooms))
            {
            $findaddress->max_bathrooms = $this->max_bathrooms;
            }
            if(isset($this->parking_space))
            {
            $findaddress->parking_space = $this->parking_space;
            }
            
            if(isset($this->year_build))
            {
            $findaddress->year_build = $this->year_build;
            }
            
            $findaddress->save();
            $editpropertydraft->property_requirement_detail_id =  $findaddress->id;

           }
           else{
           
            $findaddress->location = $this->location;

            if(isset($this->city))
            {
            $findaddress->city = $this->city;
            } 
            if(isset($this->min_rooms))
            {
            $findaddress->min_rooms = $this->min_rooms;
            }
            if(isset($this->max_rooms))
            {
            $findaddress->max_rooms = $this->max_rooms;
            }
            if(isset($this->min_bathrooms))
            {
            $findaddress->min_bathrooms = $this->min_bathrooms;
            }
            if(isset($this->max_bathrooms))
            {
            $findaddress->max_bathrooms = $this->max_bathrooms;
            }
            if(isset($this->parking_space))
            {
            $findaddress->parking_space = $this->parking_space;
            }
            
            if(isset($this->year_build))
            {
            $findaddress->year_build = $this->year_build;
            }
            
            
            $findaddress->update();
        }
        }
        if(isset($this->title))
        {
            $editpropertydraft->title = $this->title;
        }
      
        if(isset($this->description))
        {
            $editpropertydraft->description = $this->description;
        }
        $findarea = PropertyRequirementDraft::where('min_area',$this->min_area)
        ->where('max_area',$this->max_area)
        ->where('id',$id)
        ->where('unit_id',$this->unit_id)
        ->first();
 
        if($findarea==null)
        {
        $area = ['min_area' =>  $this->min_area, 'max_area' =>  $this->max_area, 'unit_id' =>  $this->unit_id];
       
        $area = AreaUnitService::propertyRequirementAreaUnitConversation($area);
        $editpropertydraft->min_area = $area['min_area'];
        $editpropertydraft->max_area = $area['max_area'];
        }
        
         if(isset($this->max_price))
        {
            $editpropertydraft->max_price = $this->max_price;
        }
         if(isset($this->min_price))
        {
            $editpropertydraft->min_price = $this->min_price;
        }
        $editpropertydraft->update();
        

    }

    public function store($id)
    {
      
        $this->authorize('property-requirement-create');
        $this->validate();
        $propertyRequirement = PropertyRequirementDraft::store($id,$this->min_area, $this->max_area, $this->is_serious, $this->unit_id,
            $this->customer_id, $this->name, $this->email, $this->phone_no, $this->type, $this->max_rooms, $this->min_rooms,
            $this->parking_space, $this->year_build, $this->max_bathrooms, $this->min_bathrooms, $this->location, $this->city,
            $this->sublocality_level_1, $this->sublocality_level_2, $this->sublocality_level_3, $this->latitude, $this->longitude,
            $this->title, $this->description, $this->urgency, $this->purpose, $this->max_price, $this->min_price, $this->category_id,
            $this->sub_category_id, $this->amenity_id);
        return redirect()->route('property-requirements.matches', $propertyRequirement)->with('success', 'Property Requirement added successfully!');
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

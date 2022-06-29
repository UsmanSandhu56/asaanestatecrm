<?php

namespace App\Http\Livewire\Admin\PropertyRequirements;

use App\Models\Status;
use App\Models\Amenity;
use App\Models\AreaUnit;
use App\Models\Category;
use App\Services\CustomerService;
use Illuminate\Support\Facades\Session;
use App\Models\PropertyRequirementDraft;
use App\Services\PropertyRequirementService;
use App\Http\Livewire\Admin\Parents\RequirementParent;

class Create extends RequirementParent
{
    public function render()
    {
        $this->authorize('property-requirement-list');
        $searchResults = CustomerService::searchCustomer($this->search);
        return view('livewire.admin.property-requirements.create', ['searchResults' => $searchResults]);
    }

    public function mount()
    {
    Session::put('req-create-id', '1');

        $this->currentStep = 1;
        $this->totalSteps = 4;
        $this->type = false;
        $this->urgency = 0;
        $this->unit_id = 4;
        $this->areaUnit = 'Marla';
        $this->categories = Category::all();
        $this->subCategories = collect();
        $this->units = AreaUnit::all();
        $this->statuses = Status::whereIn('id', [5, 6])->get();
        $this->amenities = Amenity::all();
        $this->updatedAreaUnit('4');
        $this->setPrices();
    }

    public function store()
    {
        $this->authorize('property-requirement-create');
        $this->validate();
        $propertyRequirement = PropertyRequirementService::store($this->min_area, $this->max_area, $this->is_serious, $this->unit_id,
            $this->customer_id, $this->name, $this->email, $this->phone_no, $this->type, $this->max_rooms, $this->min_rooms,
            $this->parking_space, $this->year_build, $this->max_bathrooms, $this->min_bathrooms, $this->location, $this->city,
            $this->sublocality_level_1, $this->sublocality_level_2, $this->sublocality_level_3, $this->latitude, $this->longitude,
            $this->title, $this->description, $this->urgency, $this->purpose, $this->max_price, $this->min_price, $this->category_id,
            $this->sub_category_id, $this->amenity_id);
        return redirect()->route('property-requirements.matches', $propertyRequirement)->with('success', 'Property Requirement added successfully!');
    }
    public function resetcategorys($currentStep)
    {
 
        $this->authorize('property-create');
        $this->validate();
        $this->resetErrorBag();
        $this->validate();
        $this->currentStep++;
        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
        $parameter = array(
          'min_area'=>$this->min_area,
          'max_area'=>$this->max_area,
          'is_serious'=>$this->is_serious,
          'unit_id'=>$this->unit_id,
          'customer_id'=>$this->customer_id,
          'name'=>$this->name,
          'email'=>$this->email,
          'phone_no'=>$this->phone_no,
          'type'=>$this->type,
          'max_rooms'=>$this->max_rooms,
          'min_rooms'=>$this->min_rooms,
          'parking_space'=>$this->parking_space,
          'year_build'=>$this->year_build,
          'max_bathrooms'=>$this->max_bathrooms,
          'min_bathrooms'=>$this->min_bathrooms,
          'location'=>$this->location,
          'city'=>$this->city,
          'sublocality_level_1'=>$this->sublocality_level_1,
          'sublocality_level_2'=>$this->sublocality_level_2,
          'sublocality_level_3'=>$this->sublocality_level_3,
          'latitude'=>$this->latitude,
          'longitude'=>$this->longitude,
          'title'=>$this->title,
          'description'=>$this->description,
          'urgency'=>$this->urgency,
          'purpose'=>$this->purpose,
          'max_price'=>$this->max_price,
          'min_price'=>$this->min_price,
          'category_id'=>$this->category_id,
          'sub_category_id'=>$this->sub_category_id,
          'amenity_id'=>$this->amenity_id, 


        );
        if($currentStep=='1')
        {
        
            $parameter['pagedata'] = "1";

            $propertyRequirement = PropertyRequirementDraft::storenextpagethree($parameter);

        }
        
        if($currentStep=='2')
        {
            $parameter['pagedata']= "2";
            $propertyRequirement = PropertyRequirementDraft::storenextpagethree($parameter);

        }
        if($currentStep=='3')
        {
            $parameter['pagedata']= "3";
            $propertyRequirement = PropertyRequirementDraft::storenextpagethree($parameter);

        }
        if($currentStep=='4')
        {
            $parameter['pagedata']= "4";
            $propertyRequirement = PropertyRequirementDraft::storenextpagethree($parameter);

        }
      
    }
}

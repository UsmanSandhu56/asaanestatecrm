<?php

namespace App\Http\Livewire\Admin\Properties;

use App\Models\Status;
use App\Models\Amenity;
use App\Models\AreaUnit;
use App\Models\Category;
use App\Models\PropertyDraft;
use App\Services\CustomerService;
use App\Services\PropertyService;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Livewire\Admin\Parents\PropertyParent;

class Create extends PropertyParent
{
    public $draft;
    protected $parameter = [];
    public function render()
    {

        $this->authorize('property-create');
        $searchResults = CustomerService::searchCustomer($this->search);
        return view('livewire.admin.properties.create', ['searchResults' => $searchResults]);
    }

    public function mount()
    {
        Session::put('create-id','1');
        $this->currentStep = 1;
        $this->totalSteps = 6;
        $this->type = false;
        $this->urgency = 0;
        $this->categories = Category::all();
        $this->subCategories = collect();
        $this->units = AreaUnit::all();
        $this->statuses = Status::whereIn('id', [1, 2])->get();
        $this->amenities = Amenity::all();


        $this->updatedAreaUnit('4');
    }

    public $amenity_id = [];

    public function store()
    {
        $this->authorize('property-create');
        $this->validate();
        $property = PropertyService::store($this->area, $this->unit_id,
            $this->customer_id, $this->name, $this->email, $this->phone_no, $this->type, $this->street_address, $this->location,
            $this->city, $this->sublocality_level_1, $this->sublocality_level_2, $this->sublocality_level_3, $this->latitude, $this->longitude,
            $this->category_id, $this->rooms, $this->bathrooms, $this->parking_space, $this->year_build, $this->title, $this->description, $this->urgency, $this->purpose, $this->price, $this->sub_category_id,
            $this->amenity_id, $this->photos, $this->videos, $this->documents);
        return redirect()->route('properties.matches', $property)->with('success', 'Property added successfully!');
    }
    public function resetcategorys($currentStep)
    {
        $this->authorize('property-create');
        $this->validate();
        $this->resetErrorBag();


        $this->currentStep++;
        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }


        $parameter = array(
             'area' => $this->area,
             'unit_id' =>$this->unit_id,
             'customer_id' =>$this->customer_id,
             'name' =>$this->name,
             'email' => $this->email,
             'phone_no' =>$this->phone_no,
             'type' =>$this->type,
             'street_address' =>$this->street_address,
             'location' => $this->location,
             'city' => $this->city,
             'sublocality_level_1' =>$this->sublocality_level_1,
             'sublocality_level_2' =>$this->sublocality_level_2,
             'sublocality_level_3' => $this->sublocality_level_3,
             'latitude' =>  $this->latitude,
             'longitude' =>   $this->longitude,
             'category_id' =>  $this->category_id,
             'rooms' => $this->rooms,
             'bathrooms' => $this->bathrooms,
             'parking_space' => $this->parking_space,
             'year_build' =>  $this->year_build,
             'title' =>  $this->title,
             'description' =>  $this->description,
             'urgency' =>   $this->urgency,
             'purpose' =>  $this->purpose,
             'price' =>   $this->price,
             'sub_category_id' =>    $this->sub_category_id,
             'amenity_id' => $this->amenity_id,
             'photos' => $this->photos,
             'video_url' =>  $this->videos,
             'documents' =>   $this->documents
        );
        if($currentStep=='1')
        {
            $parameter['pagedata'] = "1";

            $properties = PropertyDraft::storenextpagethree($parameter);

            return redirect()->back()->with('success', 'Property added successfully!');
        }
        if($currentStep=='2')
        {
            $parameter['pagedata'] = "2";
            $properties = PropertyDraft::storenextpagethree($parameter);
           return redirect()->back()->with('success', 'Property added successfully!');
        }
        if($currentStep=='3')
        {
            $parameter['pagedata']= "3";
            $properties = PropertyDraft::storenextpagethree($parameter);
           return redirect()->back()->with('success', 'Property added successfully!');
        }
        if($currentStep=='6')
        {
            $parameter['pagedata']= "6";

            $properties = PropertyDraft::storenextpagethree($parameter);
           return redirect()->back()->with('success', 'Property added successfully!');
        }




    }
}

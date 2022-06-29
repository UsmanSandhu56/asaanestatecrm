<?php

namespace App\Http\Livewire\Admin\Properties;


use App\Models\Status;
use App\Models\Address;
use App\Models\Amenity;
use Livewire\Component;
use App\Models\AreaUnit;
use App\Models\Category;
use App\Models\PropertyDraft;
use App\Models\PropertyDetail;
use App\Services\AreaUnitService;
use App\Services\CustomerService;
use App\Services\PropertyService;
use App\Models\PropertyDetailDraft;
use App\Http\Livewire\Admin\Parents\PropertyParent;

class EditDraft extends PropertyParent
{
    public function render()
    {

        $this->authorize('property-edit');

        $searchResults = CustomerService::searchCustomer($this->search);

        return view('livewire.admin.properties.edit-draft', ['searchResults' => $searchResults]);
    }
    public function store($id)
    {
        $this->authorize('property-create');
        $this->validate();
        $property = PropertyDraft::store($id,$this->area, $this->unit_id,
            $this->customer_id, $this->name, $this->email, $this->phone_no, $this->type, $this->street_address, $this->location,
            $this->city, $this->sublocality_level_1, $this->sublocality_level_2, $this->sublocality_level_3, $this->latitude, $this->longitude,
            $this->category_id, $this->rooms, $this->bathrooms, $this->parking_space, $this->year_build, $this->title, $this->description, $this->urgency, $this->purpose, $this->price, $this->sub_category_id,
            $this->amenity_id, $this->photos, $this->videos, $this->documents);
        return redirect()->route('properties.matches', $property)->with('success', 'Property added successfully!');
    }
    public function editpropertydraft($id,$currentStep)
    {


        $this->authorize('property-create');
        $this->validate();
        $this->resetErrorBag();


        $this->currentStep++;
        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
        $editpropertydraft = PropertyDraft::find($id);


        if(isset($this->purpose))
        {
            $editpropertydraft->purpose = $this->purpose;
        }
        if(isset($this->category_id))
        {
            $editpropertydraft->category_id = $this->category_id;
        }
        if(isset($this->unit_id))
        {
            $editpropertydraft->unit_id = $this->unit_id;
        }
        if($this->area!=null )
        {

            $findarea = PropertyDraft::where('area',$this->area)
            ->where('unit_id',$this->unit_id)
            ->where('id',$id)
            ->first();


        if($findarea==null)
        {


        $data = ['area' => $this->area, 'unit_id' => $this->unit_id];
        $area = AreaUnitService::propertyAreaUnitConversation($data);
        $editpropertydraft->area = $area;
        }
        else
        {

        $editpropertydraft->area = $this->area;
        }

        }
        if(isset($this->sub_category_id))
        {
            $editpropertydraft->sub_category_id = $this->sub_category_id;
        }
        if(isset($this->urgency))
        {
            $editpropertydraft->urgency = $this->urgency;
        }


        if(isset($this->location))
        {
            $findaddress =  Address::find($editpropertydraft->address_id);

           if($findaddress!=null)
           {
            $findaddress->location = $this->location;
            if(isset($this->city))
            {
            $findaddress->city = $this->city;
            }
            if(isset($this->street_address))
            {
            $findaddress->street_address = $this->street_address;
            }
            $findaddress->update();
           }
        else
        {
            $findaddress = new Address;
            $findaddress->location = $this->location;

            if($this->city !=null)
            {
            $findaddress->city = $this->city;
            }
            if($this->street_address != null)
            {
            $findaddress->street_address = $this->street_address;
            }
            $findaddress->country = "Pakistan";
            $findaddress->save();
        }
        }
        if(isset($this->title))
        {
            $editpropertydraft->title = $this->title;
        }
        if(isset($this->price))
        {
            $editpropertydraft->price = $this->price;
        }
        if(isset($this->description))
        {
            $editpropertydraft->description = $this->description;
        }

        if($this->rooms!=null)
        {

           $propertydetails = PropertyDetailDraft::find($editpropertydraft->property_detail_draft_id);


           if($propertydetails!=null)
           {

                $propertydetails->rooms =$this->rooms;
                if(isset($this->bathrooms))
                {
                $propertydetails->bathrooms =$this->bathrooms;
                }
                if(isset($this->parking_space))
                {
                $propertydetails->parking_space =$this->parking_space;

                }
                if(isset($this->year_build))
                {
                $propertydetails->year_build =$this->year_build;

                }
                $propertydetails->update();
           }
            else
            {

            $propertydetails = new PropertyDetailDraft;

            $propertydetails->rooms =$this->rooms;
            if($this->bathrooms!=null)
            {
            $propertydetails->bathrooms =$this->bathrooms;
            }
            if($this->parking_space!=null)
            {
            $propertydetails->parking_space =$this->parking_space;

            }
            if($this->year_build!=null)
            {
            $propertydetails->year_build =$this->year_build;

            }
            $propertydetails->save();
            $editpropertydraft->property_detail_draft_id= $propertydetails->id;
           }
        }
        $editpropertydraft->update();

    }
    public function mount(PropertyDraft $property )
    {
        $this->currentStep = 1;
        $this->totalSteps = 6;
        $this->categories = Category::all();
        $this->units = AreaUnit::all();

        $this->type = false;
        $this->statuses = Status::whereIn('id', [1, 2])->get();
        $this->amenities = Amenity::all();
        $this->property = $property;
        ($property->category_id !== 1) ? $this->show = false : $this->show = true;
        $this->purpose = $property->purpose;
        $this->title = $property->title;
        $this->price = $property->price;
        $this->description = $property->description;
        if($property->urgency)
        {
            $this->category_id = $property->category_id;
        }
        else
        {
            $this->urgency = 0;
        }
        $this->getSubcategories($this->category_id);
        $this->rooms = isset($property->propertyDetailDraft) ? $property->propertyDetailDraft->rooms : '';
        $this->bathrooms = isset($property->propertyDetailDraft) ? $property->propertyDetailDraft->bathrooms : '';
        $this->parking_space = isset($property->propertyDetailDraft) ? $property->propertyDetailDraft->parking_space : '';
        $this->year_build = isset($property->propertyDetailDraft) ? $property->propertyDetailDraft->year_build : '';
        if($property->address)
        {
        $this->city = $property->address->city;

            $this->location = $property->address->location;

            $this->street_address = $property->address->street_address;

            $this->latitude = $property->address->latitude;

            $this->longitude = $property->address->longitude;

            $this->sublocality_level_1 = $property->address->sublocality_level_1;

            $this->sublocality_level_2 = $property->address->sublocality_level_2;

            $this->sublocality_level_3 = $property->address->sublocality_level_3;
        }

        $this->amenity_id = array_map('strval', $property->amenities->pluck('id')->all());
        if($property->customer)
        {
            $this->name = $property->customer->name;

            $this->type = $property->customer->type;

            $this->email = $property->customer->email;

            $this->phone_no = $property->customer->phone_no;

            $this->customer_id = $property->customer->customer_id;
        }

        $this->updatedAreaUnit($property->unit_id);
        $data = ['area' => $property->area, 'unit_id' =>$property->unit_id];

        $area = AreaUnitService::editPropertyAreaUnitConversation($data);



        $this->area = str_replace( ',', ' ', $area );


    }
    public function update()
    {
        $this->authorize('property-edit');
        $this->validate();
        PropertyService::update($this->property, $this->area, $this->unit_id,
            $this->customer_id, $this->name, $this->email, $this->phone_no, $this->type, $this->street_address, $this->location,
            $this->city, $this->sublocality_level_1, $this->sublocality_level_2, $this->sublocality_level_3, $this->latitude, $this->longitude,
            $this->category_id, $this->rooms, $this->bathrooms, $this->parking_space, $this->year_build, $this->title, $this->description, $this->urgency, $this->purpose, $this->price, $this->sub_category_id,
            $this->amenity_id, $this->photos, $this->videos, $this->documents);
        return redirect()->route('properties')->with('success', 'Property updated successfully!');
    }

}

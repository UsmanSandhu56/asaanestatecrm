<?php


namespace App\Services;


use App\Models\Address;
use App\Models\Customer;
use App\Models\Property;
use App\Models\PropertyDraft;
use App\Models\PropertyDetail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PropertyService
{
    
    public static function store($area, $unit_id, $customer_id, $name, $email, $phone_no, $type, $street_address,
                                 $location, $city, $sublocality_level_1, $sublocality_level_2, $sublocality_level_3,
                                 $latitude, $longitude, $category_id, $rooms, $bathrooms, $parking_space, $year_build,
                                 $title, $description, $urgency, $purpose, $price, $sub_category_id, $amenity_id,
                                 $photos, $videos, $documents)
    {
       
        $draft_id = Session::get('id');
        $deletedraft = PropertyDraft::find($draft_id);
        $deleteaddress =Address::where('id',$deletedraft->address_id)->delete();
        $deletedraft->delete();
        
        $data = ['area' => $area, 'unit_id' => $unit_id];
        $area = AreaUnitService::propertyAreaUnitConversation($data);
        $property = collect();
        DB::transaction(function () use (
            &$property, $area, $customer_id, $name, $email, $phone_no, $type, $street_address,
            $location, $city, $sublocality_level_1, $sublocality_level_2, $sublocality_level_3,
            $latitude, $longitude, $category_id, $rooms, $bathrooms, $parking_space, $year_build,
            $title, $description, $urgency, $purpose, $price, $sub_category_id, $amenity_id,$unit_id,
            $photos, $videos, $documents
        ) {
            $customer = Customer::updateOrCreate(
                ['id' => $customer_id ?? ''],
                ['user_id' => auth()->id(), 'name' => $name, 'email' => $email, 'phone_no' => $phone_no, 'type' => $type, 'agency_id' => session('agency_id')]
            );
            $address = Address::create(['street_address' => $street_address, 'country' => 'Pakistan', 'location' => $location, 'city' => $city,
                'sublocality_level_1' => $sublocality_level_1, 'sublocality_level_2' => $sublocality_level_2,
                'sublocality_level_3' => $sublocality_level_3, 'latitude' => $latitude, 'longitude' => $longitude]);
            $detailId = null;

            if ($category_id == 1) {
                $detail = PropertyDetail::create(['rooms' => $rooms, 'bathrooms' => $bathrooms, 'parking_space' => $parking_space, 'year_build' => $year_build]);
                $detailId = $detail->id;
            }

            if($videos==[]){

            $property = Property::create(['title' => $title, 'description' => $description,
                'urgency' => $urgency, 'purpose' => $purpose, 'area' => $area,'unit_id' => $unit_id,
                'price' => $price, 'customer_id' => $customer->id, 'agency_id' => session('agency_id'),
                'category_id' => $category_id, 'sub_category_id' => $sub_category_id,
                'user_id' => auth()->id(), 'property_detail_id' => $detailId, 'address_id' => $address->id]);
            }
            else{
                $property = Property::create(['title' => $title, 'description' => $description,
                'urgency' => $urgency, 'purpose' => $purpose, 'area' => $area,'unit_id' => $unit_id,
                'price' => $price, 'customer_id' => $customer->id,'video_url'=>$videos, 'agency_id' => session('agency_id'),
                'category_id' => $category_id, 'sub_category_id' => $sub_category_id,
                'user_id' => auth()->id(), 'property_detail_id' => $detailId, 'address_id' => $address->id]);
        
            }

            $property->amenities()->attach($amenity_id);

        $deletedata = Session::get('id');
            self::storeMedia($photos,  $documents, $property);
           

            
        });
        return $property;
    }

    public static function update($property, $area, $unit_id, $customer_id, $name, $email, $phone_no, $type, $street_address,
                                  $location, $city, $sublocality_level_1, $sublocality_level_2, $sublocality_level_3,
                                  $latitude, $longitude, $category_id, $rooms, $bathrooms, $parking_space, $year_build,
                                  $title, $description, $urgency, $purpose, $price, $sub_category_id, $amenity_id,
                                  $photos, $video_url, $documents)
    {
        $data = ['area' => $area, 'unit_id' => $unit_id];
        $area = AreaUnitService::propertyAreaUnitConversation($data);
        DB::transaction(function () use (
            $property, $area, $customer_id, $name,$unit_id, $email, $phone_no, $type, $street_address,
            $location, $city, $sublocality_level_1, $sublocality_level_2, $sublocality_level_3,
            $latitude, $longitude, $category_id, $rooms, $bathrooms, $parking_space, $year_build,
            $title, $description, $urgency, $purpose, $price, $sub_category_id, $amenity_id,
            $photos, $video_url, $documents
        ) {
            $customer = Customer::updateOrCreate(
                ['id' => $customer_id ?? ''],
                ['user_id' => auth()->id(), 'name' => $name, 'email' => $email, 'phone_no' => $phone_no, 'type' => $type, 'agency_id' => session('agency_id')]
            );
            $property->address()->update(['street_address' => $street_address, 'country' => 'Pakistan', 'location' => $location, 'city' => $city,
                'sublocality_level_1' => $sublocality_level_1, 'sublocality_level_2' => $sublocality_level_2,
                'sublocality_level_3' => $sublocality_level_3, 'latitude' => $latitude, 'longitude' => $longitude]);
            if ($category_id == 1) {
                $propertyDetail = $property->propertyDetail()->updateOrCreate(
                    ['id' => $property->property_detail_id],
                    ['rooms' => $rooms, 'bathrooms' => $bathrooms, 'parking_space' => !empty($parking_space) ? $parking_space : null, 'year_build' => !empty($year_build) ? $year_build : null]
                );
            }
            $property->update(['title' => $title,'unit_id'=>$unit_id, 'description' => $description,
                'urgency' => $urgency, 'purpose' => $purpose,
                'area' => $area, 'price' => $price, 'customer_id' => $customer->id,
                'category_id' => $category_id, 'sub_category_id' => $sub_category_id,
                'video_url'=>$video_url,
                'property_detail_id' => $propertyDetail->id ?? null, 'address_id' => $property->address->id]);
            $property->amenities()->sync($amenity_id);
            self::storeMedia($photos, $documents, $property);
        });
    }

    public static function filterProperties($purpose, $category_id, $sub_category_id, $max_price, $min_price,
                                            $min_area, $max_area, $unit_id, $city, $location,
                                            $bathrooms, $rooms)
    {
        $filterCounter = null;
        $properties = Property::with(['media', 'address', 'propertyDetail', 'amenities', 'customer'])->where([
            'purpose' => $purpose,
            'category_id' => $category_id,
            'agency_id' => session('agency_id')
        ]);
        $filterCounter = 2;
        if (!empty($sub_category_id) && $properties->where('sub_category_id', $sub_category_id)->count() > 0) {
            $properties = $properties->where('sub_category_id', $sub_category_id);
            $filterCounter++;
        }
        if (!empty($max_price) && $properties->where('price', '<=', $max_price->count() > 0)) {
            $properties = $properties->where('price', '<=', $max_price);
            $filterCounter++;
        }
        if (!empty($min_price) && $properties->where('price', '>=', $min_price->count() > 0)) {
            $properties = $properties->where('price', '>=', $min_price);
            $filterCounter++;
        }
        if (!empty($min_area)) {
            $data = ['unit_id' => $unit_id, 'area' => $min_area];
            $area = AreaUnitService::propertyAreaUnitConversation($data);
            if ($properties->where('area', '>=', $area)->count() > 0) {
                $properties = $properties->where('area', '>=', $area);
                $filterCounter++;
            }
        }
        if (!empty($max_area)) {
            $data = ['unit_id' => $unit_id, 'area' => $max_area];
            $area = AreaUnitService::propertyAreaUnitConversation($data);
            if ($properties->where('area', '<=', $area)->count() > 0) {
                $properties = $properties->where('area', '<=', $area);
                $filterCounter++;
            }
        }
        if (!empty($city)) {
            $properties = $properties->whereRelation('address', 'city', $city);
            $filterCounter++;
        }
        if (!empty($location) && $properties->whereRelation('address', 'location', $location)->count() > 0) {
            $properties = $properties->whereRelation('address', 'location', $location);
            $filterCounter++;
        }
        if ($category_id == 1) {
            if (!empty($bathrooms) && $properties->whereRelation('property_detail', 'bathrooms', $bathrooms)->count() > 0) {
                $properties = $properties->whereRelation('property_detail', 'bathrooms', $bathrooms);
                $filterCounter++;
            }
            if (!empty($rooms) && $properties->whereRelation('property_detail', 'rooms', $rooms)->count() > 0) {
                $properties = $properties->whereRelation('property_detail', 'rooms', $rooms);
                $filterCounter++;
            }
        }
        return [
            'properties' => $properties->get(),
            'filterCounter' => $filterCounter,
        ];
    }
    public static function checkDraftPermission()
    {
        
            return PropertyDraft::where('user_id',auth()->user()->id)->with(['customer', 'address', 'propertyDetailDraft', 'amenities', 'media'])
            ->where(['agency_id' => session('agency_id'), 'status_id' => null]);
        
    }
    public static function checkPermission()
    {
        if (auth()->user()->can('property-all-list')) {
            return Property::with(['customer', 'address', 'propertyDetail', 'amenities', 'media'])
                ->where(['agency_id' => session('agency_id'), 'status_id' => null]);
        }

        if (auth()->user()->can('property-all-list')) {
            return Property::with(['customer', 'address', 'propertyDetail', 'amenities', 'media'])
            ->where(['agency_id' => session('agency_id'), 'status_id' => null]);
        }
        
        if (auth()->user()->can('property-list')) {
            return Property::with(['customer', 'address', 'propertyDetail', 'amenities', 'media'])
                ->where(['agency_id' => session('agency_id'), 'status_id' => null, 'user_id' => auth()->id()]);
        }
        return abort(403);
    }

    public static function validation($customer_id, $category_id, $currentStep)
    {
        if ($currentStep === 1) {
            return [
                'purpose' => ['required'],
                'category_id' => ['required'],
                'sub_category_id' => ['required'],
                'urgency' => ['required'],
                'street_address' => ['nullable'],
                'city' => ['required'],
                'location' => ['required'],
                'latitude' => ['nullable', 'numeric', 'required_with:longitude', 'between:-90,90",'],
                'longitude' => ['nullable', 'numeric', 'required_with:latitude', 'between:-180,180'],
                'sublocality_level_1' => ['nullable'],
                'sublocality_level_2' => ['nullable'],
                'sublocality_level_3' => ['nullable'],
            ];
        }
        if ($currentStep === 2) {
            return [
                'title' => ['required', 'max:50'],
                'description' => ['nullable'],
                'area' => 'required|numeric|min:1',
                'unit_id' => ['required'],
                'price' => ['required'],
                'rooms' => ['nullable'],
                'bathrooms' => ['nullable'],
                'parking_space' => ['nullable'],
                'year_build' => ['nullable'],
            ];
        }
        if ($currentStep === 3) {
            return [
                'amenity_id.*' => ['required'],
            ];
        }
        if ($currentStep === 4) {
            return [
                'photos.*' => ['sometimes', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:15024'],
                
                'videos' => ['nullable'],

                // 'videos.*' => ['sometimes', 'mimes:mp4,ogx,oga,ogv,ogg,webm', 'max:15024'],
            ];
        }
        if ($currentStep === 5) {
            return [
                'documents.*' => ['sometimes', 'mimes:pdf,docx,doc', 'max:15024'],
            ];
        }
        if ($currentStep === 6) {
            return [
                'customer_id' => ['sometimes'],
                'name' => ['required', 'max:50'],
                'email' => ['nullable', 'email', 'max:50', Rule::unique('customers')->ignore($customer_id ?? null)],
                'phone_no' => ['required', 'starts_with:03','starts_with:03', 'max:11', 'min:11', Rule::unique('customers')->ignore($customer_id ?? null)],
                'type' => ['required'],
            ];
        }
        return [];
    }

    private static function storeMedia($photos, $documents, $property)
    {
      
        if (isset($photos)) {
            foreach ($photos as $media) {
                
                $property->addMedia($media->getRealPath())->toMediaCollection('photos');
            }
        }
      
        if (isset($photos)) {
            foreach ($documents as $media) {
                $property->addMedia($media->getRealPath())->toMediaCollection('documents');
            }
        }
      
    }

    // public function matchSubLocalities()
    // {
    //     if (isset($sublocality_level_1) && !empty($sublocality_level_1)) {
    //         $sub_locality_1 = $properties->whereRelation('address', 'sublocality_level_1', $sublocality_level_1)->get();
    //     }
    //     if (isset($sublocality_level_2) && !empty($data['sublocality_level_2'])) {
    //         $sub_locality_2 = $properties->whereRelation('address', ['sublocality_level_1' => $sublocality_level_1,
    //             'sublocality_level_2' => $sublocality_level_2])->get();
    //     }
    //     if (isset($sublocality_level_3) && !empty($sublocality_level_3)) {
    //         $sub_locality_3 = $properties->whereRelation('address', 'sublocality_level_1')->get();
    //     }
    //     if (isset($sub_locality_3) && count($sub_locality_3) > 0) {
    //         return $properties = $sub_locality_3->merge($sub_locality_2)->merge($sub_locality_1)->unique();
    //     } elseif (isset($sub_locality_2) && count($sub_locality_2) > 0) {
    //         return $properties = $sub_locality_2->merge($sub_locality_1)->unique();
    //     } elseif (isset($sub_locality_1) && count($sub_locality_1) > 0) {
    //         return $properties = $sub_locality_1;
    //     }
    // }

    // public function matchLatLong()
    // {
    //     return Property::with('address')->where(['purpose' => $purpose, 'agency_id' => session('agency_id')])->whereHas('address', function ($q) {
    //         $q->where(['latitude' => $latitude, 'longitude' => $longitude]);
    //     })->get()->toArray();
    // }

    // public function matchRadius($latitude, $longitude, $radius = 1500)
    // {
    //     return $properties->whereHas('address', function ($q) use ($latitude, $longitude, $radius) {
    //         $q->selectRaw("id, street_address, country, location, latitude, longitude, city, sublocality_level_1, sublocality_level_2, sublocality_level_3,
    //          ( 6371000 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) )
    //          + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance", [$latitude, $longitude, $latitude])
    //             ->having("distance", "<", $radius)
    //             ->orderBy("distance", 'asc');
    //     })->offset(0)->limit(20)->get();
    // }
}

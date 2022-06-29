<?php


namespace App\Services;


use App\Models\Customer;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\PropertyRequirement;
use Illuminate\Support\Facades\Session;
use App\Models\PropertyRequirementDraft;
use App\Models\PropertyRequirementDetail;

class PropertyRequirementService
{
    public static function store($min_area, $max_area, $is_serious, $unit_id, $customer_id, $name, $email, $phone_no, $type, $max_rooms,
                                 $min_rooms, $parking_space, $year_build, $max_bathrooms, $min_bathrooms, $location, $city,
                                 $sublocality_level_1, $sublocality_level_2, $sublocality_level_3, $latitude, $longitude, $title,
                                 $description, $urgency, $purpose, $max_price, $min_price, $category_id, $sub_category_id, $amenity_id)
    {

        
        $deletdata =Session::get('propertyrequirementid');
        $deletedraft = PropertyRequirementDraft::find($deletdata);
    
        $deletedraft->delete();

        $area = ['min_area' => $min_area, 'max_area' => $max_area, 'unit_id' => $unit_id];
        $area = AreaUnitService::propertyRequirementAreaUnitConversation($area);
        $propertyRequirement = collect();
        DB::transaction(function () use (
            &$propertyRequirement, $is_serious, $area, $customer_id, $name, $email, $phone_no, $type, $max_rooms,
            $min_rooms, $parking_space, $year_build, $max_bathrooms, $min_bathrooms, $location, $city,$unit_id,
            $sublocality_level_1, $sublocality_level_2, $sublocality_level_3, $latitude, $longitude, $title,
            $description, $urgency, $purpose, $max_price, $min_price, $category_id, $sub_category_id, $amenity_id
        ) {
            $customer = Customer::updateOrCreate(
                ['id' => $customer_id ?? ''],
                ['user_id' => auth()->id(), 'name' => $name, 'email' => $email,
                    'phone_no' => $phone_no, 'type' => $type, 'agency_id' => session('agency_id')]
            );
            $detail = PropertyRequirementDetail::create(['user_id' => auth()->id(), 'agency_id' => session('agency_id'),
                'max_rooms' => $max_rooms ?? null, 'min_rooms' => $min_rooms ?? null,
                'parking_space' => $parking_space ?? null, 'year_build' => $year_build ?? null,
                'max_bathrooms' => $max_bathrooms ?? null, 'min_bathrooms' => $min_bathrooms ?? null,
                'location' => $location, 'country' => 'Pakistan', 'city' => $city,
                'sublocality_level_1' => $sublocality_level_1, 'sublocality_level_2' => $sublocality_level_2,
                'sublocality_level_3' => $sublocality_level_3, 'latitude' => $latitude, 'longitude' => $longitude]);
            $propertyRequirement = PropertyRequirement::create(['title' => $title, 'description' => $description,
                'urgency' => $urgency, 'purpose' => $purpose, 'max_area' => $area['max_area'], 'min_area' => $area['min_area'], 'unit_id' => $unit_id,
                'max_price' => $max_price, 'min_price' => $min_price, 'is_serious' => $is_serious, 'customer_id' => $customer->id, 'agency_id' => session('agency_id'),
                'category_id' => $category_id, 'sub_category_id' => $sub_category_id,
                'user_id' => auth()->id(), 'property_requirement_detail_id' => $detail->id]);
            $propertyRequirement->amenities()->attach($amenity_id);
        });
        return $propertyRequirement;
    }

    public static function update($propertyRequirement, $min_area, $max_area, $is_serious, $unit_id, $customer_id, $name, $email, $phone_no, $type, $max_rooms,
                                  $min_rooms, $parking_space, $year_build, $max_bathrooms, $min_bathrooms, $location, $city,
                                  $sublocality_level_1, $sublocality_level_2, $sublocality_level_3, $latitude, $longitude, $title,
                                  $description, $urgency, $purpose, $max_price, $min_price, $category_id, $sub_category_id, $amenity_id)
    {
        $area = ['min_area' => $min_area, 'max_area' => $max_area, 'unit_id' => $unit_id];
        $area = AreaUnitService::propertyRequirementAreaUnitConversation($area);
  
        DB::transaction(function () use (
            $propertyRequirement, $is_serious, $area, $customer_id,$unit_id, $name, $email, $phone_no, $type, $max_rooms,
            $min_rooms, $parking_space, $year_build, $max_bathrooms, $min_bathrooms, $location, $city,
            $sublocality_level_1, $sublocality_level_2, $sublocality_level_3, $latitude, $longitude, $title,
            $description, $urgency, $purpose, $max_price, $min_price, $category_id, $sub_category_id, $amenity_id
        ) {
            $customer = Customer::updateOrCreate(
                ['id' => $customer_id ?? ''],
                ['user_id' => auth()->id(), 'name' => $name, 'email' => $email, 'phone_no' => $phone_no, 'type' => $type, 'agency_id' => session('agency_id')]
            );

            $propertyRequirement->propertyRequirementDetail->update([
                'max_rooms' => $max_rooms ?? null, 'min_rooms' => $min_rooms ?? null,
                'max_bathrooms' => $max_bathrooms ?? null, 'min_bathrooms' => $min_bathrooms ?? null,
                'parking_space' => $parking_space ?? null, 'year_build' => $year_build ?? null,
                'location' => $location, 'country' => 'Pakistan', 'city' => $city,
                'sublocality_level_1' => $sublocality_level_1, 'sublocality_level_2' => $sublocality_level_2,
                'sublocality_level_3' => $sublocality_level_3, 'latitude' => $latitude, 'longitude' => $longitude]);

 
            $propertyRequirement->update(['title' => $title, 'description' => $description,
                'urgency' => $urgency, 'purpose' => $purpose, 'max_area' => $area['max_area'], 'min_area' => $area['min_area'],
                'max_price' => $max_price, 'min_price' => $min_price,'unit_id'=>$unit_id, 'is_serious' => $is_serious, 'customer_id' => $customer->id,
                'category_id' => $category_id, 'sub_category_id' => $sub_category_id,
                'property_requirement_detail_id' => $propertyRequirement->propertyRequirementDetail->id]);
            $propertyRequirement->amenities()->sync($amenity_id);
        });
    }

    public static function filterPropertyRequirements($purpose, $category_id, $sub_category_id, $max_price, $min_price,
                                               $min_area, $max_area, $unit_id, $city, $location,
                                               $min_bathrooms, $max_bathrooms, $min_rooms, $max_rooms)
    {
        $filterCounter = null;
        $propertyRequirements = PropertyRequirement::with(['propertyRequirementDetail', 'customer', 'amenities'])->where([
            'purpose' => $purpose,
            'category_id' => $category_id,
            'agency_id' => session('agency_id')
        ]);
        $filterCounter = 2;
        if (!empty($sub_category_id) && $propertyRequirements->where('sub_category_id', $sub_category_id)->count() > 0) {
            $propertyRequirements = $propertyRequirements->where('sub_category_id', $sub_category_id);
            $filterCounter++;
        }
        if (!empty($min_price) && $propertyRequirements->where('min_price', '>=', $min_price)->count() > 0) {
            $filterCounter++;
            $propertyRequirements = $propertyRequirements->where('min_price', '>=', $min_price);
        }
        if (!empty($max_price) && $propertyRequirements->where('max_price', '<=', $max_price)->count() > 0) {
            $filterCounter++;
            $propertyRequirements = $propertyRequirements->where('max_price', '<=', $max_price);
        }
        if (!empty($min_area)) {
            $data = ['unit_id' => $unit_id, 'area' => $min_area];
            $area = AreaUnitService::propertyAreaUnitConversation($data);
            if ($propertyRequirements->where('min_area', '>=', $area)->count() > 0) {
                $propertyRequirements = $propertyRequirements->where('min_area', '>=', $area);
                $filterCounter++;
            }
        }
        if (!empty($max_area)) {
            $data = ['unit_id' => $unit_id, 'area' => $min_area];
            $area = AreaUnitService::propertyAreaUnitConversation($data);
            if ($propertyRequirements->where('max_area', '<=', $area)->count() > 0) {
                $propertyRequirements = $propertyRequirements->where('max_area', '<=', $area);
                $filterCounter++;
            }
        }
        if (!empty($city)) {
            $propertyRequirements = $propertyRequirements->whereRelation('propertyRequirementDetail', 'city', $city);
            $filterCounter++;
        }
        if (!empty($location) && $propertyRequirements->whereRelation('propertyRequirementDetail', 'location', $location)->count() > 0) {
            $propertyRequirements = $propertyRequirements->whereRelation('propertyRequirementDetail', 'location', $location);
            $filterCounter++;
        }
        if ($category_id == 1) {
            if (!empty($min_bathrooms) && $propertyRequirements->whereRelation('propertyRequirementDetail', 'min_bathrooms', $min_bathrooms)->count() > 0) {
                $propertyRequirements = $propertyRequirements->whereRelation('propertyRequirementDetail', 'min_bathrooms', $min_bathrooms);
                $filterCounter++;
            }
            if (!empty($max_bathrooms) && $propertyRequirements->whereRelation('propertyRequirementDetail', 'max_bathrooms', $max_bathrooms)->count() > 0) {
                $propertyRequirements = $propertyRequirements->whereRelation('propertyRequirementDetail', 'max_bathrooms', $max_bathrooms);
                $filterCounter++;
            }
            if (!empty($min_rooms) && $propertyRequirements->whereRelation('propertyRequirementDetail', 'min_rooms', $min_rooms)->count() > 0) {
                $propertyRequirements = $propertyRequirements->whereRelation('propertyRequirementDetail', 'min_rooms', $min_rooms);
                $filterCounter++;
            }
            if (!empty($max_rooms) && $propertyRequirements->whereRelation('propertyRequirementDetail', 'max_rooms', $max_rooms)->count() > 0) {
                $propertyRequirements = $propertyRequirements->whereRelation('propertyRequirementDetail', 'max_rooms', $max_rooms);
                $filterCounter++;
            }
        }
        return [
            'propertyRequirements' => $propertyRequirements->get(),
            'filterCounter' => $filterCounter,
        ];
    }
    public static function  checkPermissions()
    {
          return PropertyRequirementDraft::where('user_id',auth()->user()->id)
          ->orderby('id','DESC')
          ->with(['propertyRequirementDetaildraft', 'customer'])
          ->where('status_id',null);
        
    }
    public static function checkPermission()
    {
        if (auth()->user()->can('property-requirement-all-list')) {
            return PropertyRequirement::with(['propertyRequirementDetail', 'customer', 'amenities'])
                ->where(['agency_id' => session('agency_id'), 'status_id' => null]);
        }

        if (auth()->user()->can('property-requirement-list')) {
            return PropertyRequirement::with(['propertyRequirementDetail', 'customer', 'amenities'])
                ->where(['agency_id' => session('agency_id'), 'status_id' => null, 'user_id' => auth()->id()]);
        }

        return abort(403);
    }

    public static function validation($category_id, $customer_id, $currentStep)
    {
        if ($currentStep === 1) {
            return [
                'purpose' => ['required'],
                'category_id' => ['required'],
                'sub_category_id' => ['required'],
                'urgency' => ['required'],
                'city' => ['required'],
                'location' => ['required'],
                'latitude' => ['nullable', 'numeric', 'required_with:longitude', 'between:-90,90",'],
                'longitude' => ['nullable', 'numeric', 'required_with:latitude', 'between:-180,180'],
                'sublocality_level_1' => ['nullable'],
                'sublocality_level_2' => ['nullable'],
                'sublocality_level_3' => ['nullable'],
            ];
        }
        // 'max_area' => 'required|numeric|gt:min_price',

        if ($currentStep === 2) {
            return [
                'title' => ['required', 'max:50'],
                'description' => ['nullable'],
                'max_area' => 'required|numeric|gt:min_area',
                'min_area' => 'required|numeric|min:1',
                'max_price' => 'required|numeric|gt:min_price',
                'min_price' => 'required|numeric|min:1',
                'max_rooms' => ['nullable'],
                'min_rooms' => ['nullable'],
                'max_bathrooms' => ['nullable'],
                'min_bathrooms' => ['nullable'],
                'parking_space' => ['nullable'],
                'year_build' => ['nullable'],
                'unit_id' => ['required'],
            ];
        }
        if ($currentStep === 3) {
            return [
                'amenity_id.*' => ['nullable'],
            ];
        }
        if ($currentStep === 4) {
            return [
                'customer_id' => ['sometimes'],
                'name' => ['required', 'max:50'],
                'email' => ['nullable', 'email', 'max:50', Rule::unique('customers')->ignore($customer_id ?? null)],
                'phone_no' => ['required', 'starts_with:03','max:11', 'min:11', Rule::unique('customers')->ignore($customer_id ?? null)],
                'type' => ['required'],
            ];
        }
        return [];
    }

    // public function matchSubLocalities()
    // {
    //     if (isset($sublocality_level_1) && !empty($sublocality_level_1)) {
    //         $sub_locality_1 = $propertyRequirements->whereRelation('propertyRequirementDetail', 'sublocality_level_1', $sublocality_level_1)->get();
    //     }
    //     if (isset($sublocality_level_2) && !empty($data['sublocality_level_2'])) {
    //         $sub_locality_2 = $propertyRequirements->whereRelation('propertyRequirementDetail', ['sublocality_level_1' => $sublocality_level_1,
    //             'sublocality_level_2' => $sublocality_level_2])->get();
    //     }
    //     if (isset($sublocality_level_3) && !empty($sublocality_level_3)) {
    //         $sub_locality_3 = $propertyRequirements->whereRelation('propertyRequirementDetail', 'sublocality_level_1')->get();
    //     }
    //     if (isset($sub_locality_3) && count($sub_locality_3) > 0) {
    //         return $propertyRequirements = $sub_locality_3->merge($sub_locality_2)->merge($sub_locality_1)->unique();
    //     } elseif (isset($sub_locality_2) && count($sub_locality_2) > 0) {
    //         return $propertyRequirements = $sub_locality_2->merge($sub_locality_1)->unique();
    //     } elseif (isset($sub_locality_1) && count($sub_locality_1) > 0) {
    //         return $propertyRequirements = $sub_locality_1;
    //     }
    // }

    // public function matchLatLong()
    // {
    //     return Property::with('propertyRequirementDetail')->where(['purpose' => $purpose, 'agency_id' => session('agency_id')])->whereHas('propertyRequirementDetail', function ($q) {
    //         $q->where(['latitude' => $latitude, 'longitude' => $longitude]);
    //     })->get()->toArray();
    // }

    // public function matchRadius($latitude, $longitude, $radius = 1500)
    // {
    //     return $propertyRequirements->whereHas('propertyRequirementDetail', function ($q) use ($latitude, $longitude, $radius) {
    //         $q->selectRaw("id, street_address, country, location, latitude, longitude, city, sublocality_level_1, sublocality_level_2, sublocality_level_3,
    //          ( 6371000 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) )
    //          + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance", [$latitude, $longitude, $latitude])
    //             ->having("distance", "<", $radius)
    //             ->orderBy("distance", 'asc');
    //     })->offset(0)->limit(20)->get();
    // }

}

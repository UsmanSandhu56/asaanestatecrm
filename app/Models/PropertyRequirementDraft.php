<?php

namespace App\Models;
use App\Models\Customer;

use App\Models\SubCategory;
use App\Services\AreaUnitService;
use Illuminate\Support\Facades\DB;
use App\Models\PropertyRequirement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use App\Models\PropertyRequirementDraft;
use App\Models\PropertyRequirementDetail;
use App\Models\PropertyRequirementDetailDraft;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PropertyRequirementTransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyRequirementDraft extends Model
{
    use HasFactory,softDeletes;

    protected $fillable = ['title','unit_id', 'description', 'purpose', 'urgency', 'max_area', 'min_area', 'max_price', 'min_price', 'is_serious', 'user_id', 'agency_id', 'customer_id', 'category_id', 'sub_category_id', 'property_requirement_detail_id', 'status_id', 'status_reason_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function areaUnit()
    {
        return $this->belongsTo(AreaUnit::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function propertyRequirementDetaildraft()
    {
        return $this->belongsTo('App\Models\PropertyRequirementDetailDraft','property_requirement_detail_id','id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function propertyRequirementTransactionType()
    {
        return $this->hasMany(PropertyRequirementTransactionType::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class)->withTimestamps();
    }
    public static function store($id,$min_area, $max_area, $is_serious, $unit_id, $customer_id, $name, $email, $phone_no, $type, $max_rooms,
                                 $min_rooms, $parking_space, $year_build, $max_bathrooms, $min_bathrooms, $location, $city,
                                 $sublocality_level_1, $sublocality_level_2, $sublocality_level_3, $latitude, $longitude, $title,
                                 $description, $urgency, $purpose, $max_price, $min_price, $category_id, $sub_category_id, $amenity_id)
    {
  
        $deletedraft = PropertyRequirementDraft::find($id);
        $deletedetail = PropertyRequirementDetailDraft::where('id',$deletedraft->property_requirement_detail_id)->first();
        $deletedetail->delete();
        $deletedraft->delete();


        $area = ['min_area' => $min_area, 'max_area' => $max_area, 'unit_id' => $unit_id];
        $area = AreaUnitService::propertyRequirementAreaUnitConversation($area);
        $propertyRequirement = collect();
        DB::transaction(function () use (
            &$propertyRequirement, $is_serious, $area, $customer_id, $name, $email, $phone_no, $type, $max_rooms,
            $min_rooms, $parking_space, $year_build, $max_bathrooms, $min_bathrooms, $location, $city,
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
                'urgency' => $urgency, 'purpose' => $purpose, 'max_area' => $area['max_area'], 'min_area' => $area['min_area'],
                'max_price' => $max_price, 'min_price' => $min_price, 'is_serious' => $is_serious, 'customer_id' => $customer->id, 'agency_id' => session('agency_id'),
                'category_id' => $category_id, 'sub_category_id' => $sub_category_id,
                'user_id' => auth()->id(), 'property_requirement_detail_id' => $detail->id]);
            $propertyRequirement->amenities()->attach($amenity_id);
        });
        return $propertyRequirement;
    }

    public static function storenextpagethree($parameter)
    {

        
        if(Session::get('req-back-id')!=null && Session::get('req-create-id')==null)
        {
      
        
            $updateproeprtyrequirement = PropertyRequirementDraft::find(Session::get('propertyrequirementid'));
 
            if($parameter['urgency'])
            {
            $updateproeprtyrequirement->urgency =  $parameter['urgency'];
            }
            if($parameter['unit_id'])
            {
            $updateproeprtyrequirement->unit_id =  $parameter['unit_id'];
            }
            if($parameter['purpose'])
            {
            $updateproeprtyrequirement->purpose =  $parameter['purpose'];
            }
            if($parameter['is_serious'])
            {
            $updateproeprtyrequirement->is_serious =  $parameter['is_serious'];
            }
            if($parameter['category_id'])
            {
            $updateproeprtyrequirement->category_id =  $parameter['category_id'];
            }
        
            if($parameter['sub_category_id'])
            {
            $updateproeprtyrequirement->sub_category_id =  $parameter['sub_category_id'];
            }
            if($parameter['title'])
            {
            $updateproeprtyrequirement->title = $parameter['title'];
            }
            if($parameter['description'])
            {
            $updateproeprtyrequirement->description = $parameter['description'];
            }
            $findarea = PropertyRequirement::where('max_area',$parameter['max_area'])
            ->where('min_area',$parameter['min_area'])
            ->where('id',Session::get('propertydetailid'))
            ->where('unit_id',$parameter['unit_id'])
            ->first();

            if($findarea==null&&$parameter['max_area']!=null)
            {
            $area = ['min_area' =>  $parameter['min_area'], 'max_area' =>  $parameter['max_area'], 'unit_id' =>  $parameter['unit_id']];
           
            $area = AreaUnitService::propertyRequirementAreaUnitConversation($area);

            $updateproeprtyrequirement->min_area = $area['min_area'];
            $updateproeprtyrequirement->max_area = $area['max_area'];
            }
                else
                {

                    $area = ['min_area' =>  $updateproeprtyrequirement->min_area, 'max_area' => $updateproeprtyrequirement->max_area, 'unit_id' =>  $parameter['unit_id']];
                    
                }
           
            if($parameter['min_price'])
            {
            $updateproeprtyrequirement->min_price = $parameter['min_price'];
            }
            if($parameter['max_price'])
            {
            $updateproeprtyrequirement->max_price = $parameter['max_price'];
            }
            $updateproeprtyrequirement->update();
            if($updateproeprtyrequirement->property_requirement_detail_id)
            {
            $detail = PropertyRequirementDetailDraft::find(Session::get('propertydetailid'));
        
            if($parameter['max_rooms'])
            {
            $detail->max_rooms = $parameter['max_rooms'] ?? null;
            }
            if($parameter['min_rooms'])
            {
            $detail->min_rooms =  $parameter['min_rooms'] ?? null;
            }
            if($parameter['parking_space'])
            {
            $detail->parking_space =  $parameter['parking_space'] ?? null;
            }
            if($parameter['year_build'])
            { 
            $detail->year_build =  $parameter['year_build'] ?? null;
            }
            if($parameter['max_bathrooms'])
            {
            $detail->max_bathrooms =  $parameter['max_bathrooms'] ?? null;
            }
            if($parameter['min_bathrooms'])
            {
            $detail->min_bathrooms =  $parameter['min_bathrooms'] ?? null;
            }
            if($parameter['sublocality_level_1'])
            {
            $detail->sublocality_level_1 =  $parameter['sublocality_level_1'] ?? null;
            }
            if($parameter['sublocality_level_2'])
            {
            $detail->sublocality_level_2 =  $parameter['sublocality_level_2'] ?? null;
            }
            if($parameter['sublocality_level_3'])
            {
            $detail->sublocality_level_3 =  $parameter['sublocality_level_3'] ?? null;
            }
            if($parameter['latitude'])
            {
            $detail->latitude =  $parameter['latitude'];
            }
            if($parameter['longitude'])
            {
            $detail->longitude =  $parameter['longitude'];
            }
           
         if($parameter['location'])
            {
                $detail->location = $parameter['location'];
            }
            if($parameter['city'])
            {
                $detail->city = $parameter['city'];
            }
            if($parameter['year_build'])
            {
                $detail->year_build =  $parameter['year_build'];
            }
            $detail->update();

        }

            else{
                $detail = PropertyRequirementDetailDraft::create([
                    'user_id' => auth()->id(), 'agency_id' => session('agency_id'),
                    
                    'location' =>  $parameter['location'], 'country' => 'Pakistan', 'city' =>  $parameter['city']
                ]);
                 Session::put('propertydetailid', $detail->id);

                
              
            }
            
          
            Session::forget('req-back-id');
            return $updateproeprtyrequirement;

        }
    else{
       if($parameter['pagedata'] == '1')
       {
       
        $propertyRequirement = collect();
    DB::transaction(function () use ($parameter)
    
    {
        $propertyRequirement = new PropertyRequirementDraft();
        $propertyRequirement->user_id = auth()->user()->id;
        $propertyRequirement->urgency =  $parameter['urgency'];
        $propertyRequirement->purpose =  $parameter['purpose'];
        $propertyRequirement->is_serious =  $parameter['is_serious'];
        $propertyRequirement->category_id =  $parameter['category_id'];
        $propertyRequirement->sub_category_id =  $parameter['sub_category_id'];


        $detail = PropertyRequirementDetailDraft::create([
            'user_id' => auth()->id(), 'agency_id' => session('agency_id'),
            
            'location' =>  $parameter['location'], 'country' => 'Pakistan', 'city' =>  $parameter['city']
        ]);
        $propertyRequirement->property_requirement_detail_id = $detail->id;
        $propertyRequirement->save();
        
    Session::put('propertydetailid', $detail->id);
  
    Session::put('propertyrequirementid', $propertyRequirement->id);
    Session::forget('req-create-id');


    return $propertyRequirement;
    });
    }

   if($parameter['pagedata'] == '2')
    {
        
        $propertyRequirement = collect();


            $findarea = PropertyRequirement::where('max_area',$parameter['max_area'])
            ->where('min_area',$parameter['min_area'])
            ->where('id',Session::get('propertydetailid'))
            ->where('unit_id',$parameter['unit_id'])
            ->first();
 

        if($findarea==null && $parameter['max_area']!=null)
        {

                $area = ['min_area' =>  $parameter['min_area'], 'max_area' =>  $parameter['max_area'], 'unit_id' =>  $parameter['unit_id']];
         
                $area = AreaUnitService::propertyRequirementAreaUnitConversation($area);
           
                $propertyRequirement = collect();
        }
        else
        {
            $area = ['min_area' =>  $parameter['min_area'], 'max_area' =>  $parameter['max_area'], 'unit_id' =>  $parameter['unit_id']];
            $propertyRequirement = collect();
            
        }

            $detail = PropertyRequirementDetailDraft::find(Session::get('propertydetailid'));
            $detail->max_rooms = $parameter['max_rooms'] ?? null;
            $detail->min_rooms =  $parameter['min_rooms'] ?? null;
            $detail->parking_space =  $parameter['parking_space'] ?? null;
            $detail->year_build =  $parameter['year_build'] ?? null;
            $detail->max_bathrooms =  $parameter['max_bathrooms'] ?? null;
            $detail->min_bathrooms =  $parameter['min_bathrooms'] ?? null;
            $detail->sublocality_level_1 =  $parameter['sublocality_level_1'] ?? null;
            $detail->sublocality_level_2 =  $parameter['sublocality_level_2'] ?? null;
            $detail->sublocality_level_3 =  $parameter['sublocality_level_3'] ?? null;
            $detail->latitude =  $parameter['latitude'];
            $detail->longitude =  $parameter['longitude'];
            $detail->update();
            $property = PropertyRequirementDraft::find(Session::get('propertyrequirementid'));
            $property->title = $parameter['title'];
            $property->unit_id = $parameter['unit_id'];
            $property->property_requirement_detail_id = $detail->id;
            $property->description = $parameter['description'];
            $property->min_area= $area['min_area'];
            $property->max_area = $area['max_area'];
            $property->min_price = $parameter['min_price'];
            $property->max_price = $parameter['max_price'];
            $property->update();

      
        
    
        return $propertyRequirement;

    }
}

  
   
    

    
    }
}

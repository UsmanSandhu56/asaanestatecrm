<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Amenity;
use App\Models\Customer;

use App\Models\Property;
use App\Models\PropertyDraft;
use App\Models\PropertyDetail;
use Illuminate\Validation\Rule;
use App\Services\AreaUnitService;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\DB;
use App\Models\PropertyDetailDraft;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PropertyDraft extends Model implements HasMedia
{
    use  HasFactory, InteractsWithMedia;

    protected $fillable = ['title','auth_id', 'description','unit_id', 'urgency', 'purpose', 'area', 'price', 'user_id', 'customer_id', 'agency_id', 'category_id', 'sub_category_id', 'property_detail_id', 'address_id', 'status_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function propertyDetailDraft()
    {
        return $this->belongsTo(PropertyDetailDraft::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class)->withTimestamps();
    }

    public function property_transaction_type()
    {
        return $this->hasMany(PropertyTransactionType::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    
 public static function store($id,$area, $unit_id, $customer_id, $name, $email, $phone_no, $type, $street_address,
                                 $location, $city, $sublocality_level_1, $sublocality_level_2, $sublocality_level_3,
                                 $latitude, $longitude, $category_id, $rooms, $bathrooms, $parking_space, $year_build,
                                 $title, $description, $urgency, $purpose, $price, $sub_category_id, $amenity_id,
                                 $photos, $videos, $documents)
    {

      
        $deletedraft = PropertyDraft::find($id);
        

        $deletedetail = PropertyDetailDraft::where('id',$deletedraft->property_detail_draft_id)->first();
       
       if($deletedetail!=null){
        $deletedetail->delete();
       }
        $deletedraft->delete();
        $data = ['area' => $area, 'unit_id' => $unit_id];
        $area = AreaUnitService::propertyAreaUnitConversation($data);
        $property = collect();
        DB::transaction(function () use (
            &$property, $area, $customer_id, $name, $email, $phone_no, $type, $street_address,
            $location, $city, $sublocality_level_1, $sublocality_level_2, $sublocality_level_3,
            $latitude, $longitude, $category_id, $rooms, $bathrooms, $parking_space, $year_build,
            $title, $description, $urgency, $purpose, $price, $sub_category_id, $amenity_id,
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
            if($videos==[])
            {

                $property = Property::create(['title' => $title, 'description' => $description,
                    'urgency' => $urgency, 'purpose' => $purpose, 'area' => $area,
                    'price' => $price, 'customer_id' => $customer->id, 'agency_id' => session('agency_id'),
                    'category_id' => $category_id, 'sub_category_id' => $sub_category_id,
                    'user_id' => auth()->id(), 'property_detail_id' => $detailId, 'address_id' => $address->id]);
                }
                else{
                    $property = Property::create(['title' => $title, 'description' => $description,
                    'urgency' => $urgency, 'purpose' => $purpose, 'area' => $area,
                    'price' => $price, 'customer_id' => $customer->id,'video_url'=>$videos, 'agency_id' => session('agency_id'),
                    'category_id' => $category_id, 'sub_category_id' => $sub_category_id,
                    'user_id' => auth()->id(), 'property_detail_id' => $detailId, 'address_id' => $address->id]);
            
                }
            $property->amenities()->attach($amenity_id);

           
            self::storeMedia($photos,  $documents, $property);
           

            
        });
        return $property;
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
    public static function storenextpagethree($parameter)
        {
          
    
            if(Session::get('back-id')!=null && Session::get('create-id')==null)
            {
                $updatedraft= PropertyDraft::find(Session::get('back-id'));
             
                        if($parameter['urgency'])
                        {
                            $updatedraft->urgency = $parameter['urgency'];
                        }
                      
                        if($parameter['category_id'])
                        {
                            $updatedraft->category_id = $parameter['category_id'];
                        }
                        if($parameter['purpose'])
                        {
                            $updatedraft->purpose = $parameter['purpose'];
                        }
                        if($parameter['sub_category_id'])
                        {
                            $updatedraft->sub_category_id = $parameter['sub_category_id'];
                        }
                      

                        $updatedraft->auth_id= auth()->user()->id;
                        if($parameter['area'])
                        {
                        $updatedraft->area = $parameter['area'];
                        }  
                        if($parameter['title'])
                        {
                        $updatedraft->title = $parameter['title'];
                        }
                        if($parameter['description'])
                        {
                        $updatedraft->description = $parameter['description']; 
                        }
                        if($parameter['price'])
                        {
                        $updatedraft->price = $parameter['price']; 
                        }
                      

                        $updatedraft->user_id = auth()->id();
                    
                    
                        if($parameter['street_address'])
                        {
                           if($updatedraft->address_id) 
                           {
                      $findaddress = Address::find($updatedraft->address_id);
                      $findaddress->street_address =  $parameter['street_address'];
                      $findaddress->location =  $parameter['location'];
                      $findaddress->city =  $parameter['city'];
                      $findaddress->sublocality_level_1 = $parameter['sublocality_level_1'] ?? null;
                      $findaddress->sublocality_level_2 = $parameter['sublocality_level_2'] ?? null;
                      $findaddress->sublocality_level_3 = $parameter['sublocality_level_3'] ?? null;
                      $findaddress->latitude = $parameter['latitude']?? null;
                      $findaddress->longitude = $parameter['longitude']?? null;
                      $findaddress->update();
                           }
                           else{
                            $findaddress = Address::create(['street_address' => $parameter['street_address'], 
                            'country' => 'Pakistan', 
                            'location' => $parameter['location'],
                            'city' => $parameter['city'],
                           ]);
                           Session::put('address_id', $findaddress->id);


                           }
  
                        }
                     
                        if($parameter['area']!=null)
                        {
                        $data = ['area' => $parameter['area'], 'unit_id' => $parameter['unit_id'] ?? null];
                        $area = AreaUnitService::propertyAreaUnitConversation($data);
                       $property = collect();
                       

                        }
                       
                        
                            if($updatedraft->property_detail_draft_id)
                            {
                                if ($parameter['category_id'] == 1) 
                                {
                                 if($parameter['rooms']){
                               
                                $propertydetail = PropertyDetailDraft::find($updatedraft->property_detail_draft_id);
                                $propertydetail->rooms = $parameter['rooms'];
                                $propertydetail->bathrooms = $parameter['bathrooms'];
                                $propertydetail->parking_space = $parameter['parking_space'];
                                $propertydetail->year_build = $parameter['year_build'];
                                $propertydetail->update();
                                }
                         
                                } 
                            }
                            else{
                                DB::transaction(function () use ($parameter) {
                                    $detailId = null;
                                            if ($parameter['category_id'] == 1) {
                                                $detail = PropertyDetailDraft::create(['rooms' =>$parameter['rooms'], 'bathrooms' => $parameter['bathrooms'], 'parking_space' => $parameter['parking_space'], 'year_build' => $parameter['year_build']]);
                                               
                                      Session::put('properdetailid', $detail->id);
                                   
                                            }
                                        });
                                    
                                    }
                        $updatedraft->update();
                       
                        Session::forget('back-id');
                    return $updatedraft;

                  

            }
            else{
                
                
            if($parameter['pagedata']== '1')
            {
                Session::forget('back-id');
                
            
             $property = collect();
            DB::transaction(function () use ($parameter)
                            
                            {

                            $property = new PropertyDraft();
                            $property->urgency = $parameter['urgency'];
                            $property->category_id = $parameter['category_id'];
                            $property->purpose = $parameter['purpose'];
                            $property->category_id = $parameter['category_id'];
                            $property->sub_category_id = $parameter['sub_category_id'];
                            $property->auth_id = auth()->user()->id;
                            $property->agency_id = session('agency_id');
                            $property->user_id = auth()->id();
                            $address = Address::create(['street_address' => $parameter['street_address'], 
                            'country' => 'Pakistan', 
                            'location' => $parameter['location'],
                            'city' => $parameter['city'],
                           ]);
                           $property->address_id = $address->id;

                           $property->save();

                        Session::put('address_id', $address->id);

                        Session::forget('create-id');

                        Session::put('id', $property->id);

            

                     return   $property;

                        }); 
            }        
            if($parameter['pagedata']== '2')
            {

            
                $findaddress = Address::find(Session::get('address_id'));
                $findaddress->sublocality_level_1 = $parameter['sublocality_level_1'] ?? null;
                $findaddress->sublocality_level_2 = $parameter['sublocality_level_2'] ?? null;
                $findaddress->sublocality_level_3 = $parameter['sublocality_level_3'] ?? null;
                $findaddress->latitude = $parameter['latitude']?? null;
                $findaddress->longitude = $parameter['longitude']?? null;
                $findaddress->update();

             Session::put('addressid', $findaddress->id);
            
                $data = ['area' => $parameter['area'], 'unit_id' => $parameter['unit_id']];
                $area = AreaUnitService::propertyAreaUnitConversation($data);
                DB::transaction(function () use ($parameter ,$area) {
                    $detailId = null;

                            if ($parameter['category_id'] == 1) {
                                $detail = PropertyDetailDraft::create(['rooms' =>$parameter['rooms'], 'bathrooms' => $parameter['bathrooms'], 'parking_space' => $parameter['parking_space'], 'year_build' => $parameter['year_build']]);
                               
                      Session::put('properdetailid', $detail->id);
                   
                            }
                
                      $property = PropertyDraft::find(Session::get('id'));
                  
                      $property->urgency =$parameter['urgency'];
                      $property->title =$parameter['title'];
                      $property->description =$parameter['description'];
                      $property->purpose = $parameter['purpose']; 
                      $property->auth_id= auth()->user()->id;
                      $property->area = $parameter['area']; 
                      $property->address_id = Session::get('addressid');
                      $property->price = $parameter['price'];
                      $property->unit_id = $parameter['unit_id']; 
                      $property->agency_id = session('agency_id');
                      $property->area = $area;  
                      $property->category_id = $parameter['category_id']; 
                      $property->sub_category_id = $parameter['sub_category_id'];
                      $property->property_detail_draft_id = Session::get('properdetailid');
                      $property->user_id = auth()->id();
                      $property->update();  
                    return $property;

        
                    });


            }
            if($parameter['pagedata']== '3')
                {
                  
                    $detailId = null;

                    $data = ['area' => $parameter['area'], 'unit_id' => $parameter['unit_id']];
                    $area = AreaUnitService::propertyAreaUnitConversation($data);
                    $property = collect();
                    
                    DB::transaction(function () use ($parameter) {
                     
                        
                      $property = PropertyDraft::find(Session::get('id'));
                      $property->title = $parameter['title'];
                      $property->description = $parameter['description']; 
                      $property->auth_id= auth()->user()->id;
                      $property->unit_id = $parameter['unit_id']; 
                      $property->urgency = $parameter['urgency']; 
                      $property->price = $parameter['price']; 
                      $property->agency_id = session('agency_id'); 
                      $property->address_id = Session::get('addressid');
                      $property->category_id = $parameter['category_id'];
                      $property->property_detail_draft_id = Session::get('properdetailid');
                      $property->sub_category_id = $parameter['sub_category_id']; 
                      
                      $property->user_id = auth()->id();

                      $property->update();
                   
     
                    });
                    return $property;
        
                }
          

            }
           
        }
    
       
            }


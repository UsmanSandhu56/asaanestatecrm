<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Property extends Model implements HasMedia
{
    use HasFactory, softDeletes, InteractsWithMedia;

    protected $fillable = ['title','unit_id', 'description', 'urgency', 'purpose', 'area', 'price', 'user_id', 'customer_id', 'agency_id', 'category_id', 'sub_category_id', 'video_url','property_detail_id', 'address_id', 'status_id'];

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

    public function propertyDetail()
    {
        return $this->belongsTo(PropertyDetail::class);
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
}

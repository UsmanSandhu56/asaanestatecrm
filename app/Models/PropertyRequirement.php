<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyRequirement extends Model
{
    use HasFactory, softDeletes;

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

    public function propertyRequirementDetail()
    {
        return $this->belongsTo(PropertyRequirementDetail::class);
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
}

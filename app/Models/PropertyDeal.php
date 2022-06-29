<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyDeal extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['user_id', 'agency_id', 'agency_commission', 'agent_commission', 'amount', 'property_id', 'property_requirement_id', 'is_confirmed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function propertyRequirement()
    {
        return $this->belongsTo(PropertyRequirement::class);
    }

    public function scopeUserAgency($query)
    {
        return $query->where('agency_id', session('agency_id'));
    }
}

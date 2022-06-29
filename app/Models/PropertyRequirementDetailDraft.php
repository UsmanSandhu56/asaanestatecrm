<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PropertyRequirementDetailDraft extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = ['user_id', 'agency_id', 'parking_space', 'year_build', 'max_rooms', 'min_rooms', 'max_bathrooms', 'min_bathrooms', 'location', 'country', 'city', 'latitude', 'longitude', 'sublocality_level_1', 'sublocality_level_2', 'sublocality_level_3'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function property_requirement_draft()
    {
        return $this->belongsTo('App\Models\PropertyRequirementDraft','property_requirement_detail_id','id');
    }
}

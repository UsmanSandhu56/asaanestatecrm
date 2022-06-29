<?php

namespace App\Models;

use App\Models\PropertyDraft;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['street_address', 'country', 'city', 'location', 'latitude', 'longitude', 'sublocality_level_1', 'sublocality_level_2', 'sublocality_level_3'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function drafts()
    {
        return $this->belongsTo(PropertyDraft::class);
    }
}

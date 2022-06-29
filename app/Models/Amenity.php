<?php

namespace App\Models;

use App\Models\PropertyDraft;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Amenity extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['type', 'description'];

    public function properties()
    {
        return $this->belongsToMany(Property::class)->withTimestamps();
    }
    public function drafts()
    {
        return $this->belongsToMany(PropertyDraft::class)->withTimestamps();
    }

    public function propertyRequirements()
    {
        return $this->belongsToMany(PropertyRequirement::class)->withTimestamps();
    }
}

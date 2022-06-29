<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'email', 'phone_no', 'type', 'user_id', 'agency_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
    public function drafts()
    {
        return $this->hasMany(PropertyDraft::class);
    }
    public function propertyRequirements()
    {
        return $this->hasMany(PropertyRequirement::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function scopeUserAgency($query)
    {
        return $query->where('agency_id', session('agency_id'));
    }

    public function scopePhone($query, $search)
    {
        return $query->where('phone_no', 'like', '%' . $search . '%');
    }
}

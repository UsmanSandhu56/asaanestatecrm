<?php

namespace App\Models;

use App\Models\PropertyDraft;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agency extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = ['name', 'address', 'email', 'phone_no','zameen_url'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('profile')
            ->useFallbackUrl('media/profile-placeholder.png')
            ->useFallbackPath(public_path('media/profile-placeholder.png'));
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('commission')->withTimestamps();
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
    public function drafts()
    {
        return $this->hasMany(PropertyDraft::class);
    }
    public function property_requirements()
    {
        return $this->hasMany(PropertyRequirement::class);
    }
}

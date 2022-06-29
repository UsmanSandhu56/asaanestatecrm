<?php

namespace App\Models;

use App\Models\PropertyDraft;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Traits\HasPermissionsTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'is_active',
        'password',
        'phone_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function agencies()
    {
        return $this->belongsToMany(Agency::class)->withPivot('commission')->withTimestamps();
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
    public function drafts()
    {
        return $this->hasMany(PropertyDraft::class);
    }
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function propertyRequirements()
    {
        return $this->hasMany(PropertyRequirement::class);
    }

    public function propertyDeals()
    {
        return $this->hasMany(PropertyDeal::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $fillable = ['name', 'slug', 'agency_id'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles')->withPivot('agency_id')->withTimestamps();
    }

    public function scopeUserAgency($query)
    {
        return $query->where('agency_id', session('agency_id'));
    }
}

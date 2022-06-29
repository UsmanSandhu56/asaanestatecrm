<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PropertyDetailDraft extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = ['rooms', 'bathrooms', 'parking_space', 'year_build'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function drafts()
    {
        return $this->belongsTo(PropertyDraft::class);
    } 
}

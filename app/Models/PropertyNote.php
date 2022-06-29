<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyNote extends Model
{
    use HasFactory, softDeletes;

    use HasFactory, SoftDeletes;

    protected $fillable = ['property_id', 'note_id', 'user_id', 'agency_id'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function note()
    {
        return $this->hasOne(Note::class);
    }
}

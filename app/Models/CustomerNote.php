<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerNote extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['customer_id', 'note_id', 'user_id', 'agency_id'];

    public function note()
    {
        return $this->hasOne(Note::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyRequirementTransactionType extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['trans_type_id', 'property_req_id', 'user_id', 'agency_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function property_requirement()
    {
        return $this->belongsTo(PropertyRequirement::class, 'property_req_id');
    }

    public function transaction_type()
    {
        return $this->hasOne(TransactionType::class, 'trans_type_id');
    }
}

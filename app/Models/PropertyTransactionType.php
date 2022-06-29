<?php

namespace App\Models;

use App\Models\PropertyDraft;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyTransactionType extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['user_id', 'agency_id', 'transaction_type_id', 'property_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    
    public function drafts()
    {
        return $this->belongsTo(PropertyDraft::class);
    }

    public function transaction_type()
    {
        return $this->hasOne(TransactionType::class);
    }
}

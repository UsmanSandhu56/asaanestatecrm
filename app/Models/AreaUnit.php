<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaUnit extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['name', 'value'];
}

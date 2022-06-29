<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;

class PropertyShareController extends Controller
{
    public function __invoke(Property $property)
    {
        return view('frontend.property.share', compact('property'));
    }
}

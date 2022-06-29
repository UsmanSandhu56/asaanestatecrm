<?php


namespace App\Http\Traits;


use App\Models\SubCategory;

trait CategoryTrait
{
    public function updatedCategory($value)
    {
        $this->subCategories = SubCategory::where('category_id', $value)->get();
    }
}

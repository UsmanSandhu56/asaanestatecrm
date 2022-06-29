<?php


namespace App\Http\Traits;


use App\Models\SubCategory;

trait SubCategoryTrait
{
    public $purpose, $category_id, $sub_category_id, $subCategories;

    public function getSubcategories($value)
    {
        ($value !== 1) ? $this->show = false : $this->show = true;
        if ($this->purpose == 0 && $this->category_id == 1) {
            $this->subCategories = SubCategory::where('category_id', $value)->whereNotIn('id', [3, 4, 6])->get();
        } else {
            $this->subCategories = SubCategory::where('category_id', $value)->get();
        }
        $this->sub_category_id = $this->subCategories->first()->id ?? null;
    }
}

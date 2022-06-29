<?php

namespace App\Http\Livewire\Admin\PropertyRequirements;

use Livewire\Component;
use App\Models\AreaUnit;
use App\Models\Category;
use App\Models\Property;
use App\Models\SubCategory;
use App\Models\StatusReason;

use App\Http\Traits\AreaTrait;
use App\Http\Traits\PriceTrait;
use App\Services\PropertyService;
use App\Http\Traits\CategoryTrait;
use App\Services\AutoMatchService;
use Illuminate\Support\Facades\DB;
use App\Services\PropertyRequirementService;

use App\Models\PropertyRequirement;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PropertyRequirementDraft extends Component
{
  
    use PriceTrait, AreaTrait, CategoryTrait, AuthorizesRequests;

    public $matches, $categories, $category, $subCategories, $purpose, $category_id,
        $sub_category_id, $max_price, $min_price, $areaUnit, $unit_id, $units, $city, $location, $bathrooms, $rooms, $year_build,
        $longitude, $latitude, $sub_locality_1, $sub_locality_2, $sub_locality_3, $filterCounter = null, $propertyIdBeingRemoved = null;

    public function render()
    {
        $propertyRequirement = PropertyRequirementService::checkPermissions()->paginate(10);

        return view('livewire.admin.property-requirements.property-requirement-draft', ['propertyRequirement' => $propertyRequirement]);

       
    }

    public function mount()
    {
      $this->reasons = StatusReason::all();
        $this->categories = Category::all();
        $this->category_id = 1;
        $this->purpose = 0;
        $this->unit_id = 4;
        $this->areaUnit = 'Marla';
        $this->units = AreaUnit::all();
        $this->year_build = now()->year;
        $this->subCategories = SubCategory::where('category_id', 1)->get();
        $this->updatedAreaUnit('4');
        $this->setPrices(); 

    }

    public function filter()
    {
        $filterData = PropertyService::filterProperties($this->purpose, $this->category_id, $this->sub_category_id,
            $this->max_price, $this->min_price, $this->min_area, $this->max_area, $this->unit_id, $this->city, $this->location,
            $this->bathrooms, $this->rooms);
        $this->matches = $filterData['properties'];
        $this->filterCounter = $filterData['filterCounter'];
    }

    public function confirmPropertyRemoval(Property $property)
    {
        $this->propertyIdBeingRemoved = $property;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function destroy()
    {
        $this->authorize('property-delete');
        DB::transaction(function () {
            $this->propertyIdBeingRemoved->address()->delete();
            $this->propertyIdBeingRemoved->propertyDetail()->delete();
            $this->propertyIdBeingRemoved->amenities()->detach();
            $this->propertyIdBeingRemoved->delete();
        });
        $this->dispatchBrowserEvent('hide-delete-modal', ['success' => 'Property deleted successfully!']);
    }
}

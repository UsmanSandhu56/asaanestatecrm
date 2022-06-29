<?php

namespace App\Http\Livewire\Admin\Properties;

use App\Http\Traits\AreaTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\PriceTrait;
use App\Models\AreaUnit;
use App\Models\Category;
use App\Models\Property;
use App\Models\PropertyRequirement;
use App\Models\SubCategory;
use App\Services\AutoMatchService;
use App\Services\PropertyRequirementService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PropertyRequirementMatches extends Component
{
    use PriceTrait, AreaTrait, CategoryTrait, AuthorizesRequests;

    public $matches, $categories, $category, $subCategories, $purpose, $category_id,
        $sub_category_id, $max_price, $min_price, $min_area, $max_area, $areaUnit, $unit_id, $units, $city, $location, $min_bathrooms, $max_bathrooms, $min_rooms, $max_rooms, $year_build,
        $longitude, $latitude, $sub_locality_1, $sub_locality_2, $sub_locality_3, $filterCounter = null, $propertyRequirementIdBeingRemoved = null;

    public function render()
    {
        return view('livewire.admin.properties.property-requirement-matches');
    }

    public function mount(Property $property)
    {
        $this->unit_id = 4;
        $this->areaUnit = 'Marla';
        $this->units = AreaUnit::all();
        $this->updatedAreaUnit('4');
        $this->setPrices();
        $this->categories = Category::all();
        $this->category_id = $property->category_id;
        $this->subCategories = SubCategory::where('category_id', $property->category_id)->get();
        $this->purpose = $property->purpose;
        $this->city = $property->address->city;
        $this->location = $property->address->location;
        $this->min_price = $property->price;
        $this->max_price = $property->price;
        $this->min_area = $property->area;
        $this->max_area = $property->area;
        $this->year_build = $property->propertyDetail ? $property->propertyDetail->year_build : '';
        $this->min_bathrooms = $property->propertyDetail ? $property->propertyDetail->bathrooms : '';
        $this->max_bathrooms = $property->propertyDetail ? $property->propertyDetail->bathrooms : '';
        $this->min_rooms = $property->propertyDetail ? $property->propertyDetail->rooms : '';
        $this->max_rooms = $property->propertyDetail ? $property->propertyDetail->rooms : '';
        $filterData = AutoMatchService::autoMatchPropertyRequirement($property);
        $this->matches = $filterData['matches'];
        $this->filterCounter = $filterData['filterCounter'];
    }

    public function filter()
    {
        $filterData = PropertyRequirementService::filterPropertyRequirements($this->purpose, $this->category_id, $this->sub_category_id,
            $this->max_price, $this->min_price, $this->min_area, $this->max_area, $this->unit_id, $this->city, $this->location,
            $this->min_bathrooms, $this->max_bathrooms, $this->min_rooms, $this->max_rooms);
        $this->matches = $filterData['propertyRequirements'];
        $this->filterCounter = $filterData['filterCounter'];
    }

    public function confirmPropertyRequirementRemoval(PropertyRequirement $propertyRequirement)
    {
        $this->propertyRequirementIdBeingRemoved = $propertyRequirement;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function destroy()
    {
        $this->authorize('property-requirement-delete');
        DB::transaction(function () {
            $this->propertyRequirementIdBeingRemoved->propertyRequirementDetail()->delete();
            $this->propertyRequirementIdBeingRemoved->amenities()->detach();
            $this->propertyRequirementIdBeingRemoved->delete();
        });
        $this->dispatchBrowserEvent('hide-delete-modal', ['success' => 'Property Requirement deleted successfully!']);
    }
}

<?php

namespace App\Http\Livewire\Admin\PropertyRequirements;

use App\Http\Traits\AreaTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\PriceTrait;
use App\Models\AreaUnit;
use App\Models\Category;
use App\Models\Property;
use App\Models\PropertyRequirement;
use App\Models\SubCategory;
use App\Services\AutoMatchService;
use App\Services\PropertyService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PropertyMatches extends Component
{
    use PriceTrait, AreaTrait, CategoryTrait, AuthorizesRequests;

    public $matches, $categories, $category, $subCategories, $purpose, $category_id,
        $sub_category_id, $max_price, $min_price, $areaUnit, $unit_id, $units, $city, $location, $bathrooms, $rooms, $year_build,
        $longitude, $latitude, $sub_locality_1, $sub_locality_2, $sub_locality_3, $filterCounter = null, $propertyIdBeingRemoved = null;

    public function render()
    {
        return view('livewire.admin.property-requirements.property-matches');
    }

    public function mount(PropertyRequirement $propertyRequirement)
    {
        $this->unit_id = 4;
        $this->areaUnit = 'Marla';
        $this->units = AreaUnit::all();
        $this->updatedAreaUnit('4');
        $this->setPrices();
        $this->categories = Category::all();
        $this->category_id = $propertyRequirement->category_id;
        $this->subCategories = SubCategory::where('category_id', $propertyRequirement->category_id)->get();
        $this->purpose = $propertyRequirement->purpose;
        $this->city = $propertyRequirement->propertyRequirementDetail->city;
        $this->location = $propertyRequirement->propertyRequirementDetail->location;
        $this->min_price = $propertyRequirement->propertyRequirementDetail->min_price;
        $this->max_price = $propertyRequirement->propertyRequirementDetail->max_price;
        $this->min_area = $propertyRequirement->propertyRequirementDetail->min_area;
        $this->max_area = $propertyRequirement->propertyRequirementDetail->max_area;
        $this->year_build = $propertyRequirement->propertyRequirementDetail->year_build;
        $this->min_bathrooms = $propertyRequirement->propertyRequirementDetail->min_bathrooms;
        $this->max_bathrooms = $propertyRequirement->propertyRequirementDetail->max_bathrooms;
        $this->min_rooms = $propertyRequirement->propertyRequirementDetail->min_rooms;
        $this->max_rooms = $propertyRequirement->propertyRequirementDetail->max_rooms;
        $filterData = AutoMatchService::autoMatchProperty($propertyRequirement);
        $this->matches = $filterData['matches'];
        $this->filterCounter = $filterData['filterCounter'];
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

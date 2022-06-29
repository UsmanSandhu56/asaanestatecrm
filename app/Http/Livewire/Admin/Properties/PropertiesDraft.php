<?php

namespace App\Http\Livewire\Admin\Properties;

use Livewire\Component;
use App\Models\AreaUnit;
use App\Models\Category;
use App\Models\Property;
use App\Models\SubCategory;
use App\Models\PropertyDraft;
use App\Http\Traits\AreaTrait;
use App\Http\Traits\PriceTrait;
use App\Services\PropertyService;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\LoadMoreTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PropertiesDraft extends Component
{
    use PriceTrait, AreaTrait, CategoryTrait, AuthorizesRequests, LoadMoreTrait;

    public $categories, $category, $subCategories, $propertyIdBeingRemoved = null, $purpose, $category_id,
        $sub_category_id, $max_price, $min_price, $min_area, $max_area, $areaUnit, $unit_id, $units, $city, $location, $bathrooms, $rooms, $year_build,
        $longitude, $latitude, $sub_locality_1, $sub_locality_2, $totalRecords,$sub_locality_3, $filterCounter = null;

    public function render()
    {

        $properties = PropertyService::checkDraftPermission()->paginate($this->perPage);
        $this->totalRecords = $properties->total();

        return view('livewire.admin.properties.propertiesDraft', ['properties' => $properties]);
    }

    public function mount()
    {
        $this->categories = Category::all();
        $this->category_id = 1;
        $this->purpose = 0;
        $this->unit_id = 4;
        $this->areaUnit = 'Marla';
        $this->units = AreaUnit::all();
        $this->updatedAreaUnit('4');
        $this->setPrices();
        $this->year_build = now()->year;
        $this->subCategories = SubCategory::where('category_id', 1)->get();
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
            $this->propertyIdBeingRemoved->propertyDetailDraft()->delete();
            $this->propertyIdBeingRemoved->amenities()->detach();
            $this->propertyIdBeingRemoved->delete();
        });
        $this->dispatchBrowserEvent('hide-delete-modal', ['success' => 'Property deleted successfully!']);
    }

    public function filter()
    {
        $filterData = PropertyService::filterProperties($this->purpose, $this->category_id, $this->sub_category_id,
            $this->max_price, $this->min_price, $this->min_area, $this->max_area, $this->unit_id, $this->city, $this->location,
            $this->bathrooms, $this->rooms);
        $this->properties = $filterData['properties'];
        $this->filterCounter = $filterData['filterCounter'];
    }
}

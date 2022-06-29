<?php

namespace App\Http\Livewire\Admin\PropertyRequirements;

use App\Http\Traits\AreaTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\LoadMoreTrait;
use App\Http\Traits\PriceTrait;
use App\Models\AreaUnit;
use App\Models\Category;
use App\Models\PropertyRequirement;
use App\Models\StatusReason;
use App\Models\SubCategory;
use App\Services\PropertyRequirementService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PropertyRequirements extends Component
{
    use PriceTrait, AreaTrait, CategoryTrait, AuthorizesRequests, LoadMoreTrait;

    public $propertyRequirementIdBeingRemoved = null, $propertyRequirementReason = null, $categories, $category, $subCategories, $purpose, $category_id,
        $sub_category_id, $max_price, $min_price, $min_area, $max_area, $areaUnit, $city, $location, $min_bathrooms, $max_bathrooms, $min_rooms, $max_rooms, $year_build,
        $longitude, $latitude, $sub_locality_1, $sub_locality_2, $totalRecords,$sub_locality_3, $filterCounter = null, $unit_id, $units, $reasons, $status_reasons_id;

    public function render()
    {
        $propertyRequirements = PropertyRequirementService::checkPermission()->paginate($this->perPage);
        $this->totalRecords = $propertyRequirements->total();
        return view('livewire.admin.property-requirements.property-requirements', ['propertyRequirements' => $propertyRequirements]);
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

    public function filter()
    {
        $filterData = PropertyRequirementService::filterPropertyRequirements($this->purpose, $this->category_id, $this->sub_category_id,
            $this->max_price, $this->min_price, $this->min_area, $this->max_area, $this->unit_id, $this->city, $this->location,
            $this->min_bathrooms, $this->max_bathrooms, $this->min_rooms, $this->max_rooms);
        $this->propertyRequirements = $filterData['propertyRequirements'];
        $this->filterCounter = $filterData['filterCounter'];
    }

    public function confirmRequirementReason(PropertyRequirement $propertyRequirement)
    {
        $this->propertyRequirementReason = $propertyRequirement;
        $this->dispatchBrowserEvent('show-reason-modal');
    }

    public function closeRequirement()
    {
        $this->propertyRequirementReason->update(['status_id' => 7, 'status_reasons_id' => $this->status_reasons_id]);
        $this->dispatchBrowserEvent('hide-reason-modal', ['success' => 'Property Requirement Archived successfully!']);
    }
}

<?php

namespace App\Http\Livewire\Admin\Deals;

use App\Http\Traits\LoadMoreTrait;
use App\Models\PropertyDeal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ClosedDeals extends Component
{
    use AuthorizesRequests, LoadMoreTrait;

    public $totalRecords;

    public function mount()
    {
        $closeDeals = PropertyDeal::userAgency();
        if(auth()->user()->hasRole('owner')){
            $this->totalRecords = $closeDeals->count();
        }else{
            $this->totalRecords = $closeDeals->where('user_id',auth()->id())->count();
        }
    }

    public function render()
    {
        if (auth()->user()->can('closed-deal-all-list')) {
            $deals = PropertyDeal::with(['agency', 'property', 'propertyRequirement'])->userAgency()->get();
        } else {
            $this->authorize('closed-deal-list');
            $deals = PropertyDeal::with(['agency', 'property', 'propertyRequirement'])->userAgency()->where(['user_id' => auth()->id()])->get();
        }
        return view('livewire.admin.deals.closed-deals', ['deals' => $deals]);
    }
}

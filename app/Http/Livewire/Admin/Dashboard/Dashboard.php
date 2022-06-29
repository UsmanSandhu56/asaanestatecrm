<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Property;
use App\Models\User;
use Livewire\Component;
use App\Models\PropertyDeal;
use App\Models\PropertyRequirement;

class Dashboard extends Component
{
    public $days = [], $total = [], $sold = [], $tenanted = [], $records;

    public function updatedRecords($date)
    {
        $totalDeals = PropertyDeal::where('agency_id', session('agency_id'))
            ->where('created_at', '>=', $date)
            ->get()
            ->groupBy(function ($date) {
                return ($date->created_at)->format('d/m');
            });
        $dayCount = [];
        $sold = 0;
        $tenanted = 0;
        $total_sold = [];
        $total_tenanted = [];
        foreach ($totalDeals as $key => $deal) {
            $dayCount[$key] = $deal->count();
            foreach ($deal as $dl) {
                if (Property::find($dl->property_id)->purpose === 0) {
                    $sold++;
                } else {
                    $tenanted++;
                }
            }
            $total_sold[$key] = $sold;
            $total_tenanted[$key] = $tenanted;
            $sold = 0;
            $tenanted = 0;
        }
        $this->tenanted = array_values(array_filter($total_tenanted));
        $this->sold = array_values(array_filter($total_sold));
        $this->days = array_keys($dayCount);
        $this->total = array_values($dayCount);
    }

    public function render()
    {
        $this->updatedRecords(now()->subDays(7));
        $this->emit('setGraphData', $this->tenanted, $this->sold, $this->days, $this->total);
        $deals = PropertyDeal::with(['property'])
            ->where('agency_id', session('agency_id'))
            ->whereRelation('user.roles', 'slug', '=', 'owner')
            ->latest()->get();
        $missedDeals = PropertyRequirement::with(['customer'])
            ->where(['agency_id' => session('agency_id')])
            ->whereRelation('status', 'status', 'Archived')
            ->whereRelation('user.roles', 'slug', '!=', 'owner')
            ->latest()->take(5)->get();
        $propertyRequirements = PropertyRequirement::where('agency_id', session('agency_id'))
            ->with(['customer', 'status'])
            ->whereRelation('user.roles', 'slug', '!=', 'owner')
            ->where('agency_id', session('agency_id'))
            ->latest()->inRandomOrder()->get();

        if (auth()->user()->hasRole('owner')) {
            $deals = $deals->load('user');
            $agency_commission = $deals->sum('agency_commission');
            $agent_commission = $deals->sum('agent_commission');
            $missedDeals = $missedDeals->load('user');
            $propertyRequirements = $propertyRequirements->load('user');
            $top_agents = User::withCount(['propertyDeals', 'propertyRequirements' => function ($q) {
                $q->where('status_id', 7);
            }])
                ->withSum('propertyDeals', 'agent_commission')
                ->whereRelation('agencies', 'agency_id', session('agency_id'))
                ->orderBy('property_deals_count', 'DESC')
                ->whereRelation('roles', 'slug', '!=', 'owner')->take(5)->get();
            return view('livewire.admin.dashboard.dashboard', ['deals' => $deals, 'missedDeals' => $missedDeals, 'agent_commission' => $agent_commission, 'agency_commission' => $agency_commission, 'propertyRequirements' => $propertyRequirements, 'top_agents' => $top_agents]);
        }

        if (auth()->user()->hasRole('agent')) {
            $deals = $deals->where('user_id', auth()->id());
            $agent_commission = $deals->sum('agent_commission');
            $missedDeals = $missedDeals->where('user_id', auth()->id());
            $propertyRequirements = $propertyRequirements->where('user_id', auth()->id());
            return view('livewire.admin.dashboard.dashboard', ['deals' => $deals, 'missedDeals' => $missedDeals, 'agent_commission' => $agent_commission, 'propertyRequirements' => $propertyRequirements]);
        }
        return view('livewire.admin.dashboard.dashboard');
    }
}

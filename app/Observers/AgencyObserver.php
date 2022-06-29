<?php

namespace App\Observers;

use App\Models\Agency;
use App\Services\AgencyService;

class AgencyObserver
{
    /**
     * Handle the Agency "created" event.
     *
     * @param \App\Models\Agency $agency
     * @return void
     */
    public function created(Agency $agency)
    {
        auth()->user()->agencies()->attach($agency->id,['commission'=>config('commission.percentage.commission')]);
        AgencyService::assignRoleWithPermission($agency);
    }
}

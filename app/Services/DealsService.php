<?php


namespace App\Services;


use App\Models\PropertyDeal;
use Illuminate\Support\Facades\DB;

class DealsService
{
    public static function deals($validatedData)
    {
        $propertyDeal = collect();
        DB::transaction(function () use (&$propertyDeal, $validatedData) {
            $propertyDeal = PropertyDeal::create($validatedData + [
                    'user_id' => auth()->id(), 'agency_id' => session('agency_id'),
                    'property_id' => $validatedData['property']['id'], 'property_requirement_id' => $validatedData['propertyRequirement']['id'],
                ]);
        });
        return $propertyDeal;
    }

    public static function agentCommissions($commission)
    {
        $percentage = auth()->user()->agencies()->first()->pivot->commission;
        if (!empty($commission)) {
            return ($percentage * $commission) / 100;
        }
        return null;
    }

    public static function validation()
    {
        return [
            'amount' => ['required', 'numeric'],
            'agency_commission' => ['required', 'numeric'],
            'agent_commission' => ['required', 'numeric'],
            'propertyRequirement' => ['required'],
            'property' => ['required'],
        ];
    }
}

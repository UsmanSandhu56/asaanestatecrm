<?php

namespace App\Services;

use App\Models\Property;
use App\Models\PropertyRequirement;

class AutoMatchService
{
    public static function autoMatchProperty($propertyRequirement)
    {
        $filterCounter = null;
        $matches = Property::with(['media', 'address', 'customer'])->where([
            'agency_id' => session('agency_id'),
            'purpose' => $propertyRequirement->purpose,
            'category_id' => $propertyRequirement->category_id,
            'sub_category_id' => $propertyRequirement->sub_category_id,
            'urgency' => $propertyRequirement->urgency
        ])
            ->whereRelation('address', 'city', $propertyRequirement->propertyRequirementDetail->city);

        $filterCounter = 7;
        if (!empty($propertyRequirement->min_price) || !empty($propertyRequirement->max_price)) {
            if ($matches->get()->whereBetween('price', [$propertyRequirement->min_price, $propertyRequirement->max_price])->count() > 0) {
                $matches->whereBetween('price', [$propertyRequirement->min_price, $propertyRequirement->max_price]);
                $filterCounter++;
            }
        }
        if (!empty($propertyRequirement->min_area) || !empty($propertyRequirement->max_price)) {
            if ($matches->get()->whereBetween('area', [$propertyRequirement->min_area, $propertyRequirement->max_area])->count() > 0) {
                $matches->whereBetween('area', [$propertyRequirement->min_area, $propertyRequirement->max_area]);
                $filterCounter++;
            }
        }
        if (!empty($propertyRequirement->propertyRequirementDetail->location)) {
            foreach ($matches->get() as $match) {
                if ($match->address->where('location', $propertyRequirement->propertyRequirementDetail->location)->exists()) {
                    $matches->whereRelation('address', 'location', $propertyRequirement->propertyRequirementDetail->location);
                    $filterCounter++;
                    break;
                }
            }
        }
        if ($propertyRequirement->category_id === 1) {
            if (!empty($propertyRequirement->propertyRequirementDetail->min_bathrooms)) {
                foreach ($matches->get() as $match) {
                    if ($match->propertyDetail->where('bathrooms', '>=', $propertyRequirement->propertyRequirementDetail->min_bathrooms)->exists()) {
                        $matches->whereRelation('propertyDetail', 'bathrooms', '>=', $propertyRequirement->propertyRequirementDetail->min_bathrooms);
                        $filterCounter++;
                        break;
                    }
                }
            }
            if (!empty($propertyRequirement->propertyRequirementDetail->max_bathrooms)) {
                foreach ($matches->get() as $match) {
                    if ($match->propertyDetail->where('bathrooms', '<=', $propertyRequirement->propertyRequirementDetail->max_bathrooms)->exists()) {
                        $matches->whereRelation('propertyDetail', 'bathrooms', '<=', $propertyRequirement->propertyRequirementDetail->max_bathrooms);
                        $filterCounter++;
                        break;
                    }
                }
            }
            if (!empty($propertyRequirement->propertyRequirementDetail->min_rooms)) {
                foreach ($matches->get() as $match) {
                    if ($match->propertyDetail->where('rooms', '>=', $propertyRequirement->propertyRequirementDetail->min_rooms)->exists()) {
                        $matches->whereRelation('propertyDetail', 'rooms', '>=', $propertyRequirement->propertyRequirementDetail->min_rooms);
                        $filterCounter++;
                        break;
                    }
                }
            }
            if (!empty($propertyRequirement->propertyRequirementDetail->max_rooms)) {
                foreach ($matches->get() as $match) {
                    if ($match->propertyDetail->where('rooms', '<=', $propertyRequirement->propertyRequirementDetail->max_rooms)->exists()) {
                        $matches->whereRelation('propertyDetail', 'rooms', '<=', $propertyRequirement->propertyRequirementDetail->max_rooms);
                        $filterCounter++;
                        break;
                    }
                }
            }
            if (!empty($propertyRequirement->propertyRequirementDetail->parking_space)) {
                foreach ($matches->get() as $match) {
                    if ($match->propertyDetail->where('parking_space', $propertyRequirement->propertyRequirementDetail->parking_space)->exists()) {
                        $matches->whereRelation('propertyDetail', 'parking_space', $propertyRequirement->propertyRequirementDetail->parking_space);
                        $filterCounter++;
                        break;
                    }
                }
            }
            if (!empty($propertyRequirement->propertyRequirementDetail->year_build)) {
                foreach ($matches->get() as $match) {
                    if ($match->propertyDetail->where('year_build', $propertyRequirement->propertyRequirementDetail->year_build)->exists()) {
                        $matches->whereRelation('propertyDetail', 'year_build', $propertyRequirement->propertyRequirementDetail->year_build);
                        $filterCounter++;
                        break;
                    }
                }
            }
        }
        return [
            'matches' => $matches->get(),
            'filterCounter' => $filterCounter,
        ];
    }

    public static function autoMatchPropertyRequirement($property)
    {
        $filterCounter = null;
        $matches = PropertyRequirement::with(['propertyRequirementDetail', 'customer', 'amenities'])->where([
            'agency_id' => session('agency_id'),
            'purpose' => $property->purpose,
            'category_id' => $property->category_id,
            'sub_category_id' => $property->sub_category_id,
            'urgency' => $property->urgency
        ])->whereRelation('propertyRequirementDetail', 'city', $property->address->city);
        $filterCounter = 5;
        if (!empty($property->price)) {
            if ($matches->get()->where('min_price', $property->price)->count() > 0 || $matches->get()->where('max_price', $property->price)->count() > 0) {
                $price = $property->price;
                $matches->where(function ($query) use ($price) {
                    $query->where('min_price', '<=', $price);
                    $query->where('max_price', '>=', $price);
                })->get();
                $filterCounter++;
            }
        }
        if (!empty($property->area)) {
            if ($matches->get()->where('min_area', $property->area)->count() > 0 || $matches->get()->where('max_area', $property->area)->count() > 0) {
                $area = $property->area;
                $matches->where(function ($query) use ($area) {
                    $query->where('min_area', '<=', $area);
                    $query->where('max_area', '>=', $area);
                })->get();
                $filterCounter++;
            }
        }
        if (!empty($property->address->location)) {
            foreach ($matches->get() as $match) {
                if ($match->propertyRequirementDetail->where('location', $property->address->location)->exists()) {
                    $matches->whereRelation('propertyRequirementDetail', 'location', $property->address->location);
                    $filterCounter++;
                    break;
                }
            }
        }

        if ($property->category_id === 1) {
            if (!empty($property->propertyDetail->bathrooms)) {
                foreach ($matches->get() as $match) {
                    if ($match->propertyRequirementDetail->where('min_bathrooms', '<=', $property->propertyDetail->bathrooms)->exists()) {
                        $matches->whereRelation('propertyRequirementDetail', 'min_bathrooms', '<=', $property->propertyDetail->bathrooms);
                        $filterCounter++;
                        break;
                    }
                }
                foreach ($matches->get() as $match) {
                    if ($match->propertyRequirementDetail->where('max_bathrooms', '>=', $property->propertyDetail->bathrooms)->exists()) {
                        $matches->whereRelation('propertyRequirementDetail', 'max_bathrooms', '>=', $property->propertyDetail->bathrooms);
                        $filterCounter++;
                        break;
                    }
                }
            }
            if (!empty($property->propertyDetail->rooms)) {
                foreach ($matches->get() as $match) {
                    if ($match->propertyRequirementDetail->where('min_rooms', '<=', $property->propertyDetail->rooms)->exists()) {
                        $matches->whereRelation('propertyRequirementDetail', 'min_rooms', '<=', $property->propertyDetail->rooms);
                        $filterCounter++;
                        break;
                    }
                }
                foreach ($matches->get() as $match) {
                    if ($match->propertyRequirementDetail->where('max_rooms', '>=', $property->propertyDetail->rooms)->exists()) {
                        $matches->whereRelation('propertyRequirementDetail', 'max_rooms', '>=', $property->propertyDetail->rooms);
                        $filterCounter++;
                        break;
                    }
                }
            }
            if (!empty($property->propertyDetail->parking_space)) {
                foreach ($matches->get() as $match) {
                    if ($match->propertyRequirementDetail->where('parking_space', $property->propertyDetail->parking_space)->exists()) {
                        $matches->whereRelation('propertyRequirementDetail', 'parking_space', $property->propertyDetail->parking_space);
                        $filterCounter++;
                        break;
                    }
                }
            }
            if (!empty($property->propertyDetail->year_build)) {
                foreach ($matches->get() as $match) {
                    if ($match->propertyRequirementDetail->where('year_build', $property->propertyDetail->year_build)->exists()) {
                        $matches->whereRelation('propertyRequirementDetail', 'year_build', $property->propertyDetail->year_build);
                        $filterCounter++;
                        break;
                    }
                }
            }
        }
        return [
            'matches' => $matches->get(),
            'filterCounter' => $filterCounter,
        ];
    }
}

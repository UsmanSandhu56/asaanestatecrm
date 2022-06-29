<?php


namespace App\Services;


class PriceService
{
    public static function getMinMaxPrices()
    {
        return [
            'min_price' => [500000, 1000000, 2000000, 3500000, 5000000, 6500000, 8000000, 10000000, 12500000, 17500000, 20000000, 25000000, 30000000, 40000000, 50000000, 75000000, 100000000, 250000000],
            'max_price' => [500000, 1000000, 2000000, 3500000, 5000000, 6500000, 8000000, 10000000, 12500000, 17500000, 20000000, 25000000, 30000000, 40000000, 50000000, 75000000, 100000000, 250000000, 500000000]
        ];
    }
}
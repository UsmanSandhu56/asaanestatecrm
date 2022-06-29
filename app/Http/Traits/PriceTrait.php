<?php


namespace App\Http\Traits;

use App\Services\PriceService;

trait PriceTrait
{
    public $minPrices = [], $maxPrices = [];

    public function setPrices()
    {
        $prices = PriceService::getMinMaxPrices();
        $this->minPrices = $prices['min_price'];
        $this->maxPrices = $prices['max_price'];
    }
}

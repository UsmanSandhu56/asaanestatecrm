<?php


namespace App\Http\Traits;


use App\Services\AreaUnitService;

trait AreaTrait
{
    public $areaUnitMinValue = [], $areaUnitMaxValue = [];

    public function updatedAreaUnit($areaUnit)
    {
        $this->areaUnit = AreaUnitService::setAreaUnit($areaUnit);
        $areaUnitValues = AreaUnitService::getAreaUnitValue($areaUnit);
        $this->areaUnitMinValue = $areaUnitValues['areaUnitMinValue'];
        $this->areaUnitMaxValue = $areaUnitValues['areaUnitMaxValue'];
    }
}

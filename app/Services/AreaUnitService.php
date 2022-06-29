<?php

namespace App\Services;


use App\Models\AreaUnit;

class AreaUnitService
{
    public static function propertyAreaUnitConversation($value)
    {
    //    1sqrmtr = 10.7639;
    //    1sqryrd = 9;
    //    1marla = 272.251;
    //    knal= 5445

    if($value['unit_id']=='1')
    {
        return $value['area'];

    }
    if($value['unit_id']=='2')
    {
        $value['area'] = str_replace( ',', '', $value['area'] );


        return $value['area'] * 10.7639;

    }
    if($value['unit_id']=='3')
    {
        $value['area'] = str_replace( ',', '', $value['area'] );

        return $value['area'] * 9;

    }
    if($value['unit_id']=='4')
    {
        $value['area'] = str_replace( ',', '', $value['area'] );

        return $value['area'] * 272.251;

    }
    if($value['unit_id']=='5')
    {
        $value['area'] = str_replace( ',', '', $value['area'] );

        return $value['area'] * 5445;
    }
    }

    public static function editPropertyAreaUnitConversation($value)
    {


    if($value['unit_id']=='1')
    {
        return $value['area'];

    }
    if($value['unit_id']=='2')
    {
        return $value['area'] / 10.7639;

    }
    if($value['unit_id']=='3')
    {
        return $value['area'] / 9;


    }
    if($value['unit_id']=='4')
    {
        return $value['area'] / 272.251;

    }
    if($value['unit_id']=='5')
    {
        return $value['area'] / 5445;

    }


    }

    public static function propertyRequirementAreaUnitConversation($value)
    {

    if($value['unit_id']=='1')
    {
        $value['max_area'] = str_replace( ',', '', $value['max_area'] );
        $value['min_area'] = str_replace( ',', '', $value['min_area'] );
        $area['max_area'] = $value['max_area'];
        $area['min_area'] = $value['min_area'];


    }
    if($value['unit_id']=='2')
    {
        $value['max_area'] = str_replace( ',', '', $value['max_area'] );
        $value['min_area'] = str_replace( ',', '', $value['min_area'] );
        $area['min_area']= $value['min_area'] * 10.7639;
        $area['max_area']= $value['max_area'] * 10.7639;


    }
    if($value['unit_id']=='3')
    {
        $value['max_area'] = str_replace( ',', '', $value['max_area'] );
        $value['min_area'] = str_replace( ',', '', $value['min_area'] );
        $area['min_area']= $value['min_area'] * 9;
        $area['max_area']= $value['max_area'] * 9;

    }
    if($value['unit_id']=='4')
    {
        // dd($value['max_area']);
        $value['max_area'] = str_replace( ',', '', $value['max_area'] );
        $value['min_area'] = str_replace( ',', '', $value['min_area'] );
        $area['min_area']= $value['min_area'] * 272.251;
        $area['max_area']= $value['max_area'] * 272.251;


    }
    if($value['unit_id'] == '5')
    {

        $value['max_area'] = str_replace( ',', '', $value['max_area'] );
        $value['min_area'] = str_replace( ',', '', $value['min_area'] );

        $area['min_area'] = $value['min_area'] * 5445;
        $area['max_area'] = $value['max_area'] * 5445;


    }
        return $area;


    }

    public static function editPropertyRequirementAreaUnitConversation($value)
    {
        if($value['unit_id']=='1' || $value['unit_id']==null)
        {
            $area['max_area'] = $value['max_area'];
            $area['min_area'] = $value['min_area'];


        }
        if($value['unit_id']=='2')
        {

            $area['min_area']= $value['min_area'] / 10.7639;
            $area['max_area']= $value['max_area'] / 10.7639;


        }
        if($value['unit_id']=='3')
        {
            $area['min_area']= $value['min_area'] / 9;
            $area['max_area']= $value['max_area'] / 9;



        }
        if($value['unit_id']=='4')
        {
            $area['min_area']= $value['min_area'] / 272.251;
            $area['max_area']= $value['max_area'] / 272.251;


        }
        if($value['unit_id'] == '5')
        {
            $area['min_area'] = $value['min_area'] / 5445;
            $area['max_area'] = $value['max_area'] / 5445;


        }


          return $area;
    }

    public static function getAreaUnitValue($areaUnit)
    {

        if ($areaUnit === '1') {
            return [ //srq ft
                'areaUnitMinValue' => [450, 675, 1125, 1800, 2250, 3375, 4500, 6750, 9000],
                'areaUnitMaxValue' => [450, 675, 1125, 1800, 2250, 3375, 4500, 6750, 9000, 11250]
            ];
        }

        if ($areaUnit === '2') {
            return [//sqrt yrd
                'areaUnitMinValue' => [50, 60, 70, 80, 100, 120, 150, 200, 250, 300, 350, 400, 450, 500, 1000, 2000],
                'areaUnitMaxValue' => [50, 60, 70, 80, 100, 120, 150, 200, 250, 300, 350, 400, 450, 500, 1000, 2000, 4000]
            ];
        }

        if ($areaUnit === '3') {

            return [//sqrt mtr
                'areaUnitMinValue' => [50, 80, 130, 200, 250, 380, 510, 760, 1000, 1300, 1900, 2500, 3800, 5100, 6300, 13000, 19000, 25000],
                'areaUnitMaxValue' => [50, 80, 130, 200, 250, 380, 510, 760, 1000, 1300, 1900, 2500, 3800, 5100, 6300, 13000, 19000, 25000, 51000]
            ];
        }

        if ($areaUnit === '4') {
            return [//marla
                'areaUnitMinValue' => [2, 3, 5, 8, 10, 15, 20, 30, 40],
                'areaUnitMaxValue' => [2, 3, 5, 8, 10, 15, 20, 30, 40, 50]
            ];
        }

        if ($areaUnit === '5') {
            return [//kanal
                'areaUnitMinValue' => [1, 2, 3, 4, 5, 6, 7, 8, 10, 12, 15, 20, 30, 50],
                'areaUnitMaxValue' => [1, 2, 3, 4, 5, 6, 7, 8, 10, 12, 15, 20, 30, 50, 100]
            ];
        }

        return [];
    }

    public static function setAreaUnit($areaUnit)
    {
        return match($areaUnit){
            '1' => 'SQFT',
            '2' => 'SQ. M',
            '3' => 'SQ. YD',
            '4' => 'MARLA',
            '5' => 'KANAL',
            default => '',
        };
    }
}

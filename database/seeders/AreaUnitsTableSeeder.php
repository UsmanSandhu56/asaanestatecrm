<?php

namespace Database\Seeders;

use App\Models\AreaUnit;
use Illuminate\Database\Seeder;

class AreaUnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            [
                'name' => 'square feet',
                'value' => 1,
            ],
            [
                'name' => 'square meters',
                'value' => 11,
            ],
            [
                'name' => 'square yards',
                'value' => 9,
            ],
            [
                'name' => 'marla',
                'value' => 225,
            ],
            [
                'name' => 'kanal',
                'value' => 4500,
            ],
        ];

        foreach ($units as $unit) {
            AreaUnit::create([
                'name' => $unit['name'],
                'value' => $unit['value'],
            ]);
        }
    }
}

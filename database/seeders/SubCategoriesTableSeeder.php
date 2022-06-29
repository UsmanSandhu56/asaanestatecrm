<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub_categories = [
            [
                'name' => 'House',
                'category_id' => '1',
            ],
            [
                'name' => 'Flat',
                'category_id' => '1',
            ],
            [
                'name' => 'Upper Portion',
                'category_id' => '1',
            ],
            [
                'name' => 'Lower Portion',
                'category_id' => '1',
            ],
            [
                'name' => 'Farm House',
                'category_id' => '1',
            ],
            [
                'name' => 'Room',
                'category_id' => '1',
            ],
            [
                'name' => 'Pent House',
                'category_id' => '1',
            ],
            [
                'name' => 'Residential Plot',
                'category_id' => '2',
            ],
            [
                'name' => 'Commercial Plot',
                'category_id' => '2',
            ],
            [
                'name' => 'Agricultural Land',
                'category_id' => '2',
            ],
            [
                'name' => 'Industrial Land',
                'category_id' => '2',
            ],
            [
                'name' => 'Plot File',
                'category_id' => '2',
            ],
            [
                'name' => 'Plot Form',
                'category_id' => '2',
            ],
            [
                'name' => 'Office',
                'category_id' => '3',
            ],
            [
                'name' => 'Shop',
                'category_id' => '3',
            ],
            [
                'name' => 'Warehouse',
                'category_id' => '3',
            ],
            [
                'name' => 'Factory',
                'category_id' => '3',
            ],
            [
                'name' => 'Building',
                'category_id' => '3',
            ],
            [
                'name' => 'Other',
                'category_id' => '3',
            ],
        ];

        foreach ($sub_categories as $category) {
            SubCategory::create(['name' => $category['name'], 'category_id' => $category['category_id']]);
        }
    }
}

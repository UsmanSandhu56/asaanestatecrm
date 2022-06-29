<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'status' => 'Sold',
                'type' => 'properties',
            ],
            [
                'status' => 'Rented',
                'type' => 'properties',
            ],
            [
                'status' => 'Purchased',
                'type' => 'property_requirements',
            ],
            [
                'status' => 'Rented',
                'type' => 'property_requirements',
            ],
            [
                'status' => 'Archived',
                'type' => 'property_requirements',
            ],
            [
                'status' => 'Expired',
                'type' => 'property_requirements',
            ],
            [
                'status' => 'Archived',
                'type' => 'properties',
            ],
            [
                'status' => 'Expired',
                'type' => 'properties',
            ],
        ];

        foreach ($statuses as $status) {
            Status::create([
                'status' => $status['status'],
                'type' => $status['type'],
            ]);
        }
    }
}

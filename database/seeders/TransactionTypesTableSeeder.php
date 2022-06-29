<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaction_types = [
            [
                'type' => 'Cash',
                'description' => '',
            ],
            [
                'type' => 'Pay Order',
                'description' => '',
            ],
            [
                'type' => 'Bank Transfer',
                'description' => '',
            ],
            [
                'type' => 'Other',
                'description' => '',
            ],
        ];

        foreach ($transaction_types as $transaction_type) {
            TransactionType::create([
                'type' => $transaction_type['type'],
                'description' => $transaction_type['description'],
            ]);
        }
    }
}

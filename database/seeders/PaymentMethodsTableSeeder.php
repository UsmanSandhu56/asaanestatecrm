<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentMethods = [
            [
                'name' => 'Easypaisa',
                'account_no' => '0321-1234567',
            ],
            [
                'name' => 'Jazzcash',
                'account_no' => '0321-1234567',
            ],
            [
                'name' => 'HBL',
                'account_no' => '0312 4567 7898 3512',
            ],
        ];

        foreach ($paymentMethods as $methods) {
            PaymentMethod::create(['name' => $methods['name'], 'account_no' => $methods['account_no']]);
        }
    }
}

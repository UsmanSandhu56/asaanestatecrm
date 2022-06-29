<?php

namespace Database\Seeders;

use App\Models\StatusReason;
use Illuminate\Database\Seeder;

class StatusReasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reasons = [
            [
                'title' => 'Change in plans.',
            ],
            [
                'title' => 'Area was not suitable for customer.',
            ],
            [
                'title' => 'Property was not suitable for customer.',
            ],
            [
                'title' => 'Could\'nt reach the customer.',
            ],
            [
                'title' => 'Property sold by other agency.',
            ],
            [
                'title' => 'Others',
            ],
        ];

        foreach ($reasons as $reason) {
            StatusReason::create([
                'title' => $reason['title'],
            ]);
        }
    }
}

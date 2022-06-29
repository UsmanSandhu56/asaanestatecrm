<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = User::create([
            'name' => 'Admin Testing',
            'email' => 'admin@app.com',
            'phone_no' => '03000000000',
            'phone_verified' => true,
            'is_active' => true,
            'password' => bcrypt('12345678'),
        ]);
        $u->roles()->attach(1);
    }
}

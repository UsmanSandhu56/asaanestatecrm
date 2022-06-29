<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r = Role::create(['name' => 'Admin', 'slug' => 'admin']);
        $permissions = Permission::whereNotIn(
            'slug',
            [
                'user-create', 'customer-create', 'role-create',
                'property-create', 'property-requirement-create', 'closed-deal-create'
            ]
        )->get();
        $r->permissions()->attach($permissions);
    }
}

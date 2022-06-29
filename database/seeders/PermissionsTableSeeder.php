<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'User List',
                'slug' => 'user-list',
            ],
            [
                'name' => 'User Create',
                'slug' => 'user-create',
            ],
            [
                'name' => 'User Edit',
                'slug' => 'user-edit',
            ],
            [
                'name' => 'User Delete',
                'slug' => 'user-delete',
            ],
            [
                'name' => 'Role List',
                'slug' => 'role-list',
            ],
            [
                'name' => 'Role Create',
                'slug' => 'role-create',
            ],
            [
                'name' => 'Role Edit',
                'slug' => 'role-edit',
            ],
            [
                'name' => 'Role Delete',
                'slug' => 'role-delete',
            ],
            [
                'name' => 'Permission List',
                'slug' => 'permission-list',
            ],
            [
                'name' => 'Customer All List ',
                'slug' => 'customer-all-list',
            ],
            [
                'name' => 'Customer List',
                'slug' => 'customer-list',
            ],
            [
                'name' => 'Customer Create',
                'slug' => 'customer-create',
            ],
            [
                'name' => 'Customer Edit',
                'slug' => 'customer-edit',
            ],
            [
                'name' => 'Customer Delete',
                'slug' => 'customer-delete',
            ],
            [
                'name' => 'Property All List',
                'slug' => 'property-all-list',
            ],
            [
                'name' => 'Property List',
                'slug' => 'property-list',
            ],
            [
                'name' => 'Property Create',
                'slug' => 'property-create',
            ],
            [
                'name' => 'Property Edit',
                'slug' => 'property-edit',
            ],
            [
                'name' => 'Property Delete',
                'slug' => 'property-delete',
            ],
            [
                'name' => 'Property Requirement All List',
                'slug' => 'property-requirement-all-list',
            ],
            [
                'name' => 'Property Requirement List',
                'slug' => 'property-requirement-list',
            ],
            [
                'name' => 'Property Requirement Create',
                'slug' => 'property-requirement-create',
            ],
            [
                'name' => 'Property Requirement Edit',
                'slug' => 'property-requirement-edit',
            ],
            [
                'name' => 'Property Requirement Delete',
                'slug' => 'property-requirement-delete',
            ],
            [
                'name' => 'Closed Deal All List',
                'slug' => 'closed-deal-all-list',
            ],
            [
                'name' => 'Closed Deal List',
                'slug' => 'closed-deal-list',
            ],
            [
                'name' => 'Closed Deal Create',
                'slug' => 'closed-deal-create',
            ],
            [
                'name' => 'Closed Deal Edit',
                'slug' => 'closed-deal-edit',
            ],
            [
                'name' => 'Closed Deal Delete',
                'slug' => 'closed-deal-delete',
            ],
            [
                'name' => 'Update Commission',
                'slug' => 'update-commission',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission['name'], 'slug' => $permission['slug']]);
        }
    }
}

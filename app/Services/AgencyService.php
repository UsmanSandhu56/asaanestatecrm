<?php


namespace App\Services;


use App\Models\Permission;
use App\Models\Role;

class AgencyService
{
    public static function assignRoleWithPermission($agency)
    {
        $roles = [
            [
                'name' => 'Owner',
                'slug' => 'owner',
            ],
            [
                'name' => 'Agent',
                'slug' => 'agent',
            ]
        ];
        $agentPermissions = Permission::whereNotIn('slug', [
            'user-list', 'user-create', 'user-edit', 'user-delete',
            'role-list', 'role-create', 'role-edit', 'role-delete',
            'permission-list', 'customer-all-list', 'property-all-list',
            'property-requirement-all-list', 'closed-deal-all-list','update-commission'
        ])->get();
        foreach ($roles as $role) {
            $r = Role::create(['name' => $role['name'], 'slug' => $role['slug'], 'agency_id' => $agency->id]);
            if ($role['slug'] === 'owner') {
                $permissions = Permission::whereNotIn('slug', ['permission-list'])->get();
                $r->permissions()->attach($permissions);
                auth()->user()->roles()->attach($r->id, ['agency_id' => $agency->id]);
            } else {
                $r->permissions()->attach($agentPermissions);
            }
        }
    }
}

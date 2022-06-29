<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Http\Livewire\Admin\Parents\RoleParent;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;

class Create extends RoleParent
{
    public function render()
    {
        $this->authorize('role-create');
        $this->permissions = Permission::all();
        return view('livewire.admin.roles.create');
    }

    public function store()
    {
        $this->authorize('role-create');
        $this->validate();
        $role = Role::create(['name' => $this->name, 'slug' => Str::slug($this->name, '-'), 'agency_id' => session('agency_id')]);
        $role->permissions()->attach($this->permission_id);
        return redirect()->route('roles')->with('success', 'Role added successfully!');
    }
}

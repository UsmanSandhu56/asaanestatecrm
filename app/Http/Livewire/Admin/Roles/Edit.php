<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Http\Livewire\Admin\Parents\RoleParent;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;

class Edit extends RoleParent
{
    public function render()
    {
        $this->authorize('role-edit');
        return view('livewire.admin.roles.edit');
    }

    public function mount(Role $role)
    {
        $this->role = $role;
        $this->name = $role->name;
        $this->permissions = Permission::all();
        $this->permission_id = array_map('strval', $role->permissions->pluck('id')->all());
    }

    public function update()
    {
        $this->authorize('role-edit');
        $this->validate();
        $this->role->update(['name' => $this->name, 'slug' => Str::slug($this->name, '-'), 'agency_id' => session('agency_id')]);
        $this->role->permissions()->sync($this->permission_id);
        return redirect()->route('roles')->with('success', 'Role updated successfully!');
    }
}

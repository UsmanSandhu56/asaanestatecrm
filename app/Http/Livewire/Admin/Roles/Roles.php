<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Http\Traits\LoadMoreTrait;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Roles extends Component
{
    use AuthorizesRequests, LoadMoreTrait;

    public $roleIdBeingRemoved, $totalRecords;

    public function render()
    {
        $this->authorize('role-list');
        $roles = Role::where('slug', '!=', 'admin')->userAgency()->paginate($this->perPage);
        $this->totalRecords = $roles->total();
        return view('livewire.admin.roles.roles',['roles'=>$roles]);

    }

    public function confirmRoleRemoval(Role $role)
    {
        $this->roleIdBeingRemoved = $role;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function destroy()
    {
        $this->authorize('role-delete');
        $this->roleIdBeingRemoved->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['success' => 'Role deleted successfully!']);
    }
}


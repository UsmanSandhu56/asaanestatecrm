<?php

namespace App\Http\Livewire\Admin\Permissions;

use App\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Permissions extends Component
{
    use AuthorizesRequests;

    public $permissions;

    public function render()
    {
        $this->permissions = Permission::all();
        return view('livewire.admin.permissions.permissions');
    }
}

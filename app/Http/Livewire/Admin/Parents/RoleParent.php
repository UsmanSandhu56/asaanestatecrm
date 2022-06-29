<?php

namespace App\Http\Livewire\Admin\Parents;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class RoleParent extends Component
{
    use AuthorizesRequests;

    public $role, $name, $permissions, $permission_id = [];

    protected $rules = [
        'name' => 'required|string|max:20',
        'permission_id' => 'required|array',
    ];
    protected $messages = [
        'permission_id.required' => 'Please give permissions to role.',
    ];
}

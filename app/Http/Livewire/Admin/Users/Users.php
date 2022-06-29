<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Traits\LoadMoreTrait;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Livewire\Component;

class Users extends Component
{
    use AuthorizesRequests, LoadMoreTrait;

    public $data = [], $userIdBeingRemoved = null, $showEditModal = false, $roles, $user, $totalRecords;

    public function render()
    {
        $this->authorize('user-list');
        $users = User::with(['roles', 'agencies'])->whereRelation('agencies', 'agency_id', session('agency_id'))->where('id', '!=', auth()->id())->latest()->paginate($this->perPage);
        $this->roles = Role::userAgency()->get();
        $this->totalRecords = $users->total();
        return view('livewire.admin.users.users', ['users' => $users]);
    }

    public function create()
    {
        $this->authorize('user-create');
        $this->reset();
        $this->dispatchBrowserEvent('show-form');
    }

    public function store()
    {
        $this->authorize('user-create');
        $validatedData = $this->validation();
        if ($validatedData['roles'] == 1) {
            abort(403);
        }
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData + ['is_active' => true]);
        $user->agencies()->attach(session('agency_id'), ['commission' => $validatedData['commission']]);
        $user->roles()->attach($validatedData['roles'], ['agency_id' => session('agency_id')]);
        $this->dispatchBrowserEvent('hide-form', ['success' => 'User added successfully!']);
    }

    protected function validation()
    {
        if (isset($this->user)) {
            $password = ['sometimes', 'confirmed', Rules\Password::defaults()];
        } else {
            $password = ['required', 'confirmed', Rules\Password::defaults()];
        }
        return Validator::make($this->data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', Rule::unique('users')->ignore($this->user)],
            'phone_no' => ['required', 'starts_with:03','max:11', 'min:11', Rule::unique('users')->ignore($this->user)],
            'password' => $password,
            'roles' => ['required'],
            'commission' => ['required'],
        ],
            ['phone_no.starts_with' => 'The :attribute must start with 03.'])->validate();
    }

    public function edit(User $user)
    {
        $this->authorize('user-edit');
        $this->reset();
        $this->showEditModal = true;
        $this->user = $user;
        $this->data = $user->toArray();
        $this->data['roles'] = $user->roles->first()->id;
        $this->data['commission'] = $user->agencies()->first()->pivot->commission;
        $this->dispatchBrowserEvent('show-form');
    }

    public function update()
    {
        $this->authorize('user-edit');
        $validatedData = $this->validation();
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }
        $this->user->update($validatedData);
        $this->user->agencies()->syncWithPivotValues(session('agency_id'), ['commission' => $validatedData['commission']]);
        $this->user->roles()->syncWithPivotValues($validatedData['roles'], ['agency_id' => session('agency_id')]);
        $this->dispatchBrowserEvent('hide-form', ['success' => 'User updated successfully!']);
    }

    public function confirmUserRemoval(User $user)
    {
        $this->userIdBeingRemoved = $user;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function changeUserStatus(User $user)
    {
        $status = !$user->is_active;
        $user->update(['is_active' => $status]);
        $this->dispatchBrowserEvent('hide-form', ['success' => 'User status updated!']);
    }

    public function destroy()
    {
        $this->authorize('user-delete');
        $this->userIdBeingRemoved->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['success' => 'User deleted successfully!']);
    }
}

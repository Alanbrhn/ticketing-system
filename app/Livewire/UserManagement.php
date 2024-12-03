<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Role;
use Livewire\Component;

class UserManagement extends Component
{
    public $users = [];
    public $roles = [];
    public $userId, $name, $email, $selectedRoles = [];
    
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'selectedRoles' => 'array',
    ];

    public function mount()
    {
        $this->loadUsers();
        $this->roles = Role::all();
    }

    public function loadUsers()
    {
        $this->users = User::with('roles')->get();
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRoles = $user->roles->pluck('id')->toArray();
    }

    public function updateUser()
    {
        $this->validate();

        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        $user->roles()->sync($this->selectedRoles);

        session()->flash('success', 'User berhasil diperbarui.');
        $this->resetForm();
        $this->loadUsers();
    }

    public function resetForm()
    {
        $this->userId = null;
        $this->name = null;
        $this->email = null;
        $this->selectedRoles = [];
    }

    public function render()
    {
        return view('livewire.user-management');
    }
}

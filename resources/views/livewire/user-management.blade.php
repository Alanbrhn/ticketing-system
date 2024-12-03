<div>
    <h2 class="page-title">User Management</h2>

    <div class="mb-3">
        <button wire:click="resetForm" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-user-edit">Add User</button>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                <td>
                    <button wire:click="editUser({{ $user->id }})" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-user-edit">Edit</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Edit -->
    <div class="modal fade" id="modal-user-edit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="updateUser">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $userId ? 'Edit User' : 'Add User' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" id="name" wire:model="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" wire:model="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="roles" class="form-label">Role</label>
                            <select id="roles" wire:model="selectedRoles" class="form-select" multiple>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

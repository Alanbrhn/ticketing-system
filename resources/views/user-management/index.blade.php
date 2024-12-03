@extends('layout.main')


<style>
    @import url('https://rsms.me/inter/inter.css');
    :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }
    body {
        font-feature-settings: "cv03", "cv04", "cv11";
    }
  </style>

@section('content')
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        User Management
                    </h2>
                </div>
                <div class="col-auto ms-auto">
                    {{-- <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div id="table-default" class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><button class="table-sort" data-sort="sort-no">No</button></th>
                                    <th><button class="table-sort" data-sort="sort-name">Nama</button></th>
                                    <th><button class="table-sort" data-sort="sort-email">Email</button></th>
                                    <th><button class="table-sort" data-sort="sort-role">Role</button></th>
                                    <th><button class="table-sort">Action</button></th>
                                </tr>
                            </thead>
                            <tbody class="table-tbody">
                                @forelse ($users as $index => $user)
                                <tr>
                                    <td class="sort-no">{{ $index + 1 }}</td>
                                    <td class="sort-name">{{ $user->name }}</td>
                                    <td class="sort-email">{{ $user->email }}</td>
                                    <td class="sort-role">
                                        {{ implode(', ', $user->roles->pluck('name')->toArray()) }}
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm btn-view-user" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#modal-user-detail">View</button>
                                        <button class="btn btn-warning btn-sm btn-edit-user" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#modal-user-edit">Edit</button>
                                        {{-- <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Delete</button>
                                        </form>  --}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data pengguna.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal detaail --}}
<div class="modal modal-blur fade" id="modal-user-detail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">User Detail</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="user-details">
                <p>Loading...</p>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal modal-blur fade" id="modal-user-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-edit-user">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Nama</label>
                        <input type="text" id="edit-name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email</label>
                        <input type="email" id="edit-email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-role" class="form-label">Role</label>
                        <select id="edit-role" name="roles[]" class="form-select" multiple required>
                            <!-- Role options will be populated dynamically -->
                        </select>
                    </div>
                    <input type="hidden" id="edit-user-id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn-save-user" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

@endsection


<script>
   document.addEventListener("DOMContentLoaded", function () {
    initTableSort();
    initEventListeners();
});

/**
 * Inisialisasi sorting tabel menggunakan library List.js
 */
function initTableSort() {
    new List('table-default', {
        sortClass: 'table-sort',
        listClass: 'table-tbody',
        valueNames: ['sort-no', 'sort-name', 'sort-email', 'sort-role'],
    });
}

/**
 * Inisialisasi semua event listener
 */
function initEventListeners() {
    const tableElement = document.getElementById('table-default');
    tableElement.addEventListener('click', handleTableClick);

    const saveButton = document.getElementById('btn-save-user');
    saveButton.addEventListener('click', handleSaveUser);
}

/**
 * Handler untuk klik pada tabel
 */
async function handleTableClick(event) {
    if (event.target.classList.contains('btn-view-user')) {
        const userId = event.target.getAttribute('data-id');
        const data = await fetchUserData(userId);

        if (data) {
            fillUserDetailsModal(data);
            showModal('modal-user-detail');
        } else {
            showDangerModal("Gagal Memuat Data", "Tidak dapat memuat data pengguna.");
        }
    }

    if (event.target.classList.contains('btn-edit-user')) {
        const userId = event.target.getAttribute('data-id');
        const userData = await fetchUserData(userId);
        const roles = await fetchRoles();

        if (userData && roles) {
            populateEditUserForm(userData);
            populateRoleOptions('edit-role', roles, userData.roles);
            showModal('modal-edit-user');
        } else {
            showDangerModal("Gagal Memuat Data", "Tidak dapat memuat data pengguna atau role.");
        }
    }
}

/**
 * Handler untuk menyimpan data user
 */
async function handleSaveUser() {
    const userId = document.getElementById('edit-user-id').value;
    const formData = new FormData(document.getElementById('form-edit-user'));

    try {
        showLoading(true);
        const response = await updateUser(userId, formData);

        if (response.success) {
            showSuccessModal("Berhasil Diperbarui", "Data pengguna berhasil diperbarui.");
            setTimeout(() => location.reload(), 2000); // Reload halaman setelah 2 detik
        } else {
            showDangerModal("Gagal Menyimpan", "Tidak dapat menyimpan perubahan data.");
        }
    } catch (error) {
        console.error('Error saat memperbarui data:', error);
        showDangerModal("Kesalahan", "Terjadi kesalahan saat menyimpan data.");
    } finally {
        showLoading(false);
    }
}

/**
 * Modal Sukses: Menampilkan pesan sukses
 * @param {string} title - Judul modal
 * @param {string} message - Pesan modal
 */
function showSuccessModal(title, message) {
    const modal = document.getElementById('modal-success');
    modal.querySelector('h3').innerText = title;
    modal.querySelector('.text-secondary').innerText = message;
    const bootstrapModal = new bootstrap.Modal(modal);
    bootstrapModal.show();
}

/**
 * Modal Danger: Menampilkan pesan error atau konfirmasi
 * @param {string} title - Judul modal
 * @param {string} message - Pesan modal
 */
function showDangerModal(title, message) {
    const modal = document.getElementById('modal-danger');
    modal.querySelector('h3').innerText = title;
    modal.querySelector('.text-secondary').innerText = message;
    const bootstrapModal = new bootstrap.Modal(modal);
    bootstrapModal.show();
}

/**
 * Modal Loading: Menampilkan atau menyembunyikan loading indicator
 * @param {boolean} show - True untuk menampilkan, false untuk menyembunyikan
 */
function showLoading(show) {
    const loadingIndicator = document.getElementById('loading-indicator');
    loadingIndicator.style.display = show ? 'block' : 'none';
}


</script>







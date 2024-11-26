<?php


use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckMenuAccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\PermissionManagementController;
use App\Http\Controllers\MenuManagementController;
use App\Http\Controllers\TicketingManagementController;
use App\Http\Controllers\ApprovalManagementController;

Route::get('/', function () {
    // Jika pengguna login, arahkan ke dashboard
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Menambahkan middleware CheckMenuAccess untuk pengecekan akses menu di dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', CheckMenuAccess::class])->name('dashboard');

// Menambahkan middleware CheckMenuAccess pada route profile
Route::middleware(['auth', CheckMenuAccess::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk menu User Management
Route::middleware(['auth', 'verified', CheckMenuAccess::class])->group(function () {
    Route::get('/user-management', [UserManagementController::class, 'index'])->name('user-management.index');
    Route::get('/user-management/{id}', [UserManagementController::class, 'show'])->name('user-management.show');
    Route::get('/user-management/create', [UserManagementController::class, 'create'])->name('user-management.create');
    Route::post('/user-management', [UserManagementController::class, 'store'])->name('user-management.store');
    Route::get('/user-management/{id}/edit', [UserManagementController::class, 'edit'])->name('user-management.edit');
    Route::put('/user-management/{id}', [UserManagementController::class, 'update'])->name('user-management.update');
    Route::delete('/user-management/{id}', [UserManagementController::class, 'destroy'])->name('user-management.destroy');
});

// Route untuk menu Role Management
Route::middleware(['auth', 'verified', CheckMenuAccess::class])->group(function () {
    Route::get('/role-management', [RoleManagementController::class, 'index'])->name('role-management.index');
    Route::get('/role-management/{id}', [RoleManagementController::class, 'show'])->name('role-management.show');
    Route::get('/role-management/create', [RoleManagementController::class, 'create'])->name('role-management.create');
    Route::post('/role-management', [RoleManagementController::class, 'store'])->name('role-management.store');
    Route::get('/role-management/{id}/edit', [RoleManagementController::class, 'edit'])->name('role-management.edit');
    Route::put('/role-management/{id}', [RoleManagementController::class, 'update'])->name('role-management.update');
    Route::delete('/role-management/{id}', [RoleManagementController::class, 'destroy'])->name('role-management.destroy');
});

// Route untuk menu Permission Management
Route::middleware(['auth', 'verified', CheckMenuAccess::class])->group(function () {
    Route::get('/permission-management', [PermissionManagementController::class, 'index'])->name('permission-management.index');
    Route::get('/permission-management/{id}', [PermissionManagementController::class, 'show'])->name('permission-management.show');
    Route::get('/permission-management/create', [PermissionManagementController::class, 'create'])->name('permission-management.create');
    Route::post('/permission-management', [PermissionManagementController::class, 'store'])->name('permission-management.store');
    Route::get('/permission-management/{id}/edit', [PermissionManagementController::class, 'edit'])->name('permission-management.edit');
    Route::put('/permission-management/{id}', [PermissionManagementController::class, 'update'])->name('permission-management.update');
    Route::delete('/permission-management/{id}', [PermissionManagementController::class, 'destroy'])->name('permission-management.destroy');
});

// Route untuk menu Menu Management
Route::middleware(['auth', 'verified', CheckMenuAccess::class])->group(function () {
    Route::get('/menu-management', [MenuManagementController::class, 'index'])->name('menu-management.index');
    Route::get('/menu-management/{id}', [MenuManagementController::class, 'show'])->name('menu-management.show');
    Route::get('/menu-management/create', [MenuManagementController::class, 'create'])->name('menu-management.create');
    Route::post('/menu-management', [MenuManagementController::class, 'store'])->name('menu-management.store');
    Route::get('/menu-management/{id}/edit', [MenuManagementController::class, 'edit'])->name('menu-management.edit');
    Route::put('/menu-management/{id}', [MenuManagementController::class, 'update'])->name('menu-management.update');
    Route::delete('/menu-management/{id}', [MenuManagementController::class, 'destroy'])->name('menu-management.destroy');
});

// Route untuk menu Ticketing Management
Route::middleware(['auth', 'verified', CheckMenuAccess::class])->group(function () {
    Route::get('/ticketing-management', [TicketingManagementController::class, 'index'])->name('ticketing-management.index');
});

// Route untuk menu Approval Management
Route::middleware(['auth', 'verified', CheckMenuAccess::class])->group(function () {
    Route::get('/approval-management', [ApprovalManagementController::class, 'index'])->name('approval-management.index');
});

// // Route profile (dengan pengecekan menu access)
// Route::middleware(['auth', 'verified', CheckMenuAccess::class])->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


require __DIR__.'/auth.php';


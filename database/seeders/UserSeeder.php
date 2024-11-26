<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Membuat 5 user dan memberikan role ke masing-masing
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'Admin'
            ],
            [
                'name' => 'User A',
                'email' => 'user_a@example.com',
                'password' => bcrypt('password'),
                'role' => 'User'
            ],
            [
                'name' => 'User B',
                'email' => 'user_b@example.com',
                'password' => bcrypt('password'),
                'role' => 'User'
            ],
            [
                'name' => 'Sekretaris',
                'email' => 'sekretaris@example.com',
                'password' => bcrypt('password'),
                'role' => 'Sekretaris'
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@example.com',
                'password' => bcrypt('password'),
                'role' => 'Manager'
            ]
        ];

        foreach ($users as $userData) {
            // Membuat user baru
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
            ]);

            // Ambil role sesuai dengan nama yang diberikan
            $role = Role::where('name', $userData['role'])->first();

            // Menambahkan role ke user dengan attach(), menyertakan model_type
            $user->roles()->attach($role->id, [
                'model_type' => \App\Models\User::class,
                'model_id' => $user->id
            ]);
        }
    }
}

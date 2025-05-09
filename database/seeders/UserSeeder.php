<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Remove old data
        DB::table('users')->truncate();

        // Seed new data
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role_id' => 1,
                'role' => 'admin',
            ],
            [
                'name' => 'Editor User',
                'email' => 'editor@example.com',
                'password' => bcrypt('password'),
                'role_id' => 2,
                'role' => 'editor',
            ],
            [
                'name' => 'Normal User',
                'email' => 'user@example.com',
                'password' => bcrypt('password'),
                'role_id' => 3,
                'role' => 'user',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate([
                'email' => $userData['email'],
            ], [
                'name' => $userData['name'],
                'password' => $userData['password'],
                'role_id' => $userData['role_id'],
            ]);

            $user->assignRole($userData['role']);
        }
}
}
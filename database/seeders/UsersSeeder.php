<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fistUser = User::create([
            'name' => 'Admin',
            'lastname' => 'User',
            'email' => 'admin@example.com',
            'password' => 'password123', // password
            'role' => 'admin',
        ]);

        $fistUser;
        $users = [
            [
                'name' => 'Test1',
                'lastname' => 'User',
                'email' => 'user1@example.com',
                'password' => 'test12345', // Contraseña: password123
                'role' => 'admin',
                'parent_id' => $fistUser->id,
            ],
            [
                'name' => 'Test2',
                'lastname' => 'User',
                'email' => 'user2@example.com',
                'password' => 'mypassword', // Contraseña: password123
                'role' => 'admin',
                'parent_id' => $fistUser->id,
            ],
            [
                'name' => 'Test3',
                'lastname' => 'User',
                'email' => 'user3@example.com',
                'password' => 'test12345', // Contraseña: password123
                'role' => 'admin',
                'parent_id' => $fistUser->id,
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}

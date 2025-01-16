<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Testing\Fakes\Fake;

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
            'username' => 'adminUser',
            'email' => 'admin@example.com',
            'password' => 'password123', // password
            'role' => 'admin',
            'kyc_status' => 'verified',
            'gender' => 'male',
            'phone' => '1234567890',
            'document_type' => 'id_card',
            'document_number' => '12345678',
            'birth_date' => '1990-01-01',

        ]);

        $fistUser;
        $users = [
            [
                'username' => 'Test1User',
                'email' => 'user1@example.com',
                'password' => 'test12345',
                'role' => 'customer',
                'parent_id' => $fistUser->id,
            ],
            [
                'username' => 'Test2User',
                'email' => 'user2@example.com',
                'password' => 'mypassword',
                'role' => 'customer',
                'parent_id' => $fistUser->id,
            ],
            [
                'username' => 'Test3Supplier',
                'email' => 'user3@example.com',
                'password' => 'test12345',
                'role' => 'supplier',
                'rank_id' => 2,
                'parent_id' => $fistUser->id,
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}

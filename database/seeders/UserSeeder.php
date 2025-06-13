<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define an array of user data
        $usersData = [
            [
                'name' => 'Drejtori',
                'email' => 'drejtori@example.com',
                'password' => '12345678',
                'role' => 'Drejtor' 
            ],
            [
                'name' => 'Msuesi 1',
                'email' => 'msuesi1@example.com',
                'password' => '12345678',
                'role' => 'Mesuesi' 
            ],
            [
                'name' => 'Student 1',
                'email' => 'student2@example.com',
                'password' => '12345678',
                'role' => 'Studenti'
            ],
            [
                'name' => 'Administratori',
                'email' => 'Admin@example.com',
                'password' => '12345678',
                'role' => 'Admin'
            ],
            
        ];

        foreach ($usersData as $index => $userData) {
         
            $user = User::factory()->create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
            ]);

            // Assign the corresponding role
            $user->assignRole($userData['role']);
        }
    }
}

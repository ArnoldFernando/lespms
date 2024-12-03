<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), // Make sure to hash the password
            'usertype' => 'admin',
        ]);

        // Create a User
        User::create([
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'), // Hash the password
            'usertype' => 'user',
        ]);

        // Create a Service Provider
        User::create([
            'name' => 'Service Provider',
            'email' => 'service@gmail.com',
            'password' => Hash::make('password'), // Hash the password
            'usertype' => 'service_provider',
        ]);
    }
}

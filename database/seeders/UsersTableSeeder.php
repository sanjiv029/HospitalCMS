<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Insert an admin user
       /*  User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'), // Use bcrypt or Hash::make to hash the password
            'role' => 'admin', // Ensure the role column exists
        ]);
 */
        // Optionally, you can create other users or data here
    }
}

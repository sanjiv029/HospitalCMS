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
/*         User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'), // Use bcrypt or Hash::make to hash the password
            'usertype' => 'admin', // Set usertype for the admin user
        ]);

        // Insert a default user
        User::create([
            'name' => 'Default User',
            'email' => 'user@user.com',
            'password' => Hash::make('password'), // Use bcrypt or Hash::make to hash the password
            'usertype' => 'user', // Set usertype for a regular user
        ]);
 */
        // You can add more users or data here as needed
    }
}

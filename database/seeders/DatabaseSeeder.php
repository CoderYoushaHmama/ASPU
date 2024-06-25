<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $roles = ['manage employees', 'manage trips', 'manage roles', 'manage users', 'manage reservations', 'manage seats', 'manage payment methods', 'manage offers', 'manage foods', 'answer questions', 'reservation', 'ask question'];
        $manager_roles = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        if (false)
            foreach ($roles as $role) {
                Role::create([
                    'name' => $role,
                ]);
            }

        if (false) {
            $user = User::create([
                'username' => 'manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('123456789'),
                'phone_number' => '0944121478',
                'address' => 'Damascus - Maza',
                'type' => 'M',
            ]);


            foreach ($manager_roles as $role) {
                UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => $role,
                ]);
            }
        }
    }
}

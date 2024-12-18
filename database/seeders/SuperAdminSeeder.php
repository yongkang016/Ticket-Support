<?php

namespace Database\Seeders;

use App\Constants\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::query()->count() === 0) {
            $superAdmin = User::factory()->create([
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.my',
                'role' => 'admin',
                'password' => Hash::make('123456'),
                'email_verified_at' => now()->toDateTimeString(),
            ]);

            $superAdmin->assignRole(Role::SUPER_ADMIN);
        }
    }
}

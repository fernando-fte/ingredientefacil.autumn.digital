<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@admin.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('super1234'),
                // Adicione outros campos necessários, ex: 'is_super_admin' => true
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'admin@cnuelmedicine.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Password123'),
                'is_super_admin' => true,
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Enums\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@evente.com',
            'password' => Hash::make('password'),
            'role' => Role::ADMIN,
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@evente.com',
            'password' => Hash::make('password'),
        ]);
    }
}

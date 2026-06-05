<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Administrator',
            'username' => 'admin',
            'email'    => 'admin@possibali.org',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Editor
        User::create([
            'name'     => 'Editor POSSI',
            'username' => 'editor',
            'email'    => 'editor@possibali.org',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // Member biasa
        User::create([
            'name'     => 'I Wayan Surya',
            'username' => 'wayansurya',
            'email'    => 'wayan@possibali.org',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);
    }
}
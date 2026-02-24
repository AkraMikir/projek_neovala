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
        Admin::updateOrCreate(
            ['email' => 'admin@neovalaofficial.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Papaya333neovala.'),
            ]
        );
    }
}